<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaskAppSeeder extends Seeder
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
                'title' => 'Task 1 Seeded',
                'code' => 'PBI-1',
                'description' => 'Description about this test',
                'rapporteur_id' => 2,
                'responsible_id' => 3,
                'status_id' => 1,
                'author_id' => 1,
            ]
        ];

        foreach ($users as $userData) {

            if(\App\Models\Task::where('code', $userData['code'])->exists()) {
                continue;
            }

            \App\Models\Task::create(
                $userData
            );
        }
    }
}
