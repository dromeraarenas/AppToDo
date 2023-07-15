<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_list_of_categories_can_be_obtained()
    {
        $this->withoutExceptionHandling();
        $this->seed();
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

        $categories= $this->get('/api/categories');
        $categories->assertStatus(200);

        $categories=$categories->json();

        $this->assertCount(4,$categories);
        $this->assertArrayHasKey('id',$categories[0]);

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