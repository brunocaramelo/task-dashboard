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
        return $this->searchQuery($filters)
                ->get();
    }

}
