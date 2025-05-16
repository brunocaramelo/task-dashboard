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
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::create([
            'name' => 'Coworker',
            'email' => 'coworker@test.com',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::create([
            'name' => 'Stakeholder',
            'email' => 'stakeholder@test.com',
            'password' => Hash::make('password'),
        ]);

    }
}
