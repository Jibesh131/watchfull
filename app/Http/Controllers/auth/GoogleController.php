<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user['email'] = $googleUser->getEmail();
        $user['name']  = $googleUser->getName();
        $user['avatar'] = $googleUser->getAvatar();
        $user['id'] = $googleUser->getId();
        $user['nickname'] = $googleUser->getNickname();
        $user['offlineAccessToken'] = $googleUser->offlineAccessToken ?? null;
        $user['refreshToken'] = $googleUser->refreshToken ?? null;
        $user['expiresIn'] = $googleUser->expiresIn ?? null;
        // $user['raw'] = $googleUser->getRaw();

        dd($user);

        // Auth::login($user);
        // return redirect('/dashboard');
    }
    
}
