<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Src\Infrastructure\Tasks\Models\Task;

use Src\Infrastructure\Tasks\Models\StatusTask;
use Src\Infrastructure\Users\Models\User;


class TaskAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userskAll = User::all();

        $users = [
            [
                'title' => 'Task 1 Seeded',
                'code' => 'PBI-1',
                'description' => 'Description about this test',
                'rapporteur_id' => User::skip(1)->first()->id,
                'responsible_id' => User::latest()->first()->id,
                'status_id' => StatusTask::first()->id,
                'author_id' => User::first()->id,
            ]
        ];

        foreach ($users as $userData) {

            if(Task::where('code', $userData['code'])->exists()) {
                continue;
            }

            Task::create(
                $userData
            );
        }
    }
}
