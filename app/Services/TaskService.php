<?php

namespace App\Services;

use App\Interfaces\TaskInterface;

use App\Events\TaskCreatedSend;
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
        $updatedItem = $this->taskRepository->update($data,$id);

        broadcast(new TaskCreatedSend($updatedItem));

        return $updatedItem;
    }

    public function create(array $data)
    {
        $createdItem =  $this->taskRepository->create($data);

        broadcast(new TaskCreatedSend($createdItem));

        return $createdItem;
    }
    public function getItem($id)
    {
        return $this->taskRepository->getItem($id);
    }
    public function getStatusList()
    {
        return $this->taskRepository->getStatusList();
    }
    public function getStatusWithAllItemList()
    {
        $falseItem = new \App\Models\StatusTask();
        $falseItem->name = 'All';

        $list = $this->taskRepository->getStatusList()->push($falseItem);

        return $list;
    }

}
