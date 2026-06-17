<?php

declare(strict_types=1);

namespace Src\Application\Tasks\Dto;

use Spatie\LaravelData\Data;

class StatusTaskDto extends Data
{
    public function __construct(
        public ?string $id,
        public ?string $name,
        public ?string $slug,
        public ?string $created_at,
    ) {}
}
