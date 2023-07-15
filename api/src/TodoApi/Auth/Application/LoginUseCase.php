<?php

declare(strict_types=1);

namespace Src\TodoApi\Auth\Application;

use Src\TodoApi\Auth\Domain\Contracts\AuthRepositoryContract;
use Src\TodoApi\User\Domain\User;
use Src\TodoApi\User\Domain\ValueObjects\UserEmail;
use Src\TodoApi\User\Domain\ValueObjects\UserPassword;

final class LoginUseCase
{
    private $repository;

    public function __construct(AuthRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $userEmail, string $userPassword): ?User
    {
        $email = new UserEmail($userEmail);
        $password= new UserPassword($userPassword);

        $user = $this->repository->login($email,$password);

        return $user;
    }
}
