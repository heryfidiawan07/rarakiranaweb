<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwitterController extends Controller
{
    protected $redirectPath = '/';

    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('/');
    }

    private function findOrCreateUser($twitterUser)
    {
        $authUser = User::where('social', $twitterUser->id)->first();
        $cekslug  = User::where('slug', str_slug($twitterUser->name))->first();

        if ($authUser){
            return $authUser;
        }

        if ($twitterUser->email == null) {
            $twitterUser->email = $twitterUser->id.'@twitter.com';
        }

        if (count($cekslug) > 0) {
            $slug = str_slug($twitterUser->name).'-'.date("YmdHis");
        }else {
            $slug  = str_slug($twitterUser->name);
        }

        if ($twitterUser->avatar_original == null) {
            $img = 'users.jpg';
        }else{
            $img = $twitterUser->avatar_original;
        }

        //'handle' => $twitterUser->nickname,
        return User::create([
            'name'        => $twitterUser->name,
            'email'       => $twitterUser->email,
            'social'      => $twitterUser->id,
            'graph'       => $img,
            'status'      => 1,
            'token'       => str_random(50),
            'password'    => bcrypt(str_random(20)),
            'slug'        => $slug,
        ]);
    }
    
}
