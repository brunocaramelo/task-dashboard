<?php

declare(strict_types=1);

namespace Src\Application\Tasks\Dto;

use Spatie\LaravelData\Data;

class CommentTaskDto extends Data
{
    public function __construct(
        public ?string $message,
        public ?string $task_id,
        public ?string $responsible_id,
    ) {}
}
