<?php

namespace App\Http\Controllers;
use App\Http\Services\FacebookService;

class FacebookController extends Controller
{
    private $serviceFacebook;

    public function __construct(FacebookService $serviceFacebook)
    {
        $this->serviceFacebook = $serviceFacebook;
    }

    public function redirectToFacebook()
    {        
       return $this->serviceFacebook->redirectToFacebookProvider();
    }

    public function getDataUserFacebook()
    {
        dd($this->serviceFacebook->handleProviderFacebookCallback());
    }
}
