<?php

declare(strict_types=1);

namespace Src\Application\Users\Dto;

use Spatie\LaravelData\Data;

class UserDto extends Data
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $id,
    ) {}
}
