<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    public function index()
    {
        // Get countries
        $data = Country::orderBy('created_at', 'desc')->get();
        return CountryResource::collection($data);
    }
}
