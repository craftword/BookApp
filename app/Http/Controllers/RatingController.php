<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Rating;
use App\Http\Resources\RatingResource;

class RatingController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:api');
    }
    /**
     * @OA\Post(
     *     path="/books/{id}/rating",
     *     @OA\Response(response="200", description="An example resource")
     * )
     *
     */
    public function store(Request $request, $id)
    {
      $rating = Rating::firstOrCreate(
        [
          'user_id' => $request->user()->id,
          'book_id' => $id,
        ],
        ['rating' => $request->rating]
      );

      return new RatingResource($rating);
    }
}
