<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Resources\BookResource;

class BookController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/v1/books",
     *     @OA\Response(response="200", description="Get all books")
     * )
     *
     */
    public function index()
    {
        //
        return BookResource::collection(Book::with('ratings')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *     path="/api/v1/books",
     *     @OA\Response(response="200", description="Create a book")
     * )
     *
     */
    public function store(Request $request)
    {
        //
        $book = Book::create([
        'user_id' => $request->user()->id,
        'title' => $request->title,
        'description' => $request->description,
        'author' => $request->author,
        'dateOfPublication' => $request->dateOfPublication,
      ]);

      return new BookResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     *     path="/api/v1/books/{id}",
     *     @OA\Response(response="200", description="Get a book")
     * )
     *
     */
    public function show($id)
    {
        //
        $book = Book::findOrFail($id);
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     /**
     * @OA\Put(
     *     path="/api/v1/books/{id}",
     *     @OA\Response(response="200", description="Update a books")
     * )
     *
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        // check if currently authenticated user is the owner of the book
      if ($request->user()->id !== $book->user_id) {
        return response()->json(['error' => 'You can only edit your own books.'], 403);
      }

      $book->update($request->only(['title', 'description', 'author', 'dateOfPublication']));

      return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     *     path="/api/v1/books/{id}",
     *     @OA\Response(response="200", description="Delete a book")
     * )
     *
     */
    public function destroy(Book $book)
    {
      $book->delete();

      return response()->json(null, 204);
    }
}
