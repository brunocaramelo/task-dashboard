<?php

use function Pest\Laravel\{actingAs , get, post, put};
use Inertia\Testing\AssertableInertia;
use Database\Seeders\DatabaseTestSeeder;

beforeEach(function () {
    runSeeder(DatabaseTestSeeder::class);
});

function getMockUserToSession()
{
    return \App\Models\User::first();
}

it('renders the dashboard page with correct data', function () {

    actingAs(getMockUserToSession())
        ->get('/dashboard')
        ->assertInertia(fn (AssertableInertia $page) =>
            $page->component('Dashboard')
                ->has('lastsTasks')
                ->has('counters', 3)
        );

    // $response = $this->actingAs(getMockUserToSession())
    //              ->get('/dashboard');

    // dd($response->status(),
    // $response->headers->all(),
    // );
});

it('renders the task search page with correct data', function () {

    actingAs(getMockUserToSession())
        ->get('/tasks')
        ->assertInertia(fn (AssertableInertia $page) =>
            $page->component('Tasks/Dashboard/Index')
                ->has('results')
                ->has('statusList.data', 4)
                ->where('results.data.0.code', 'task-1')
                ->has('params')
        );
});

it('renders the task create page with correct data', function () {

    actingAs(getMockUserToSession())
        ->get('/tasks/new')
        ->assertInertia(fn (AssertableInertia $page) =>
            $page->component('Tasks/New')
                ->has('users')
                ->has('statusList.data', 3)
                ->where('users.data.0.email', 'admin@test.com')
        );
});

it('renders the task update page with correct data', function () {

    actingAs(getMockUserToSession())
        ->get('/tasks/1')
        ->assertInertia(fn (AssertableInertia $page) =>
            $page->component('Tasks/Edit')
                ->has('users')
                ->has('task')
                ->has('statusList.data', 3)
                ->where('users.data.0.email', 'admin@test.com')
                ->where('task.data.code', 'task-1')
        );

});

it('use the task create API with success', function () {

    actingAs(getMockUserToSession())
        ->post('/tasks', [
            'title' => 'Test Task New',
            'description' => 'This is a test post content.',
            'rapporteur_id' => 2,
            'responsible_id' => 3,
            'status_id' => 1,
        ])
        ->assertCreated()
        ->assertJsonFragment([
            'title' => 'Test Task New',
            'description' => 'This is a test post content.',
            'rapporteur_id' => 2,
            'responsible_id' => 3,
            'status_id' => 1,
        ]);

});

it('use the task update API with success', function () {

    actingAs(getMockUserToSession())
        ->put('/tasks/1', [
            'title' => 'Test Task New Changed',
        ])
        ->assertOk()
        ->assertJsonFragment([
            'code' => 'task-1',
            'title' => 'Test Task New Changed',
        ]);

});

it('use the task create API with fail', function () {

    actingAs(getMockUserToSession())
        ->post('/tasks', [
            'title' => 'Test Task New',
        ])
        ->assertInvalid([
            "rapporteur_id" => "The rapporteur id field is required.",
            "responsible_id" => "The responsible id field is required.",
            "status_id" =>  "The status id field is required.",
            "description" => "The description field is required."
        ]);
});

it('use the task update API with fail', function () {

    actingAs(getMockUserToSession())
        ->put('/tasks/1', [
            'title' => 1,
            'description' => 1,
        ])
        ->assertInvalid([
            "title" => "The title field must be a string.",
            "description" => "The description field must be a string."
        ]);
});