<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Country::truncate();
    	$names = ['Cameron', 'Ethiobia', 'Morocco', 'Mozampique', 'Uganda'];
    	$codes = ['+237', '+251', '+212', '+258', '+256'];
    	$regex = [
    		'\(237\)\ ?[2368]\d{7,8}$', 
    		'\(251\)\ ?[1-59]\d{8}$', 
    		'\(212\)\ ?[5-9]\d{8}$', 
    		'\(258\)\ ?[28]\d{7,8}$', 
    		'\(256\)\ ?\d{9}$'
    	];
    	foreach ($names as $key => $value) {
		    	Country::create([
		    		'name'  => $value,
		    		'code'  => $codes[$key],
		    		'regex' => $regex[$key],
		    	]);
		}
    }
}
