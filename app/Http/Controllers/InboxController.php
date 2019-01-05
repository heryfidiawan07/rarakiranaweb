<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{   

    public function contact(Request $request){
        $this->validate($request, [
                'email' => 'required|max:200',
                'description' => 'required|max:1000',
                //'g-recaptcha-response' => 'required|captcha',
            ]);
        if(Auth::check()){
            if (Auth::user()) {
                $user_id = Auth::user()->id;
            }else{
                $user_id = null;
            }
        }
        Inbox::create([
                'user_id' => $user_id,
                'email' => $request->email,
                'description' => purifier::clean($request->description),
            ]);
        // mengirim email
        //Mail::to($user->email)->send(new RarakiranaRegister($user));
        return back()->with('success', 'Pesan anda berhasil dikirim.');
    }
    
}
