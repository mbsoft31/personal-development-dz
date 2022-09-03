<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return Response
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $validated = $request->validate($request->rules());
        }catch (Exception $e) {
            return \response()->send($e->getTraceAsString());
        }
        $book = Book::factory()->create($validated);
        return response()->json($book);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse|Response
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return JsonResponse|Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        try {
            $validated = $request->validate($request->rules());
        }catch (Exception $e) {
            return \response()->send($e->getTraceAsString());
        }
        $book->update($validated);
        $book->refresh();
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        $deleted = $book->delete();
        return $deleted ?
            response()->json(["message" => "deleted"]):
            response('', 500);
    }
}
