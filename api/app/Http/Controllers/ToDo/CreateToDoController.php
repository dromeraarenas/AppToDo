<?php

namespace App\Http\Controllers\ToDo;

use App\Http\Controllers\Controller;
use App\Http\Resources\ToDo\ToDoResource as ToDoToDoResource;
use Illuminate\Http\Request;

class CreateToDoController extends Controller
{
    /**
     * @var \Src\TodoApi\User\Infrastructure\CreateUserController
     */
    private $createToDoController;

    public function __construct(\Src\TodoApi\ToDo\Infrastructure\CreateToDoController $createToDoController)
    {
        $this->createToDoController = $createToDoController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        
        $newToDO=$this->createToDoController->__invoke($request);
        return response ($newToDO, 200);

    }
}