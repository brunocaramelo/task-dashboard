<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StatusTaskAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StatusTask::create([
            'name' => 'Pending',
            'slug' => 'pending',
        ]);

        \App\Models\StatusTask::create([
            'name' => 'Completed',
            'slug' => 'completed',
        ]);

        \App\Models\StatusTask::create([
            'name' => 'Blocked',
            'slug' => 'blocked',
        ]);
    }
}
