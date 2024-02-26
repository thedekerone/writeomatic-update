<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Integration;
use App\Models\PaymentPlans;
use App\Models\ScheduledDocuments;
use App\Models\YokassaSubscriptions;
use Carbon\Carbon;
use App\Console\CustomScheduler;
use App\Console\Commands\CheckSubscriptionEnd;
use Spatie\Health\Commands\RunHealthChecksCommand;
use App\Services\GatewaySelector;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $customSchedulerPath = app_path('Console/CustomScheduler.php');

        if (file_exists($customSchedulerPath)) {
            require_once($customSchedulerPath);
            CustomScheduler::scheduleTasks($schedule);
        }

        $schedule->command("app:check-coingate-command")->everyFiveMinutes();

        $schedule->command("subscription:check-end")->everyFiveMinutes();

        $schedule->call(function () {
            $activeSub_yokassa = YokassaSubscriptions::where('subscription_status', 'active')->orWhere('subscription_status', 'yokassa_approved')->get();
            foreach($activeSub_yokassa as $activeSub) {
                $data_now = Carbon::now();
                $data_end_sub = $activeSub->next_pay_at;
                if($data_now->gt($data_end_sub)) $result = GatewaySelector::selectGateway('yokassa')::handleSubscribePay($activeSub->id);
            }
        })->daily();

        $schedule->call(function () {
            $scheduled_documents = ScheduledDocuments::where('is_executed', false)->get();
            $date_now = Carbon::now();
            foreach ($scheduled_documents as $doc) {
                if($date_now->gt($doc->run_at)) {
                    $integration = Integration::find($doc->account_id);
                    $document = UserOpenai::find($doc->document_id);
                    if($integration && $document) {
                       if($integration->name == "WordPress") {
                           $data = [
                                'title' => $document->title,
                                'content' => $document->response,
                                'status' => 'publish'
                            ];
                            $password = decrypt($integration->password);
                            $response = Http::withBasicAuth($integration->username, $password)->post($integration->url, $data);
                            if($response->successful()) {
                                $doc->is_executed = true;
                                $doc->save();
                            }
                        }
                    }

                }
            }
        })->everyMinute();


    }
    // $schedule->command(RunHealthChecksCommand::class)->everyFiveMinutes();
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
