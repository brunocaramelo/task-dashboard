<?php

namespace Src\Application\Tasks\UseCases;

use Src\Domain\Tasks\Interfaces\TaskRepositoryInterface;
use Src\Application\Tasks\Dto\TaskDto;

use Src\Infrastructure\Tasks\Events\TaskUpdatedSend;


class UpdateTaskUseCase
{
    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute(array $data,string $id) : TaskDto
    {
        $task = $this->repository->update($data, $id);

        broadcast(
            new TaskUpdatedSend($task)
        );

        return $task;
    }
}
