<?php

namespace Database\Seeders\Tests;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Src\Infrastructure\Tasks\Models\StatusTask;

class StatusTaskTesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusTask::create([
            'name' => 'Pending',
            'slug' => 'pending',
        ]);

        StatusTask::create([
            'name' => 'Completed',
            'slug' => 'completed',
        ]);

        StatusTask::create([
            'name' => 'Blocked',
            'slug' => 'blocked',
        ]);
    }
}
