<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\TodoApi\ToDo\Application\GetToDoByCriteriaUseCase;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoId;
use Src\TodoApi\ToDo\Infrastructure\Repositories\EloquentToDoRepository;

final class GetToDoByCriteriaController
{
    private $repository;

    public function __construct(EloquentToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $ToDoId)
    {
        $ToDoId            = $ToDoId;
        
        $getToDoUseCase = new GetToDoByCriteriaUseCase($this->repository);
        $ToDo           = $getToDoUseCase->__invoke($ToDoId);

        return $ToDo;
    }
}
