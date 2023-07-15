<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ToDoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_todo_can_be_created_whithout_categories()
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

        $ToDo= $this->postJson('/api/todo',$this->setToDoData());
        $ToDo->assertStatus(200);

        $ToDo=$ToDo->json();
        $this->assertCount(1,$ToDo);
        $this->assertArrayHasKey('id',$ToDo[0]);
        
    }

    /** @test */
    public function a_list_of_todos_can_be_obtained()
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
 
        $responseTodo= $this->postJson('/api/todo',$this->setToDoData());
        $responseTodo->assertStatus(200);

        $responseTodo= $this->postJson('/api/todo',$this->setToDoData());
        $responseTodo->assertStatus(200);

        $responseTodo= $this->postJson('/api/todo',$this->setToDoData());
        $responseTodo->assertStatus(200);

        $toDos=$this->get('/api/todos');

        $toDos->assertStatus(201);

        $toDos=$toDos->json();
        $this->assertCount(3,$toDos);
         
    }

    /** @test */
    public function a_todo_can_be_updated()
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

        $responseTodo= $this->postJson('/api/todo',$this->setToDoData());
        $responseTodo->assertStatus(200);

        $respToArray=$responseTodo->json();
  
        $toDoId=$respToArray[0]['id'];
       
        
        $updatedTodo=$this->putJson("api/todo/$toDoId",$this->setUpdatedToDoData());
        $updatedTodo->assertStatus(201);
        
    }

    /** @test */
    public function a_todo_can_be_deleted()
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
    
        $responseTodo= $this->postJson('/api/todo',$this->setToDoData());
        $responseTodo->assertStatus(200);
    
        $respToArray=$responseTodo->json();
      
        $toDoId=$respToArray[0]['id'];
           
        $deletedTodo=$this->delete("api/todo/$toDoId");
        $deletedTodo->assertStatus(200);
            
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

    private function setToDoData()
    {
        return [
            'name'=>'Tarea 1',
            'description'=>'tengo que comprar el pan',
            'status'=>'pending'
        ];
    }

    private function setUpdatedToDoData()
    {
        return [
            'name'=>'Tarea 1 renom',
            'description'=>'ya he comprado el pan',
            'status'=>'completed'
        ];
    }


}
