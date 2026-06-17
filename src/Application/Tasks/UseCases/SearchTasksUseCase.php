<?php

namespace Src\Application\Tasks\UseCases;

use Src\Domain\Users\Interfaces\UserRepositoryInterface;
use Src\Application\Users\Dto\UserDto;

class SearchTasksUseCase
{
    public function __construct(
        private TaskRepository $repository
    ) {}

    public function execute(array $filters): TaskDto
    {
        return $this->repository->searchPaginate($filters);
    }
}
