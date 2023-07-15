<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Domain\Contracts;

use Src\TodoApi\ToDo\Domain\ToDo;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoId;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoUserId;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoName;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoDescription;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoStatus;
use Illuminate\Database\Eloquent\Collection;

interface ToDoRepositoryContract
{
    public function find(ToDoId $id): ?string;

    public function findAllByUser(): ?string;

    public function save(ToDo $ToDo): int;

    public function update(ToDoId $ToDoId, ToDo $ToDo): ?string;

    public function delete(ToDoId $id): void;
}
