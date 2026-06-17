<?php

declare(strict_types=1);

namespace Src\Domain\Tasks\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Task;
use Src\Application\Tasks\Dto\TaskDto;

interface TaskRepositoryInterface
{
    public function searchPaginate(array $filters) : LengthAwarePaginator;
    public function update(array $data, $id) : TaskDto;
    public function create(array $data) : TaskDto;
    public function getItem($idItem) : Task;
    public function getStatusList() : Collection;
}
