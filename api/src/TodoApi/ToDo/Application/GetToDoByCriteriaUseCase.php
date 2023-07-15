<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Application;

use Src\TodoApi\ToDo\Domain\ToDo;
use Src\TodoApi\ToDo\Domain\Contracts\ToDoRepositoryContract;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoId;

final class GetToDoByCriteriaUseCase
{
    private $repository;

    public function __construct(ToDoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $toDoId): ?string
    {

        $id = new ToDoId($toDoId);
        $ToDo = $this->repository->find($id);
        return $ToDo;

    }
}
