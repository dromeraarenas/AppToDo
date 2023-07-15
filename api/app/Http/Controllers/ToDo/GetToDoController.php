<?php

namespace App\Http\Controllers\ToDo;

use App\Http\Controllers\Controller;
use App\Http\Resources\ToDo\ToDoListResource;
use Illuminate\Http\Request;

class GetToDoController extends Controller
{
    /**
     * @var \Src\TodoApi\User\Infrastructure\CreateUserController
     */
    private $getToDoController;

    public function __construct(\Src\TodoApi\ToDo\Infrastructure\GetToDoByCriteriaController $getToDoController)
    {
        $this->getToDoController = $getToDoController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $ToDoId)
    {
        
        $ToDoList=$this->getToDoController->__invoke($ToDoId);
        return response ($ToDoList, 201);

    }
}