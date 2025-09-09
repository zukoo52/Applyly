<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       $user = user::create([
        'name' => "test" ,
        'email' => "test@gmail.com",
        'email_verified_at' => Carbon::now(),
        'password' => Hash::make('123456')
       ]);
       return $user;
    }
}
