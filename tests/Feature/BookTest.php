<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Book;
use App\User;

class BookTest extends TestCase
{
    
     public function testBookAreListedCorrectly()
    {
        $response = $this->json('GET', '/api/v1/books')
            ->assertStatus(200);
            $this->assertNotEmpty($response);
            
    }
     public function testABookDetailsListedCorrectly()
    {
        $response = $this->json('GET', '/api/v1/books/3')
            ->assertStatus(200);
            $this->assertNotEmpty($response);
            
    }
     public function testCreateABookCorrectly()
    {
         $payload = [
          'title' => 'NAIL POPS!',
          'description'=> 'the fsjthskjihfd udgygjd-0jdgf5rdm',
          'author'=> 'Christiana',
          'dateOfPublication' => '2014-02-10'
      ];
        $user = factory(User::class)->create();
        // create valid token
        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('POST', '/api/v1/books', $payload, $headers)
            ->assertStatus(201)
            ->assertSee('title')
            ->assertSee('description')
            ->assertSee('author')
            ->assertSee('dateOfPublication');
            
            
    }
    /* public function testUpdateABookCorrectly()
    {
         
        $book = factory(Book::class)->create();

        $user = factory(User::class)->create();
        // create valid token
        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
        $headers = ['Authorization' => "Bearer $token"];

        $payload = [
          'title' => 'NAIL RUSH!',
          'description'=> 'the fsjthskji',
          'author'=> 'Shola Olaitan',
          'dateOfPublication' => '2012-02-10',
          'user_id' => 3,
      ];


        $response = $this->json('PUT', '/api/v1/books/'. $book->id, $payload, $headers)
            ->assertStatus(201)
            ->assertSee('title')
            ->assertSee('description')
            ->assertSee('author')
            ->assertSee('dateOfPublication');
            
            
    } */

     public function testsBookAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
         // create valid token
        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Book::class)->create();

        $this->json('DELETE', '/api/v1/books/' . $article->id, [], $headers)
            ->assertStatus(204);
    }


}
