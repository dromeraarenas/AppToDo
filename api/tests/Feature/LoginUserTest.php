<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Scr\TodoApi\User\Infrastructure\Exceptions\UserUnaunthenticatedException;


class LoginUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_loged()
    {
        $this->withoutExceptionHandling();

        $this->registerUser();
       
        $loginUserData=$this->postJson(
            '/api/login',
            $this->setUserData()
        )
        ->assertStatus(201);

        $loginUserData=$loginUserData->getContent();

        $loginUserData=json_decode(
            $loginUserData,
            true
        );

        $this->assertEquals(
            $loginUserData['data']['email'], 
            $this->setUserData()['email']
        );

        $this->assertArrayHasKey(
            'rememberToken',
            $loginUserData['data']
        );
    }

    private function registerUser()
    {   
        $registeredUserData=$this->postJson('/api/register', $this->setUserData());
        return $registeredUserData;
    }

    private function setUserData()
    {
        return [
            'email' => "firstname.lastname@email.com",
            'password' => "password_example"
        ];
    }

}