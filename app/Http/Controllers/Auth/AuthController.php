<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Socialite;
use App\User;

class AuthController extends Controller
{
    // social auth
    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    // after auth
    public function handleProviderCallback($provider) {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('/private');
    }

    // user add & user data get
    public function findOrCreateUser($user, $provider) {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
