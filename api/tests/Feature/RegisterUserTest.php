<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_user_is_created()
    {
        $this->withoutExceptionHandling();
        
        $userDataResponse=$this->postJson(
            '/api/register', 
            $this->data()
        )
        ->assertStatus(201);

        $this->assertCount(
            1, 
            User::all()
        );

        $this->assertArrayHasKey(
            'rememberToken', 
            $userDataResponse['data']
        );
        
    }

    private function data()
    {
        return [
            'email' => "firstname.lastname@email.com",
            'password' => "password_example"
        ];
    }
}
