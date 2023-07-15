<?php

declare(strict_types=1);

namespace Src\TodoApi\Auth\Domain\Contracts;

use Src\TodoApi\User\Domain\User;
use Src\TodoApi\User\Domain\ValueObjects\UserEmail;
use Src\TodoApi\User\Domain\ValueObjects\UserPassword;

interface AuthRepositoryContract
{
    public function login(UserEmail $userEmail, UserPassword $userPassword): ?User;

    public function register(User $user): void;

}
