<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	 // Assuming you have the image file path, read and convert it to binary
        // $imagePath = asset('storage/';
        // $imageBinary = file_get_contents($imagePath);

        // Employee::create([
        // 	'name' => 'Ehtasham Mehmood',
        // 	'father_name' => 'Mehmood Pervez',
        // 	'cnic' => '32322-3432432-4',
        // 	'dob' => '1994-11-28',
        // 	'contact_no' => '0344-4444444',
        // 	'street_address' => 'Ehtasham Mehmood',
        // 	'city' => 'Islamabad',
        // 	'state' => '',
        // 	'country' => 'Pakistan',
        // 	'experience' => ["title"=>"abc","description"=>null,"from"=>"2023-07-20","to"=>"2023-07-22"],
        // 	'profile_picture' => $imageBinary,
        // 	'status' => 1
        // ]);

        Employee::factory()->times(5)->create();
    }
}
