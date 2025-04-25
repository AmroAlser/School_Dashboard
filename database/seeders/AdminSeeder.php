<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run()
     {
         User::create([
             'name' => 'Super Admin',
             'email' => 'admin@school.com',
             'password' => Hash::make('password123'),
         ]);
     }
}
