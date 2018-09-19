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
            'email' => 'testlogin@user.com',
            'password' => bcrypt('toptal123'),
        ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => 'toptal123'];

       $result = $this->json('POST', 'api/v1/login', $payload)
            ->assertStatus(200);
       var_dump($result->getData(true));    

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
