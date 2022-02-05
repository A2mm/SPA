<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use App\Models\Country;
use Validator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
    	$country_filter = $request->country_filter;
    	$status_filter  = $request->status_filter;
        
        // case (no filter) >>> return all
    	if ($country_filter == 0 && $status_filter == 3) {
    		$data = Customer::orderBy('created_at', 'desc')->paginate(5);
    	}
        // case filter with status only
    	elseif($country_filter == 0 && $status_filter != 3) {
    		$data = Customer::where('status', $status_filter)->orderBy('created_at', 'desc')->paginate(5);
    	}
        // case filter with cuntry only
    	elseif($country_filter != 0 && $status_filter == 3) {
    		$data = Customer::where('country_id', $country_filter)->orderBy('created_at', 'desc')->paginate(5);
    	}
        // case filter with all (country && state)
    	else{
    		$data = Customer::where('country_id', $country_filter)->where('status', $status_filter)
    		                ->orderBy('created_at', 'desc')->paginate(5);
    	}
        // Return collection of customers as a resource
         return CustomerResource::collection($data);
    }

    public function store(Request $request)
    {
        $customer  = $request->isMethod('put') ? Customer::findOrFail($request->customer_id) : new Customer;
        $regex     = Country::where('id', $request->country_id)->select('id', 'regex')->first()->regex;
        // check if phone entered matcing with selected country 
        // not matching  >>> set status as 0 (Nok)
        // case matching >>> set status as 1 (Ok)
        // hint >>> it should be blocked as valdation
        $validator = Validator::make($request->all(), [
          'phone'       => 'regex:/'.$regex.'/',
        ]);

        if ($validator->fails()) {
            $status = 0;   
        }else{
            $status = 1;
        }
            $customer->id            = $request->input('customer_id');
            $customer->country_id    = $request->input('country_id');
            $customer->name          = $request->input('name');
            $customer->phone         = $request->input('phone');
            $request->status         = $status;
                if($customer->save()) {
                   return new CustomerResource($customer);
                }
    }
}