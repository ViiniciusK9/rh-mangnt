<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        DB::table('users')->insert([
            'department_id' => 1,
            'name' => 'Administrator', 
            'email' => 'admin@rhmangnt.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Aa123456'),
            'role' => 'admin',
            'permissions' => '["admin"]',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // admin details
        DB::table('user_details')->insert([
            'user_id' => 1,
            'address' => 'Bangladesh',
            'zip_code' => '1000',
            'city' => 'Dhaka',
            'phone' => '1234567890',
            'salary' => 10000.00,
            'admission_date' => '2021-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // admin department
        DB::table('departments')->insert([
            'name' => 'Administration',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // RH department
        DB::table('departments')->insert([
            'name' => 'Human Resources',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
