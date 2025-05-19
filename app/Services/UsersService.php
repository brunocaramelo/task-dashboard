<?php

namespace App\Services;

use App\Interfaces\UserInterface;

use App\Resources\UserSimpleCollection;

class UsersService
{
    private $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function searchGet(array $data)
    {
        return new UserSimpleCollection($this->userRepository->searchGet($data));
    }
}
