<?php

namespace App\Services;

use App\Interfaces\TaskInterface;
class TaskService
{
    private $taskRepository;

    public function __construct(TaskInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    public function searchPaginate(array $filters)
    {
        return $this->taskRepository->searchPaginate($filters);
    }
    public function update(array $data, $id)
    {
        return $this->taskRepository->update($data,$id);
    }
    public function create(array $data)
    {
        return $this->taskRepository->create($data);
    }
    public function getItem($id)
    {
        return $this->taskRepository->getItem($id);
    }
    public function getStatusList()
    {
        return $this->taskRepository->getStatusList();
    }

}
