<?php

namespace Src\Application\Tasks\UseCases;

use Src\Domain\Tasks\Interfaces\TaskRepositoryInterface;
use Src\Application\Tasks\Dto\TaskDto;

use Src\Infrastructure\Tasks\Events\TaskCreatedSend;


class CreateTaskUseCase
{
    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute(array $data) : TaskDto
    {
        $task = $this->repository->create($data);

        broadcast(
            new TaskCreatedSend($task)
        );

        return $task;
    }
}
