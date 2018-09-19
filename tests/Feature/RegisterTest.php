<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    public function testsRegistersSuccessfully()
    {
        $payload = [
            'name' => 'John',
            'email' => 'john@toptal.com',
            'password' => 'toptal123',
            
        ];

        $result = $this->json('post', '/api/v1/register', $payload)
            ->assertStatus(200);
        var_dump($result->getData(true)); 
    }
     public function testsRequiresPasswordEmailAndName()
    {
        $result =  $this->json('post', '/api/v1/register')
            ->assertStatus(200)
            ->assertJson([
                "success"=> false,
                "error" => [
                        "email" => [
                            "The email field is required."
                        ],
                        "name"=> [
                            "The name field is required."
                        ],
                     ]
                ]);
    }
}
