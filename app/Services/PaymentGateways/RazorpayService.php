<?php

namespace App\Services\PaymentGateways;
use App\Models\Currency;
use App\Models\Gateways;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\Setting;
use App\Models\Coupon;
use App\Models\PaymentPlans;
use App\Models\GatewayProducts;
use App\Models\OldGatewayProducts;
use App\Job\ProcessRazorpayCustomerJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Razorpay\Api\Api;
use Laravel\Cashier\Subscription as Subscriptions;

/**
 * Base functions foreach payment gateway
 * @param saveAllProducts
 * @param saveProduct ($plan)
 * @param subscribe ($plan)
 * @param subscribeCheckout (Request $request, $referral= null)
 * @param prepaid ($plan)
 * @param prepaidCheckout (Request $request, $referral= null)
 * @param getSubscriptionStatus ($incomingUserId = null)
 * @param getSubscriptionDaysLeft
 * @param subscribeCancel
 * @param checkIfTrial
 * @param getSubscriptionRenewDate
 * @param cancelSubscribedPlan ($subscription)
 */
class RazorpayService 
{
 	protected static $GATEWAY_CODE      = "razorpay";
    protected static $GATEWAY_NAME      = "Razorpay";

 	# payment functions
    public static function saveAllProducts(){
        $api = self::getRazorApi();
        try {
            # ------------ start creation of users stripe ids, for the first time only ------------------
            $existingCustomerIds = collect();
            $cursor = null;
			$skip = 0; 
            do {
				$options = [// Define options for fetching customers, including count and skip parameters for pagination
					'count' => 100, // Limit the number of records to fetch per request
					'skip' => $skip, // Skip previously fetched records
				];
				$customers = $api->customer->all($options);
				$existingCustomerIds = $existingCustomerIds->merge($customers->items);
				$skip += $options['count'];
			} while ($customers->count > 0 && $customers->count >= $options['count']);
            $allUsers = User::all();
            $userUpdates = [];
            foreach ($allUsers as $aUser) {
                if (!in_array($aUser->razorpay_id, $existingCustomerIds->pluck('id')->toArray())) {
                  	$userData = [
						"name" => $aUser->name . " " . $aUser->surname,
						"email" => $aUser->email,
						"contact" => $aUser->phone,
						"notes" => [
							"notes_key_1" => $aUser->address,
							"notes_key_2" => $aUser->postal,
						],
					];
					dispatch(new ProcessRazorpayCustomerJob($api, $aUser, $userData));
                }
            }
            # ------------ end creation of users stripe ids, for the first time only ------------------
            $plans = PaymentPlans::where('active', 1)->get();
            foreach ($plans as $plan) {
                self::saveProduct($plan);
            }
            # create webhooks after saving the products
            $tmp = self::createWebhook();
        } catch (\Exception $ex) {
            Log::error(self::$GATEWAY_CODE."-> saveAllProducts(): " . $ex->getMessage());
            return back()->with(['message' => $ex->getMessage(), 'type' => 'error']);
        }     
    }
 	public static function saveProduct($plan)
    {
        $gateway = Gateways::where("code", self::$GATEWAY_CODE)->first() ?? abort(404);
		try {
            DB::beginTransaction();
	 		$price = (int)(((float)$plan->price) * 100); # Must be in cents level for stripe


			DB::commit();
 		} catch (\Exception $ex) {
            DB::rollBack();
            Log::error(self::$GATEWAY_CODE."-> saveProduct():\n" . $ex->getMessage());
            return back()->with(['message' => $ex->getMessage(), 'type' => 'error']);
        }
	}





	


	private static function getRazorApi($gateway=null){
        $gateway= $gateway ?? Gateways::where("code", self::$GATEWAY_CODE)->where('is_active', 1)->first() ?? abort(404);
        if ($gateway->mode == 'sandbox') {
            $api_key 	= $gateway->sandbox_client_id;
            $api_secret = $gateway->sandbox_client_secret;
        } else {
            $api_key 	= $gateway->live_client_id;
            $api_secret = $gateway->live_client_secret;
        }
		$api = new Api($api_key, $api_secret);
        return $api;
    }

}