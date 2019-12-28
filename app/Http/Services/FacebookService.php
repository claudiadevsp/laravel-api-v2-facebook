<?php

namespace App\Http\Services;

use Laravel\Socialite\Facades\Socialite;

class FacebookService
{
     /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebookProvider()
    {        
        return Socialite::driver('facebook')->scopes([
            "manage_pages", "publish_pages"])->redirect();
    }

     /**
     * Obtain the user information from Facebook.
     *
     * @return void
     */
    public function handleProviderFacebookCallback()
    {
        return $auth_user = Socialite::driver('facebook')->user();        
    }
}
