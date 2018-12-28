<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoogleController extends Controller
{
    protected $redirectPath = '/';

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('auth/google');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('/');
    }

    private function findOrCreateUser($googleUser)
    {
        $authUser = User::where('social', $googleUser->id)->first();
        $cekslug = User::where('slug', str_slug($googleUser->name))->first();

        if ($authUser){
            return $authUser;
        }

        if ($googleUser->email == null) {
            $googleUser->email = $googleUser->id.'@gmail.com';
        }

        if (count($cekslug) > 0) {
            $slug = str_slug($googleUser->name).'-'.date("YmdHis");
        }else {
            $slug  = str_slug($googleUser->name);
        }

        if ($googleUser->avatar == null) {
            $img = 'users.jpg';
        }else{
            $img = $googleUser->avatar_original;
        }
        //'handle' => $googleUser->nickname,
        return User::create([
            'name'        => $googleUser->name,
            'email'       => $googleUser->email,
            'social'      => $googleUser->id,
            'graph'       => $img,
            'status'      => 1,
            'token'       => str_random(20),
            'password'    => bcrypt(str_random(20)),
            'slug'        => $slug,
        ]);
    }
    
}
