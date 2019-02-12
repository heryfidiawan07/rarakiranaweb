<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Message;
use App\Product;
use Illuminate\Http\Request;

class MessageController extends Controller
{   
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function messageProductStore(Request $request, $slug){
        $this->validate($request, [
            'descriptionMessage' => 'required|max:500',
        ]);

        $product = Product::whereSlug($slug)->first();
        Message::create([
            'user_id' => Auth::user()->id,
            'messageable_id' => $product->id,
            'messageable_type' => 'App\Product',
            'description' => Purifier::clean($request->descriptionMessage),
        ]);
        //Kirim Email ke admin
        return back();
    }

    public function MessageProductUpdate(Request $request, $id){
        $this->validate($request, [
            'descriptionMessageEdit' => 'required|max:500',
        ]);

        $message = Message::whereId($id)->first();
        $message->update([
            'user_id' => Auth::user()->id,
            'description' => Purifier::clean($request->descriptionMessageEdit),
        ]);
        //Kirim Email ke admin
        return back();
    }

}
