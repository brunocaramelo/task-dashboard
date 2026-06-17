<?php

declare(strict_types=1);

namespace Src\Infrastructure\Tasks\Repositories;

use App\Models\CommentTask;
use App\Interfaces\CommentTaskInterface;
use Src\Application\Tasks\Dto\CommentTaskDto;

class EloquentCommentTaskRepository implements CommentTaskInterface
{
    private $model = CommentTask::class;

    public function update(array $data, $id) : CommentTaskDto
    {
        $this->model::find($id)->update($data);

        return $this->model::find($id);
    }

    public function create(array $data) : CommentTaskDto
    {
        return $this->model::create($data);
    }
}
