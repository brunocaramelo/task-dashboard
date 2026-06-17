<?php

namespace Src\Application\Tasks\UseCases;

use Src\Domain\Users\Interfaces\UserRepositoryInterface;
use Src\Application\Users\Dto\UserDto;
use Src\Domain\Tasks\Interfaces\TaskRepositoryInterface;
use Src\Application\Tasks\Dto\TaskDto;

class GetTaskByIdUseCase
{
    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute(int $id): TaskDto
    {
        return $this->repository->getItem($id);
    }
}
