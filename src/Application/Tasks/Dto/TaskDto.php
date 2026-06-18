<?php

declare(strict_types=1);

namespace Src\Application\Tasks\Dto;

use Spatie\LaravelData\Data;

use Src\Application\Tasks\Dto\StatusTaskDto;
use Src\Application\Tasks\Dto\CommentTaskDto;
use Src\Application\Users\Dto\UserDto;


class TaskDto extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $title,
        public ?string $code,
        public ?int $rapporteur_id,
        public ?int $responsible_id,
        public ?int $author_id,
        public ?int $status_id,
        public ?string $description,
        public ?string $created_at,
        public ?StatusTaskDto $status,
        public ?UserDto $author,
        public ?UserDto $rapporteur,
        public ?UserDto $responsable
    ) {}
}
