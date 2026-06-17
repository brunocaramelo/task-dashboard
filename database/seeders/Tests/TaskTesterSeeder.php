<?php

namespace Database\Seeders\Tests;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Src\Infrastructure\Tasks\Models\Task;

use Src\Infrastructure\Tasks\Models\StatusTask;
use Src\Infrastructure\Users\Models\User;

class TaskTesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'title' => 'Task 1',
            'code' => 'task-1',
            'rapporteur_id' => User::skip(1)->first()->id,
            'responsible_id' => User::latest()->first()->id,
            'status_id' => StatusTask::first()->id,
            'author_id' => User::first()->id,
        ]);
    }
}
