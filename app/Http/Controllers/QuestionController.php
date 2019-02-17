<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\User;
use App\Product;
use App\Question;
use App\Mail\GuestQuestion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class QuestionController extends Controller
{
    public function contact(Request $request){
        $this->validate($request, [
                'subject' => 'required|max:100',
                'email'   => 'required',
                'phone'   => 'required|max:13',
                'description' => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ]);
        if(Auth::check()){
            if(Auth::user()){
                $email = Auth::user()->email;
            }else{
                $email = $request->email;
            }
        }
        $product_id = $request->product_id;
        $product = Product::whereId($product_id)->first();
        if ($product === null) {
            $product_id = 0;
        }else{
            $product_id = $product->id;
        }
        //dd($product->title);
        $question = Question::create([
                'title' => $request->subject,
                'email'   => $email,
                'phone'   => $request->phone,
                'description' => Purifier::clean($request->description),
                'setting' => $product_id,
            ]);
        // Kirim email
        Mail::to('rarakirana07@gmail.com')->send(new GuestQuestion($question));
        return back()->with('success', 'Pesan berhasil dikirim.');
    }

}
