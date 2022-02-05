<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// List customers
Route::get('customers', 'CustomerController@index');
// Create new customer
Route::post('customer', 'CustomerController@store');
// Update customer
Route::put('customer', 'CustomerController@store');
// Delete customer
Route::delete('customer/{id}', 'CustomerController@destroy');
// get countries as a dropdown list
Route::get('countries', 'CountryController@index');
