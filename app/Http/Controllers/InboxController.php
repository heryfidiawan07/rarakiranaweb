<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Inbox;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class InboxController extends Controller
{   

    public function contact(Request $request){
        $this->validate($request, [
                'subject' => 'required|max:500',
                'email' => 'required|max:200',
                'description' => 'required|max:1000',
                'g-recaptcha-response' => 'required|captcha',
            ]);
        if(Auth::check()){
            if (Auth::user()) {
                $user_id = Auth::user()->id;
            }else{
                $user_id = null;
            }
        }
        $pesan = Inbox::create([
                'user_id' => $user_id,
                'subject' => $request->subject,
                'email' => $request->email,
                'description' => purifier::clean($request->description),
            ]);
        // mengirim email
        Mail::to('rarakirana07@gmail.com')->send(new Inbox($pesan));
        return back()->with('success', 'Pesan anda berhasil dikirim.');
    }
    
}
