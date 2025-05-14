<?php

namespace Database\Seeders\Tests;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StatusTaskTesterSeeder extends Seeder
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
    }
}
