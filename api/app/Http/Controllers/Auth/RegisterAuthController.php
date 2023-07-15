<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\User\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterAuthController extends Controller
{
    /**
     * @var \Src\TodoApi\User\Infrastructure\CreateUserController
     */
    private $registerController;

    public function __construct(\Src\TodoApi\Auth\Infrastructure\RegisterController $registerController)
    {
        $this->registerController = $registerController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $newUser = new UserResource($this->registerController->__invoke($request));
        return response($newUser, 201);
    }
}