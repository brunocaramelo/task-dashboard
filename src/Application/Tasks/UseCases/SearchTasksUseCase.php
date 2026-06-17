<?php

namespace Src\Application\Users\UseCases;

use Src\Domain\Users\Interfaces\UserRepositoryInterface;
use Src\Application\Users\Dto\UserDto;

class GetTaskByIdUseCase
{
    public function __construct(
        private TaskRepository $repository
    ) {}

    public function execute(array $filters): TaskDto
    {
        return $this->repository->searchPaginate($filters);
    }
}
