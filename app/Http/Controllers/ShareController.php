<?php

namespace App\Http\Controllers;

use Auth;
use App\Share;
use Illuminate\Http\Request;

class ShareController extends Controller
{   
    public function __construct(){
        $this->middleware('admin');
    }

    public function index()
    {   
        $shares = Share::all();
        return view('admin.share.index',compact('shares'));
    }

    public function store(Request $request)
    {   
        $socialUrl    = [
                            'kosong',
                            'https://www.facebook.com/sharer/sharer.php?u=',
                            'https://twitter.com/share?url=',
                            'whatsapp://send?text=',
                            'https://pinterest.com/pin/create/button/?url=',
                            'mailto:?subject=Rarakirana Share site&amp;body=Check out this site ',
                            'https://plus.google.com/share?url=',
                            'https://www.linkedin.com/shareArticle?url=true&url=',
                        ];
        $socialClass  = [
                            'kosong',
                            'fab fa-facebook','fab fa-twitter','fab fa-whatsapp','fab fa-pinterest',
                            'fas fa-envelope','fab fa-google','fab fa-linkedin',
                        ];
        $shares = $request->share;
        foreach ($shares as $val) {
            $cekShare = Share::where('class','=',$socialClass[$val])->first();
            if ($cekShare === null) {
                $getName = explode('-', $socialClass[$val]);
                if ($getName[1] == 'envelope') {
                    $name = 'mail';
                }else{
                    $name = $getName[1];
                }
                $share          = new Share;
                $share->name    = $name;
                $share->url     = $socialUrl[$val];
                $share->class   = $socialClass[$val];
                $share->user_id = Auth::user()->id;
                $share->save();
            }else{
                continue;
            }
        }
        return back();
    }

    public function destroy($id)
    {
        $share = Share::find($id);
        $share->delete();
        return back();
    }

}
