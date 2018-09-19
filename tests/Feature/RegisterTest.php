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
            'name' => 'bola munis',
            'email' => 'bola@gmail.com',
            'password' => 'godword20',
            
        ];

        $this->json('post', '/api/v1/register', $payload)
            ->assertStatus(200)
            ->assertJson([
                //"access_token"=> "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcmVnaXN0ZXIiLCJpYXQiOjE1MzczMzUzNzUsImV4cCI6MTUzNzMzODk3NSwibmJmIjoxNTM3MzM1Mzc1LCJqdGkiOiJvRm92VVlLajdYUldjTUpqIiwic3ViIjoxMywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.DgrE7385I-knypSiSw2Z3T6xiTLHK-VrAsQgQbRzUdc",
                "token_type"=>"bearer",
                "expires_in"=>3600
                
            ]);
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
