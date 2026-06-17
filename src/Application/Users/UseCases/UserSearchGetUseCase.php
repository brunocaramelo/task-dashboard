<?php

namespace Src\Application\Users\UseCases;

use Src\Domain\Users\Interfaces\UserRepositoryInterface;

use App\Resources\UserSimpleCollection;

class UserSearchGetUseCase
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(array $data)
    {
        return $this->userRepository->searchGet($data);
    }
}
