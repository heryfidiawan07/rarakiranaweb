<?php

namespace App\Http\Controllers;

use Auth;
use App\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $follows = Follower::all();
        return view('admin.follow.index',compact('follows'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
             'urlFollow' => 'required|max:500',
             'followClass' => 'required',
        ]);
        $getName = explode('-', $request->followClass);
        if ($getName[1] == 'weixin') {
             $getName = 'wechat';
        }elseif ($getName[1] == 'envelope') {
            $getName = 'mail';
        }else{
            $getName = $getName[1];
        }
        $cekFollow = Follower::where('class','=',$request->followClass)->first();
        if ($cekFollow === null) {
            Follower::create([
                    'name' => $getName,
                    'url' => $request->urlFollow,
                    'class' => $request->followClass,
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
        $follow = Follower::whereId($id)->first();
        $follow->update([
                'url' => $request->urlFollowEdit,
            ]);
        return back();
    }

    public function destroy($id)
    {
        $follow = Follower::find($id);
        $follow->delete();
        return back();
    }
    
}
