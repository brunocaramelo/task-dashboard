<?php

namespace Src\Application\Users\UseCases;

use Src\Domain\Users\Interfaces\UserRepositoryInterface;
use Src\Application\Users\Dto\UserDto;

class GetTaskStatusListUseCase
{
    public function __construct(
        private TaskRepository $repository
    ) {}

    public function execute(bool $allItems = false): TaskDto
    {
        $items = $this->repository->getStatusList($filters);

        if ($allItems) {
            $all = new StatusTask();
            $all->name = 'All';

            $items->push($all);
        }

        return $items;
    }
}
