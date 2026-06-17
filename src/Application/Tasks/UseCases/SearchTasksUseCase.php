<?php

namespace Src\Application\Tasks\UseCases;

use Src\Domain\Users\Interfaces\UserRepositoryInterface;
use Src\Application\Users\Dto\UserDto;
use Src\Domain\Tasks\Interfaces\TaskRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchTasksUseCase
{
    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute(array $filters): LengthAwarePaginator
    {
        return $this->repository->searchPaginate($filters);
    }
}
