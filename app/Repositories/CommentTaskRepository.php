<?php

namespace App\Repositories;

use App\Models\CommentTask;
use App\Interfaces\CommentTaskInterface;

class CommentTaskRepository implements CommentTaskInterface
{
    private $model = CommentTask::class;

    public function update(array $data, $id)
    {
        return $this->model::find($id)->update($data);
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }
}
