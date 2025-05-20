<?php

namespace App\Services;

use App\Interfaces\TaskInterface;

use App\Resources\{TaskResource,
                  TaskResourcePaginate,
                  StatusTaskResource,
                  StatusTaskSimpleCollection};

use App\Events\{TaskCreatedSend,
                TaskUpdatedSend};
class TaskService
{
    private $taskRepository;

    public function __construct(TaskInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    public function searchPaginate(array $filters)
    {
        return new TaskResourcePaginate($this->taskRepository->searchPaginate($filters));
    }
    public function update(array $data, $id)
    {
        $updatedItem = new TaskResource($this->taskRepository->update($data,$id));

        broadcast(new TaskUpdatedSend($updatedItem))->toOthers();

        return $updatedItem;
    }

    public function create(array $data)
    {
        $createdItem =  new TaskResource($this->taskRepository->create($data));

        broadcast(new TaskCreatedSend($createdItem));

        return $createdItem;
    }
    public function getItem($id)
    {
        return new TaskResource($this->taskRepository->getItem($id));
    }
    public function getStatusList()
    {
        return new StatusTaskSimpleCollection($this->taskRepository->getStatusList());
    }
    public function getStatusWithAllItemList()
    {
        $falseItem = new \App\Models\StatusTask();
        $falseItem->name = 'All';

        $list = new StatusTaskSimpleCollection($this->taskRepository->getStatusList()->push($falseItem));

        return $list;
    }

}
