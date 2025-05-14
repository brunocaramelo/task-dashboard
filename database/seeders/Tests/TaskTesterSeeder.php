<?php

namespace Database\Seeders\Tests;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaskTesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Task::create([
            'title' => 'Task 1',
            'code' => 'task-1',
            'rapporteur_id' => 2,
            'responsible_id' => 3,
            'status_id' => 1,
        ]);
    }
}
