<?php

declare(strict_types=1);

namespace Src\TodoApi\User\Domain;

use App\Http\Resources\User\UserResource;
use Src\TodoApi\User\Domain\ValueObjects\UserId;
use Src\TodoApi\User\Domain\ValueObjects\UserEmail;
use Src\TodoApi\User\Domain\ValueObjects\UserPassword;
use Src\TodoApi\User\Domain\ValueObjects\UserRememberToken;

final class User
{
    private $id;
    private $email;
    private $password;
    private $rememberToken;

    public function __construct(

        UserEmail         $email,
        UserPassword      $password,
        UserRememberToken $rememberToken

    )
    {
        $this->email                 = $email;
        $this->password              = $password;
        $this->rememberToken         = $rememberToken;
    }
    
    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function rememberToken(): UserRememberToken
    {
        return $this->rememberToken;
    }

    public static function create(
        UserEmail         $email,
        UserPassword      $password,
        UserRememberToken $rememberToken,
    ): User
    {
        $user = new self($email, $password,$rememberToken);
        return $user;
    }
}
