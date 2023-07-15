<?php

declare(strict_types=1);

namespace Src\TodoApi\User\Application;

use Src\TodoApi\User\Domain\Contracts\UserRepositoryContract;
use Src\TodoApi\User\Domain\User;
use Src\TodoApi\User\Domain\ValueObjects\UserEmail;
use Src\TodoApi\User\Domain\ValueObjects\UserPassword;
use Src\TodoApi\User\Domain\ValueObjects\UserRememberToken;

final class CreateUserUseCase
{
    private $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(

        string $userEmail,
        string $userPassword,
        ?string $userRememberToken

    ): void
    {
        $email             = new UserEmail($userEmail);
        $password          = new UserPassword($userPassword);
        $rememberToken     = new UserRememberToken($userRememberToken);

        $user = User::create($email, $password,$rememberToken);
        $this->repository->save($user);
    }
}
