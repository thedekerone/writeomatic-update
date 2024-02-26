<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class TwitterController extends Controller
{
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        $user = Socialite::driver('twitter')->user();
        // Here, you can store the user data and access token in your database or session.
        // For now, let's just return the user data to see if it's working:
        return response()->json($user);
    }
}
