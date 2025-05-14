<?php

namespace App\Services;

use App\Interfaces\CommentTaskInterface;
class CommentTaskService
{
    private $commentTaskRepository;

    public function __construct(CommentTaskInterface $commentTaskRepository)
    {
        $this->commentTaskRepository = $commentTaskRepository;
    }

    public function update(array $data, $id)
    {
        return $this->commentTaskRepository->update($data,$id);
    }
    public function create(array $data)
    {
        return $this->commentTaskRepository->create($data);
    }

}
