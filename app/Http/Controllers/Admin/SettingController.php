<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $purchase_date = Setting::where('key', 'box_purchasing_last_date')->first();
        $custom_date = Setting::where('key', 'box_customization_last_date')->first();
        $hold_date = Setting::where('key', 'box_holding_last_date')->first();
        $cancel_date = Setting::where('key', 'box_cancellation_last_date')->first();
        
        return view('superadmin.settings.index',compact('purchase_date', 'custom_date', 'hold_date', 'cancel_date'));
    }

    public function store(Request $request)
    {

    	$errors = $this->validate($request, [
            'box_purchasing_last_date' => 'required|integer',
            'box_customization_last_date' => 'required|integer',
            'box_holding_last_date' => 'required|integer',
            'box_cancellation_last_date' => 'required|integer',
        ]);
    	$user_id=Auth::user()->id;
    	$data = array_except($request->all(), ['_token']);
    	try {
	    	if(Setting::all()->isEmpty()) {
	    		foreach($data as $key => $item) {
		            $setting = Setting::create([
		                        'user_id' => $user_id,
		                        'key' => $key,
		                        'value' => $item
		                    ]);
		        }       
	    	}else {
	    		foreach($data as $key => $item) {
		            $setting = Setting::where(['user_id' => $user_id, 'key' => $key])->update(['value' => $item]);
	    		}
	    	}
    	}catch(Exception $e) {
    		return response()->json(['code' => 500, 'message' => 'Failed'], 500);
    	}
        $purchase_date = Setting::where('key', 'box_purchasing_last_date')->first();
        $custom_date = Setting::where('key', 'box_customization_last_date')->first();
        $hold_date = Setting::where('key', 'box_holding_last_date')->first();
        $cancel_date = Setting::where('key', 'box_cancellation_last_date')->first();

        flash('Settings has been updated')->important()->success();
        return view('superadmin.settings.index',compact('purchase_date', 'custom_date', 'hold_date', 'cancel_date'));
    }
}
