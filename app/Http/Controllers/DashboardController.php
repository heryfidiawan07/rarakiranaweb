<?php

namespace App\Http\Controllers;

//Analytics
use Analytics;
use Spatie\Analytics\Period;

use App\User;
use App\Share;
use App\Inbox;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function dashboard(){
        $optParams = array('dimensions' => 'rt:medium');
        // $online = Analytics::getAnalyticsService()->data_realtime->get('ga:176799134','rt:activeUsers',$optParams);
        // $online = Analytics::getAnalyticsService()->data_realtime->get('ga:'.env('ANALYTICS_VIEW_ID'),'rt:activeUsers',$optParams);
        $online = Analytics::getAnalyticsService()->data_realtime->get('ga:'.env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')
                  ->totalsForAllResults['rt:activeVisitors'];
        // dd($online);
    	return view('admin.dashboard',compact('online'));
    }

    public function users(){
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }
    
    public function statusUsers(Request $request, $id){
        $user = User::whereId($id)->first();
        $user->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function inbox(){
        $inboxs = Inbox::all();
        return view('admin.inboxs.index',compact('inboxs'));
    }
    
    
}
