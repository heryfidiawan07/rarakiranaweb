<?php

namespace App\Http\Controllers;

use Auth;
use App\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function index(){
    	$rekenings = Rekening::all();
    	return view('admin.rekening.index', compact('rekenings'));
    }

    public function store(Request $request){
    	$this->validate($request, [
                'name' => 'required',
                'bank' => 'required',
                'number' => 'required',
            ]);
    	Rekening::create([
    		'name' => strtoupper($request->name),
    		'bank' => strtoupper($request->bank),
    		'number' => $request->number,
    		'user_id' => Auth::user()->id,
    	]);

    	return back();
    }
    
    public function update(Request $request, $id){
    	$rekening = Rekening::whereId($id)->first();
    	$rekening->update([
    		'name' => $request->editName,
    		'bank' => $request->editBank,
    		'number' => $request->editNumber,
    		'user_id' => Auth::user()->id,
    	]);
    	return back();
    }
    
    public function destroy($id){
    	$rek  = Rekening::find($id);
        $rek->delete();
        return back();
    }
    
    
}
