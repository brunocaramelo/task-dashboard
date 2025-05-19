<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\Tests\{UserTesterSeeder,
                            StatusTaskTesterSeeder,
                            TaskTesterSeeder};


class DatabaseTestSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UserTesterSeeder::class);
        $this->call(StatusTaskTesterSeeder::class);
        $this->call(TaskTesterSeeder::class);

    }
}
