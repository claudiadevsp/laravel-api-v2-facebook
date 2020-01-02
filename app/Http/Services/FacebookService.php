<?php

namespace App\Http\Services;

use Laravel\Socialite\Facades\Socialite;
use Facebook\Facebook;

class FacebookService
{
    protected $client;
    private $config;
    private $result;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
        $this->config = config('services.facebook');
    }
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
        $auth_user = Socialite::driver('facebook')->user();
        return $auth_user->token;
    }

    public function getUserFacebook()
    {
        $params = "first_name,last_name";
        $this->result = $this->client->get('/me?fields='. $params .'&access_token=' . $this->handleProviderFacebookCallback() )->getBody();
        return response($this->result, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
