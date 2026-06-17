<?php

namespace Src\Application\Tasks\UseCases;

use Src\Domain\Tasks\Interfaces\TaskRepository;
use Src\Application\Tasks\Dto\TaskDto;

use Src\Infrastructure\Tasks\Events\TaskUpdatedSend;

class CreateTaskUseCase
{
    public function __construct(
        private TaskRepository $repository
    ) {}

    public function execute(array $data) : TaskDto
    {
        $task = $this->repository->update($data);

        broadcast(
            new TaskUpdatedSend($task)
        );

        return $task;
    }
}
