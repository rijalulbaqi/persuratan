<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Cabang',
            'email' => 'pc@gmail.com',
            'password' => Hash::make('pc123'),
            'role' => 'pc',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Komisariat',
            'email' => 'pr@gmail.com',
            'password' => Hash::make('pr123'),
            'role' => 'pc',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Rayon',
            'email' => 'pr@gmail.com',
            'password' => Hash::make('pr123'),
            'role' => 'pc',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
    }
}
