<?php

namespace App\Http\Controllers\ToDo;

use App\Http\Controllers\Controller;
use App\Http\Resources\ToDo\ToDoResource as ToDoToDoResource;
use Illuminate\Http\Request;

class DeleteToDoController extends Controller
{
    /**
     * @var \Src\TodoApi\User\Infrastructure\CreateUserController
     */
    private $deleteToDoController;

    public function __construct(\Src\TodoApi\ToDo\Infrastructure\DeleteToDoController $deleteToDoController)
    {
        $this->deleteToDoController = $deleteToDoController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $ToDoId)
    {
        
        return $this->deleteToDoController->__invoke($ToDoId);

    }
}