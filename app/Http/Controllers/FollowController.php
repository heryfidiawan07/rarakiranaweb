<?php

namespace App\Http\Controllers;

use Auth;
use App\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $follows = Follow::all();
        return view('admin.follow.index',compact('follows'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
             'urlFollow' => 'required|max:500',
             'follow' => 'required',
        ]);
        $getName = explode('-', $request->follow);
        if ($getName[1] == 'weixin') {
             $getName = 'wechat';
        }elseif ($getName[1] == 'envelope') {
            $getName = 'mail';
        }else{
            $getName = $getName[1];
        }
        $cekFollow = Follow::where('class','=',$request->follow)->first();
        if ($cekFollow === null) {
            Follow::create([
                    'name' => $getName,
                    'url' => $request->urlFollow,
                    'class' => $request->follow,
                    'user_id' => Auth::user()->id,
                ]);
        }else{
            return back()->with('warningEdit', 'Sosial media follow yang anda pilih sudah terisi, silahkan edit atau pilih sosial media yang lain !');
        }
        return back();

    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
             'urlFollowEdit' => 'required|max:500',
        ]);
        $follow = Follow::whereId($id)->first();
        $follow->update([
                'url' => $request->urlFollowEdit,
            ]);
        return back();
    }

    public function destroy($id)
    {
        $follow = Follow::find($id);
        $follow->delete();
        return back();
    }
    
}
