<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;
use App\User;

class BookTest extends TestCase
{
     public function testBookAreListedCorrectly()
    {
        $response = $this->json('GET', '/api/v1/books')
            ->assertStatus(200);
            
    }
     public function testABookDetailsListedCorrectly()
    {
        $response = $this->json('GET', '/api/v1/books/3')
            ->assertStatus(200);
            
    }

}
