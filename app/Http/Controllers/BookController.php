<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
  public function index()
  {
    return response()->json(Book::with('genre')->get());
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required',
      'author' => 'required',
      'register_number' => 'required|unique:books',
      'genre_id' => 'required|exists:genres,id'
    ]);

    $book = Book::create($request->all());
    return response()->json($book, 201);
  }

  public function show($id)
  {
    return response()->json(Book::with('genre')->findOrFail($id));
  }

  public function update(Request $request, $id)
  {
    $book = Book::findOrFail($id);
    $book->update($request->all());
    return response()->json($book);
  }

  public function destroy($id)
  {
    Book::destroy($id);
    return response()->json(null, 204);
  }
}
