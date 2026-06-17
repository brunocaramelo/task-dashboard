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
        public ?string $id,
        public ?string $title,
        public ?string $code,
        public ?string $rapporteur_id,
        public ?string $responsible_id,
        public ?string $author_id,
        public ?string $status_id,
        public ?string $description,
        public ?string $created_at,
        public ?StatusTaskDto $status,
        public ?UserDto $author,
        public ?UserDto $rapporteur,
        public ?UserDto $responsable
    ) {}
}
