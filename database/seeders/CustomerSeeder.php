<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::truncate();

    	$names = [
    		'First', 'Second', 'Third', 'Fourth', 'Fifth', 'sixth', 'seventh', 'eighth', 'ninth','Ten',
    		'First1','Second1', 'Third1', 'Fourth1', 'Fifth1', 'sixth1', 'seventh1', 'eighth1','ninth1','Ten1'
    	];
    	$countries = [3, 3, 3, 2, 2, 3, 2, 4, 3, 2, 3, 3, 3, 2, 2, 3, 2, 4, 3, 2];
    	$phones = [
    		'212566775544', '212566775545', '212566775546', '251566775547', '251566775548',
    		'212566775531', '251566775532', '212566775533', '258566775560', '251566775550',
    		'212566775544', '212566775545', '212566775546', '251566775547', '251566775548',
    		'212566775531', '251566775532', '212566775533', '258566775560', '251566775550'
    	];
    	$statuses = [
    		'1', '1', '0', '0', '1', '1', '1', '0', '0', '1',
    		'1', '1', '0', '0', '1', '1', '1', '0', '0', '1'
    	];

    	foreach ($names as $key => $value) {
		    	Customer::create([
		    		'name'        => $value,
		    		'country_id'  => $countries[$key],
		    		'phone'       => $phones[$key],
		    		'status'      => $statuses[$key],
		    	]);
		}
    }
}
