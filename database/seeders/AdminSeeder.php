<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $picked = User::where('role', 'admin')->first();
        if($picked) {
        	dd('Admin Already Exist');
        }else {
        	User::create(
        		[
        			'role'              => 'admin',
        			'username'          => 'ADMIN-00123',
        			'name'              => 'Admin User',
        			'email'             => 'admin@gmail.com',
        			'mobile_number'     => '9999999999',
        			'phone_number'      => '999999999',
        			'dob'               => '1990-01-21',
        			'address'           => 'Lucknow',
        			'about_me'          => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ',
        			'company_name'      => 'Web Mingo It Private Limited',
        			'password'          => \Hash::make(123),
        		]
        	);
        	dd('Admin User Created Successfully.');
        }
    }
}
