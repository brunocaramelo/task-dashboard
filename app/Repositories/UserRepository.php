<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;

class UserRepository implements UserInterface
{    private $model = User::class;

    public function searchQuery(array $filters)
    {
        return $this->model::
                when(!empty($filters['name']), function ($query) use ($filters) {
                    $query->where('name', 'LIKE' ,'%'.$filters['name'].'%');
                })
                ->when(!empty($filters['email']), function ($query) use ($filters) {
                    $query->where('email', 'LIKE' ,'%'.$filters['email'].'%');
                });
    }

    public function searchGet(array $filters)
    {
        return cache()->tags(['usersList'])
            ->remember('usersList:'.json_encode($filters), config('cache.default_duration'), function () use ($filters){
            return $this->searchQuery($filters)
                    ->get();
        });
    }

}
