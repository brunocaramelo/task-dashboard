<?php

namespace Src\Application\Tasks\UseCases;

use Src\Domain\Users\Interfaces\UserRepositoryInterface;
use Src\Application\Users\Dto\UserDto;

class GetTaskByIdUseCase
{
    public function __construct(
        private TaskRepository $repository
    ) {}

    public function execute(int $id): TaskDto
    {
        return $this->repository->findById($id);
    }
}
