<?php

//declare(strict_types=1);

namespace Src\TodoApi\Auth\Application;

use Src\TodoApi\User\Domain\Contracts\UserRepositoryContract;
use Src\TodoApi\User\Domain\User;
use Src\TodoApi\User\Domain\ValueObjects\UserEmail;
use Src\TodoApi\User\Domain\ValueObjects\UserPassword;


final class RegisterUserUseCase
{
    private $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $userEmail,
        string $userPassword
    ): void
    {
        $email             = new UserEmail($userEmail);
        $password          = new UserPassword($userPassword);

        $user = User::create($email, $password);
        $this->repository->save($user);
    }
}
