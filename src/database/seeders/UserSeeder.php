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
            ],
            [
                'name' => '山田花子',
                'email' => 'test2@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' =>now(),
            ],
        ]);
    }
}
