<?php

//declare(strict_types=1);

namespace Src\TodoApi\ToDo\Application;

use Src\TodoApi\ToDo\Domain\Contracts\ToDoRepositoryContract;
use Src\TodoApi\ToDo\Domain\ToDo;

use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoId;

final class DeleteToDoUseCase
{
    private $repository;

    public function __construct(ToDoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(

        int    $ToDoId

    ): void
    {
        $ToDoId      = new ToDoId($ToDoId);
        $this->repository->delete($ToDoId);
    }
}