<?php

declare(strict_types=1);

namespace Src\Infrastructure\Users\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class EloquentUserRepository implements UserInterface
{
    private $model = User::class;

    public function searchQuery(array $filters) : Builder
    {
        return $this->model::
                when(!empty($filters['name']), function ($query) use ($filters) {
                    $query->where('name', 'LIKE' ,'%'.$filters['name'].'%');
                })
                ->when(!empty($filters['email']), function ($query) use ($filters) {
                    $query->where('email', 'LIKE' ,'%'.$filters['email'].'%');
                });
    }

    public function searchGet(array $filters) : Collection
    {
        return cache()->tags(['usersList'])
            ->remember('usersList:'.json_encode($filters), config('cache.default_duration'), function () use ($filters){
            return $this->searchQuery($filters)
                    ->get();
        });
    }

}
