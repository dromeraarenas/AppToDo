<?php

declare(strict_types=1);

namespace Src\TodoApi\User\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User as EloquentUserModel;
use Src\TodoApi\User\Domain\Contracts\UserRepositoryContract;
use Src\TodoApi\User\Domain\User;
use Src\TodoApi\User\Domain\ValueObjects\UserEmail;
use Src\TodoApi\User\Domain\ValueObjects\UserId;
use Src\TodoApi\User\Domain\ValueObjects\UserPassword;
use Src\TodoApi\User\Domain\ValueObjects\UserRememberToken;

final class EloquentUserRepository implements UserRepositoryContract
{
    private $eloquentUserModel;

    public function __construct()
    {
        $this->eloquentUserModel = new EloquentUserModel;
    }

    public function findByCriteria(UserEmail $email): ?User
    {
        $user = $this->eloquentUserModel
            ->where('email', $email->value())
            ->firstOrFail();

        // Return Domain User model
        return new User(
            new UserEmail($user->email),
            new UserPassword($user->password),
            new UserRememberToken($user->createToken('auth_token')->plainTextToken)
        );
    }

    public function save(User $user): void
    {
        //$newUser = $this->eloquentUserModel;

        $data = [
            $user->email()->value(),
            $user->password()->value()
        ];

        DB::insert('insert into users (email, password) values (?, ?)', $data);

        //$newUser->create($data);
    }

}