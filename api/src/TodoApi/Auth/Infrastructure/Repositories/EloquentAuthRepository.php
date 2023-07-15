<?php

declare(strict_types=1);

namespace Src\TodoApi\Auth\Infrastructure\Repositories;

use App\Models\User as EloquentUserModel;
use Src\TodoApi\Auth\Domain\Contracts\AuthRepositoryContract;
use Src\TodoApi\User\Domain\User;
use Src\TodoApi\User\Domain\ValueObjects\UserEmail;
use Src\TodoApi\User\Domain\ValueObjects\UserEmailVerifiedDate;
use Src\TodoApi\User\Domain\ValueObjects\UserPassword;
use Src\TodoApi\User\Domain\ValueObjects\UserRememberToken;

use Src\TodoApi\Auth\Infrastructure\Exceptions\UserUnaunthenticatedException;
use Illuminate\Support\Facades\Auth;


final class EloquentAuthRepository implements AuthRepositoryContract
{
    private $eloquentUserModel;

    public function __construct()
    {
        $this->eloquentUserModel = new EloquentUserModel;
    }

    public function login(UserEmail $email, UserPassword $password): ?User
    {

        if (Auth::attempt(['email' => $email->value(), 'password' =>$password->value()])) {
            
            $user = $this->eloquentUserModel
            ->where('email', $email->value())
            ->firstOrFail();

            return new User(
                new UserEmail($user->email),
                new UserPassword($user->password),
                new UserRememberToken($user->createToken('auth_token')->plainTextToken)
            );

        }else{
            throw new UserUnaunthenticatedException('Unaunthenticated');
        }
        
    }

    public function register(User $user): void
    {
        $newUser = $this->eloquentUserModel;

        $data = [
            'email'             => $user->email()->value(),
            'password'          => $user->password()->value()
        ];

        $newUser->create($data);
    }

}