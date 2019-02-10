<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
	public function __construct(){
      $this->middleware('admin');
    }

		public function adminAddress(Request $request){
            $user = User::where('admin',1)->first();
			Address::create([
                'name'        => 'ADMIN',
                'penerima'    => 'ADMIN',
                'address'     => 'ADMIN',
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
