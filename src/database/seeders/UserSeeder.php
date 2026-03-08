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
        DB::table('users')->insert([
            [
                'name' => '田中太郎',
                'email' => 'test1@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' =>now(),
                'postal_code' => '987-6543',
                'address' => '東京都千代田区',
                'building' => 'コーポ太郎',
                'profile_image' => 'images/default.jpg',
            ],
            [
                'name' => '山田花子',
                'email' => 'test2@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' =>now(),
                'postal_code' => '123-4567',
                'address' => '大阪府大阪市○○町',
                'building' => 'コーポ花子',
                'profile_image' => 'images/default.jpg',
            ],
        ]);
    }
}
