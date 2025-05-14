<?php

use App\Services\TaskService;
use App\Repositories\TaskRepository;
use Illuminate\Pagination\LengthAwarePaginator;

use Database\Seeders\Tests\{TaskTesterSeeder,
                            StatusTaskTesterSeeder,
                            UserTesterSeeder
                            };


beforeEach(function () {

    runSeeder(StatusTaskTesterSeeder::class);
    runSeeder(UserTesterSeeder::class);
    runSeeder(TaskTesterSeeder::class);

    $this->taskService = new TaskService(new TaskRepository());

});



it('should call searchPaginate on the repository with the given filters', function () {

    $result = $this->taskService->searchPaginate(['code' => 'task-1', 'status' => '1']);

    expect($result->total())->toBe(1);
});

it('should call update on the repository with the given data and id', function () {

    $data = ['title' => 'Updated Task'];
    $id = 1;

    $result = $this->taskService->update($data, $id);

    // Assert
    expect($result->title)->toBe($data['title']);
});

it('should call create on the repository with the given data', function () {

    $data = ['title' => 'New Task',
             'code' => 'task-2',
             'rapporteur_id' => 1,
             'responsible_id' => 2,
             'status_id' => 1,
            ];

    $result = $this->taskService->create($data);

    expect($result->title)->toBe($data['title']);
});

it('should call getItem on the repository with the given id', function () {
    $id = 1;
    $data = ['slug' => 'task-1'];

    $result = $this->taskService->getItem($id);

    expect($result->code)->toBe($data['slug']);
});

it('should call getStatusList on the repository', function () {
    $statusList = ['pending'];

    $result = $this->taskService->getStatusList()->pluck('slug')->toArray();

    expect($result)->toBe($statusList);
});
