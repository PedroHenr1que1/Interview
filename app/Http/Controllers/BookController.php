<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
  public function index()
  {
    $books = Book::all();

    return response()->json([
      'success' => true,
      'message' => 'Lista de livros recuperada com sucesso.',
      'data' => $books
    ], Response::HTTP_OK);
  }

  public function store(Request $request)
  {
    // Verifica se já existe livro com o mesmo ID
    if (Book::find($request->id)) {
      return response()->json([
        'success' => false,
        'message' => 'Já existe um livro com este ID.'
      ], Response::HTTP_CONFLICT);
    }

    // Verifica se o status é "emprestado"
    if ($request->status === 'emprestado') {
      return response()->json([
        'success' => false,
        'message' => 'Não é permitido cadastrar um livro com status emprestado.'
      ], Response::HTTP_BAD_REQUEST);
    }

    $book = Book::create($request->all());

    return response()->json([
      'success' => true,
      'message' => 'Livro cadastrado com sucesso.',
      'data' => $book
    ], Response::HTTP_CREATED);
  }

  public function show($id)
  {
    $book = Book::find($id);

    if (!$book) {
      return response()->json([
        'success' => false,
        'message' => 'Livro não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    return response()->json([
      'success' => true,
      'message' => 'Livro recuperado com sucesso.',
      'data' => $book
    ], Response::HTTP_OK);
  }

  public function update(Request $request, $id)
  {
    $book = Book::find($id);

    if (!$book) {
      return response()->json([
        'success' => false,
        'message' => 'Livro não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    // Verifica se status é "emprestado"
    if ($request->has('status') && $request->status === 'emprestado') {
      return response()->json([
        'success' => false,
        'message' => 'Não é permitido atualizar o livro para status emprestado.'
      ], Response::HTTP_BAD_REQUEST);
    }

    $book->update($request->all());

    return response()->json([
      'success' => true,
      'message' => 'Livro atualizado com sucesso.',
      'data' => $book
    ], Response::HTTP_OK);
  }

  public function destroy(Request $request, $id)
  {
    $book = Book::find($id);

    // Verifica se o livro exists
    if (!$book) {
      return response()->json([
        'success' => false,
        'message' => 'Livro não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    // Verifica se status é "emprestado"
    if ($request->has('status') && $request->status === 'emprestado') {
      return response()->json([
        'success' => false,
        'message' => 'Não é permitido deletar um livro emprestado.'
      ], Response::HTTP_BAD_REQUEST);
    }

    $book->delete();

    return response()->json([
      'success' => true,
      'message' => 'Livro deletado com sucesso.'
    ], Response::HTTP_OK);
  }
}
