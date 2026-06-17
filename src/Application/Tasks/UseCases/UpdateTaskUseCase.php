<?php

namespace Src\Application\Tasks\UseCases;

use Src\Domain\Tasks\Interfaces\TaskRepository;
use Src\Application\Tasks\Dto\TaskDto;

use Src\Infrastructure\Tasks\Events\TaskCreatedSend;

class UpdateTaskUseCase
{
    public function __construct(
        private TaskRepository $repository
    ) {}

    public function execute(array $data,string $id) : TaskDto
    {
        $task = $this->repository->update($data, $id);

        broadcast(
            new TaskCreatedSend($task)
        );

        return $task;
    }
}
