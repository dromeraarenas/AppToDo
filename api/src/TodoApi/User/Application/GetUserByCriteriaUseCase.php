<?php

declare(strict_types=1);

namespace Src\TodoApi\User\Application;

use Src\TodoApi\User\Domain\Contracts\UserRepositoryContract;
use Src\TodoApi\User\Domain\User;
use Src\TodoApi\User\Domain\ValueObjects\UserEmail;

final class GetUserByCriteriaUseCase
{
    private $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $userEmail): ?User
    {
        $email = new UserEmail($userEmail);

        $user = $this->repository->findByCriteria($email);

        return $user;
    }
}
