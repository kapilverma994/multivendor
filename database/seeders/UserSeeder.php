<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
         DB::table('users')->insert([ 
             'full_name'=>'Kapil Verma',
             'username'=>'Admin',
             'email'=>'admin@gmail.com',
             'password'=>Hash::make('1111'),
             'role'=>'admin',
             'status'=>'active',



         ]);
         //vendor
         DB::table('users')->insert([ 
            'full_name'=>'kapil Vendor ',
            'username'=>'Vendor',
            'email'=>'vendor@gmail.com',
            'password'=>Hash::make('1111'),
            'role'=>'vendor',
            'status'=>'active',



        ]);
        //customer
        DB::table('users')->insert([ 
            'full_name'=>'kapil Customer ',
            'username'=>'Customer',
            'email'=>'customer@gmail.com',
            'password'=>Hash::make('1111'),
            'role'=>'customer',
            'status'=>'active',



        ]);
    }
}
