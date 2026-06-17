<?php

declare(strict_types=1);

namespace Src\Infrastructure\Tasks\Repositories;

use Src\Infrastructure\Tasks\Models\CommentTask;

use Src\Domain\Tasks\Interfaces\TaskRepositoryInterface;
use Src\Application\Tasks\Dto\CommentTaskDto;

class EloquentCommentTaskRepository implements TaskRepositoryInterface
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
