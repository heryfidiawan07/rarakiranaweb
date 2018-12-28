<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacebookController extends Controller
{
    protected $redirectPath = '/';

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('/');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect()->to('/');
    }

    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('social', $facebookUser->id)->first();
        $cekslug = User::where('slug', str_slug($facebookUser->name))->first();

        if ($authUser){
            return $authUser;
        }

        if ($facebookUser->email == null) {
            $facebookUser->email = $facebookUser->id.'@facebook.com';
        }

        if (count($cekslug) > 0) {
            $slug = str_slug($facebookUser->name).'-'.date("YmdHis");
        }else {
            $slug  = str_slug($facebookUser->name);//ok Fix
        }

        if ($facebookUser->avatar == null) {
            $img = 'users.jpg';
        }else{
            $img = $facebookUser->avatar;
        }

        return User::create([
            'name'        => $facebookUser->name,
            'email'       => $facebookUser->email,
            'social'      => $facebookUser->id,
            'graph'       => $img,
            'status'      => 1,
            'token'       => str_random(50),
            'password'    => bcrypt(str_random(20)),
            'slug'        => $slug,
        ]);
    }
    
}
