<?php

declare(strict_types=1);

namespace Src\Domain\Tasks\Interfaces;

use Src\Application\Tasks\Dto\CommentTaskDto;

interface CommentTasRepositoryInterface
{
    public function update(array $data, $id) : CommentTaskDto;
    public function create(array $data) : CommentTaskDto;

}
