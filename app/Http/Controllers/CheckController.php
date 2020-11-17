<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function save_session($wallet){
        /*if ($request->session()->has('wallet')) {
            //
        }*/
        session(['wallet' => $wallet]);

        return response()->json(
            true
        );
    }

    public function check_session(Request $request){
        if ($request->session()->has('wallet')) {
            return response()->json(
	            session('wallet')
	        );
        }else{
        	return response()->json(
	            false
	        );
        }
    }

    public function delete_session(Request $request){
    	if ($request->session()->has('wallet')) {
    		$request->session()->forget('wallet');
    	}

    	return redirect('login');
    }

    public function smart_business_3_details($level){
        return view('smartBusiness3')->with(compact('level'));
    }

    public function smart_business_6_details($level){
        return view('smartBusiness6')->with(compact('level'));
    }
}
