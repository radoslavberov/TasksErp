<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'        => 'George',
            'last_name'         => 'Michaels',
            'phone_number'      => "+359888123123",
            'email'             => "admin@soft.com",
            'email_verified_at' => now(),
            'password'          => '$2a$12$t1P8XEMuA7lx9L1ntNm1xusb4tLK8vjfYfL1EF8MCQXS4iNxj3Lnq', // parolaa
            'remember_token'    => Str::random(10),
        ])->assignRole('admin');


        User::create([
            'first_name'        => 'Ivan',
            'last_name'         => 'Ivanov',
            'phone_number'      => "+359888553335",
            'email'             => "ivan@soft.com",
            'email_verified_at' => now(),
            'password'          => '$2a$12$t1P8XEMuA7lx9L1ntNm1xusb4tLK8vjfYfL1EF8MCQXS4iNxj3Lnq', // parolaa
            'remember_token'    => Str::random(10),
        ])->assignRole('employee');
    }
}
