<?php

namespace App\Http\Controllers\Auth;

use App\Contract\Social;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function start($driver){
        return Socialite::driver($driver)->redirect();
    }
    public function callback(Social $service, $driver){
        return redirect($service->socialLogin(Socialite::driver($driver)->user()));
    }
}
