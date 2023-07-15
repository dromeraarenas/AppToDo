<?php

declare(strict_types=1);

namespace Src\TodoApi\Auth\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Src\TodoApi\User\Infrastructure\Repositories\EloquentUserRepository;
use Src\TodoApi\User\Application\CreateUserUseCase;
use Src\TodoApi\User\Application\GetUserByCriteriaUseCase;

final class RegisterController
{
    private $repository;

    public function __construct(EloquentUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $userEmail             = $request->input('email');
        $userPassword          = Hash::make($request->input('password'));
        $userRememberToken     = null;

        $createUserUseCase = new CreateUserUseCase($this->repository);

        $createUserUseCase->__invoke(
            $userEmail,
            $userPassword,
            $userRememberToken
        );

        $getUserByCriteriaUseCase = new GetUserByCriteriaUseCase($this->repository);
        $newUser                  = $getUserByCriteriaUseCase->__invoke($userEmail);
        return $newUser;
    }
}