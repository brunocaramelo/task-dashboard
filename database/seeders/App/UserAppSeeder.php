<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Coworker',
                'email' => 'coworker@test.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Stakeholder',
                'email' => 'stakeholder@test.com',
                'password' => Hash::make('password')
            ]
        ];

        foreach ($users as $userData) {

            if(\App\Models\User::where('email', $userData['email'])->exists()) {
                continue;
            }

            \App\Models\User::create(
                $userData
            );
        }

    }
}
