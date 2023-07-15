<?php

namespace App\Http\Controllers\ToDo;

use App\Http\Controllers\Controller;
use App\Http\Resources\ToDo\ToDoResource;
use Illuminate\Http\Request;

class UpdateToDoController extends Controller
{
    /**
     * @var \Src\TodoApi\User\Infrastructure\CreateUserController
     */
    private $updateToDoController;

    public function __construct(\Src\TodoApi\ToDo\Infrastructure\UpdateToDoController $updateToDoController)
    {
        $this->updateToDoController = $updateToDoController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $ToDoId)
    {
        
        $newToDO = ($this->updateToDoController->__invoke($request,$ToDoId));
        return response($newToDO, 201);

    }
}