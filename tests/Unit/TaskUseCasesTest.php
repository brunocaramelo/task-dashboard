<?php

use App\Services\{TaskService,
                CommentTaskService
                };

use App\Repositories\{TaskRepository,
                      CommentTaskRepository
                    };

use Database\Seeders\Tests\{TaskTesterSeeder,
                            StatusTaskTesterSeeder,
                            UserTesterSeeder
                            };


beforeEach(function () {

    runSeeder(StatusTaskTesterSeeder::class);
    runSeeder(UserTesterSeeder::class);
    runSeeder(TaskTesterSeeder::class);

    $this->taskService = new TaskService(new TaskRepository());
    $this->commentTaskService = new CommentTaskService(new CommentTaskRepository());

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

    $this->actingAs(\App\Models\User::first());

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

it('should call insert comment task on the repository', function () {
    $data = [
            'message' => 'Comentando',
            'task_id' => 1,
            'responsible_id' => 2
            ];

    $this->actingAs(\App\Models\User::first());

    $result = $this->commentTaskService->create($data);

    expect($result->task_id)->toBe($data['task_id']);
});

it('should call update comment task on the repository', function () {
    $data = [
            'message' => 'Comentando',
            'task_id' => 1,
            'responsible_id' => 2
            ];

    $this->actingAs(\App\Models\User::first());

    $resultInsert = $this->commentTaskService->create($data);

    $data['message'] = 'Mudei';

    $result = $this->commentTaskService->update($data ,$resultInsert->id);

    expect($result->message)->toBe($data['message']);
});
