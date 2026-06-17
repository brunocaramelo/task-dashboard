<?php

declare(strict_types=1);

namespace Src\Application\Users\Dto;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public ?string $aome,
        public ?string $email,
        public ?string $id,
    ) {}
}
