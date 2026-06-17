<?php

namespace Src\Application\Tasks\UseCases;

use Src\Domain\Users\Interfaces\UserRepositoryInterface;
use Src\Application\Users\Dto\UserDto;
use Src\Domain\Tasks\Interfaces\TaskRepositoryInterface;
use Src\Application\Tasks\Dto\TaskDto;
use Src\Infrastructure\Tasks\Models\StatusTask;
use Illuminate\Support\Collection;

class GetTaskStatusListUseCase
{
    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute(bool $allItems = false): Collection
    {
        $items = $this->repository->getStatusList($allItems);

        if ($allItems) {
            $all = new StatusTask();
            $all->name = 'All';

            $items->push($all);
        }

        return $items;
    }
}
