<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\App\UserAppSeeder;
use Database\Seeders\App\StatusTaskAppSeeder;
use Database\Seeders\App\TaskAppSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UserAppSeeder::class);
        $this->call(StatusTaskAppSeeder::class);
        $this->call(TaskAppSeeder::class);

    }
}
