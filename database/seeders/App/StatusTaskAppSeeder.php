<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Src\Infrastructure\Tasks\Models\StatusTask;

class StatusTaskAppSeeder extends Seeder
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
                'name' => 'Pending',
                'slug' => 'pending',
            ],
            [
                'name' => 'Completed',
                'slug' => 'completed',
            ],
            [
                'name' => 'Blocked',
                'slug' => 'blocked',
            ]
        ];

        foreach ($users as $userData) {
            if(StatusTask::where('slug', $userData['slug'])->exists()) {
                continue;
            }

            StatusTask::create(
                $userData
            );

        }


    }
}
