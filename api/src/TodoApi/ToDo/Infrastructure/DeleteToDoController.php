<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Infrastructure;

use Illuminate\Http\Request;
use Src\TodoApi\ToDo\Application\DeleteToDoUseCase;
use Src\TodoApi\ToDo\Infrastructure\Repositories\EloquentToDoRepository;
use Illuminate\Support\Facades\Auth;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoId;

final class DeleteToDoController
{
    private $repository;

    public function __construct(EloquentToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $ToDoId)
    {
        $ToDoId            = $ToDoId;

        $deleteToDoUseCase = new DeleteToDoUseCase($this->repository);

        $deleteToDoUseCase->__invoke(
            
            $ToDoId
            
        );

        return response(201);

    }
}