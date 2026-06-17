<?php

declare(strict_types=1);

namespace Src\Domain\Users\Interfaces;

interface UserRepositoryInterface
{
    public function searchGet(array $filters);
}
