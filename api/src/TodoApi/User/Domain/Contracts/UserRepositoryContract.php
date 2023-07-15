<?php

declare(strict_types=1);

namespace Src\TodoApi\User\Domain\Contracts;

use Src\TodoApi\User\Domain\User;
use Src\TodoApi\User\Domain\ValueObjects\UserEmail;
use Src\TodoApi\User\Domain\ValueObjects\UserEmailVerifiedDate;
use Src\TodoApi\User\Domain\ValueObjects\UserId;
use Src\TodoApi\User\Domain\ValueObjects\UserPassword;

interface UserRepositoryContract
{
    public function findByCriteria(UserEmail $userEmail): ?User;

    public function save(User $user): void;

}
