<?php

use Src\Application\Users\UseCases\UserSearchGetUseCase;

use Src\Application\Tasks\UseCases\{CreateTaskUseCase,
                                    GetTaskByIdUseCase,
                                    GetTaskStatusListUseCase,
                                    SearchTasksUseCase,
                                    UpdateTaskUseCase};

use Src\Infrastructure\Tasks\Repositories\EloquentTaskRepository;
use Src\Infrastructure\Users\Repositories\EloquentUserRepository;

use Database\Seeders\DatabaseTestSeeder;

beforeEach(function () {

    runSeeder(DatabaseTestSeeder::class);

    $this->actingAs(\Src\Infrastructure\Users\Models\User::first());

    $this->createTaskUseCase = new CreateTaskUseCase(new EloquentTaskRepository());
    $this->getTaskByIdUseCase = new GetTaskByIdUseCase(new EloquentTaskRepository());
    $this->getTaskStatusListUseCase = new GetTaskStatusListUseCase(new EloquentTaskRepository());
    $this->searchTasksUseCase = new SearchTasksUseCase(new EloquentTaskRepository());
    $this->updateTaskUseCase = new UpdateTaskUseCase(new EloquentTaskRepository());
    $this->userSearchGetUseCase = new UserSearchGetUseCase(new EloquentUserRepository());

});



it('should call searchPaginate on the repository with the given filters', function () {

    $result = $this->searchTasksUseCase->execute(['code' => 'task-1', 'status' => '1']);

    expect($result->total())->toBe(1);
});

it('should call update on the repository with the given data and id', function () {

    $data = ['title' => 'Updated Task'];
    $id = 1;

    $result = $this->updateTaskUseCase->execute($data, $id);

    expect($result->title)->toBe($data['title']);
});

it('should call create on the repository with the given data', function () {

    $data = ['title' => 'New Task',
             'code' => 'task-2',
             'rapporteur_id' => 1,
             'responsible_id' => 2,
             'status_id' => 1,
            ];

    $result = $this->createTaskUseCase->execute($data);

    expect($result->title)->toBe($data['title']);
});

it('should call getItem on the repository with the given id', function () {
    $id = 1;
    $data = ['slug' => 'task-1'];

    $result = $this->getTaskByIdUseCase->execute($id);

    expect($result->code)->toBe($data['slug']);
});

it('should call getStatusList on the repository', function () {
    $statusList = ['pending', 'completed', 'blocked'];

    $result = $this->getTaskStatusListUseCase->execute()->pluck('slug')->toArray();

    expect($result)->toBe($statusList);
});

it('should call getListUsers on the userService', function () {
    $email = 'coworker@test.com';

    $result = $this->userSearchGetUseCase->execute([]);

    expect($result[1]->email)->toBe($email);
});

