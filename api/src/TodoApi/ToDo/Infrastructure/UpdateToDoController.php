<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Infrastructure;

use Illuminate\Http\Request;
use Src\TodoApi\ToDo\Application\UpdateToDoUseCase;
use Src\TodoApi\ToDo\Application\GetToDoByCriteriaUseCase;
use Src\TodoApi\ToDo\Infrastructure\Repositories\EloquentToDoRepository;
use Illuminate\Support\Facades\Auth;

final class UpdateToDoController
{
    private $repository;

    public function __construct(EloquentToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request, int $ToDoId)
    {
    
        $ToDoId           = $ToDoId;
        $ToDoUserId       = Auth::id();
        $ToDoName         = $request->input('name');
        $ToDoDescription  = $request->input('description');
        $ToDoStatus       = $request->input('status');
        $ToDoCategories   = $request->input('categories');

        $updateToDoUseCase = new UpdateToDoUseCase($this->repository);

        $responseUpdatedToDo=$updateToDoUseCase->__invoke(
            
            $ToDoId,
            $ToDoUserId,
            $ToDoName,
            $ToDoDescription,
            $ToDoStatus,
            $ToDoCategories
            
        );

        //$getToDoByCriteriaUseCase = new GetToDoByCriteriaUseCase($this->repository);
        //$newToDo                  = $getToDoByCriteriaUseCase->__invoke($ToDoUserId,$ToDoName);

        return $responseUpdatedToDo;

    }
}
