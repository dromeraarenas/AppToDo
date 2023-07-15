<?php

declare(strict_types=1);

namespace Src\TodoApi\Auth\Infrastructure;

use Illuminate\Http\Request;
use Src\TodoApi\Auth\Application\LoginUseCase;
use Src\TodoApi\Auth\Infrastructure\Repositories\EloquentAuthRepository;

final class LoginController
{
    private $repository;

    public function __construct(EloquentAuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        //$userId = (int)$request->id;
        $userEmail= $request->email;
        $userPasword= $request->password;

        $LoginUseCase = new LoginUseCase($this->repository);
        $user           = $LoginUseCase->__invoke($userEmail,$userPasword);

        return $user;
    }
}
