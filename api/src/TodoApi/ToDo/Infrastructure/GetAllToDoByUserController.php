<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Infrastructure;

use Illuminate\Http\Request;
use Src\TodoApi\ToDo\Application\GetAllToDoByUserUseCase;
use Src\TodoApi\ToDo\Infrastructure\Repositories\EloquentToDoRepository;

final class GetAllToDoByUserController
{
    private $repository;

    public function __construct(EloquentToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
       
        $getToDoUseCase = new GetAllToDoByUserUseCase($this->repository);
        $ToDo           = $getToDoUseCase->__invoke();

        return $ToDo;
    }
}
