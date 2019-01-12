<?php

namespace App\Http\Controllers;

use Purifier;
use App\User;
use App\Question;
use App\Mail\GuestQuestion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class QuestionController extends Controller
{
    public function contact(Request $request){
        $this->validate($request, [
                'subject' => 'required|max:200',
                'email'   => 'required',
                'description' => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ]);
        $question = Question::create([
                'subject' => $request->subject,
                'email'   => $request->email,
                'description' => Purifier::clean($request->description),
            ]);
        // mengirim email
        Mail::to('rarakirana07@gmail.com')->send(new GuestQuestion($question));
        return back()->with('success', 'Pesan berhasil terkirim.');
    }

}
