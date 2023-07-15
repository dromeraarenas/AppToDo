<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Application;

use Src\TodoApi\ToDo\Domain\ToDo;
use Src\TodoApi\ToDo\Domain\Contracts\ToDoRepositoryContract;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoUserId;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoName;
use Illuminate\Database\Eloquent\Collection;

final class GetAllToDoByUserUseCase
{
    private $repository;

    public function __construct(ToDoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): ?string
    {

        $ToDos = $this->repository->findAllByUser();
        return $ToDos;

    }
}
