<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('users')->count() == 0) {
            $user =  [

                'name' => 'Admin',

                'role' => 'admin',

                'email' => 'admin@gmail.com',

                'password' => Hash::make('password'),

                'phone' => '9810101010'


            ];
            User::insert($user);
        }
    }
}
