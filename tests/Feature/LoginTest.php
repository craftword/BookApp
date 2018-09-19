<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Validator;

class LoginTest extends TestCase
{
    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'bola@gmail.com',
            'password' => bcrypt('godword20'),
        ]);

        $payload = ['email' => 'bola@gmail.com', 'password' => 'godword20'];

       $this->json('post', '/api/v1/login', $payload)
            ->assertStatus(200)
            ->assertJson([
                //"access_token"=> "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcmVnaXN0ZXIiLCJpYXQiOjE1MzczMzUzNzUsImV4cCI6MTUzNzMzODk3NSwibmJmIjoxNTM3MzM1Mzc1LCJqdGkiOiJvRm92VVlLajdYUldjTUpqIiwic3ViIjoxMywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.DgrE7385I-knypSiSw2Z3T6xiTLHK-VrAsQgQbRzUdc",
                "token_type"=>"bearer",
                "expires_in"=>3600
                
            ]);  

    }
    public function testRequiresEmailAndLogin()
    {
          $credentials = ['email', 'password'];
         $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        $this->json('POST', 'api/v1/login')
            ->assertStatus(401)
            ->assertJson([
                "success"=> false,
                "error" => [
                        "email" => [
                            "The email field is required."
                        ],
                        "password"=> [
                            "The password field is required."
                        ]
                     ]
                ]);
    }
}
