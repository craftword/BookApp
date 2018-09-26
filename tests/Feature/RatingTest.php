<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;
use App\User;

class RatingTest extends TestCase
{
     public function testRateABookCorrectly()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $payload = [
            'rating'=> 4,
        ];
        // create valid token
        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('POST', '/api/v1/books/'.$book->id.'/ratings', $payload, $headers)
            ->assertStatus(201)
            ->assertSee('user_id')
            ->assertSee('book_id')
            ->assertSee('rating');
            
            
            
    }
   
}
