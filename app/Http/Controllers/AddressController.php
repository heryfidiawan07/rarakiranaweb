<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
		public function __construct(){
      $this->middleware('admin');
    }

		public function adminAddress(Request $request){
				Address::create([
                'name'        => $user->name,
                'penerima'    => $request->penerima,
                'address'     => Purifier::clean($request->address),
                'kab_id'      => $request->kabHidden,
                'kabupaten'   => $request->kabupaten,
                'kec_id'      => 0,
                'kecamatan'   => $request->kecamatan,
                'postal_code' => $request->postal_code,
                'phone'       => $request->phone,
                'user_id'     => $user->id,
            ]);
				return back();
		}
		
}
