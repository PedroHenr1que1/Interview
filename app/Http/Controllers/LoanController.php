<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
  public function index()
  {
    return response()->json(Loan::with(['user', 'book'])->get());
  }

  public function store(Request $request)
  {
    $request->validate([
      'user_id' => 'required|exists:users,id',
      'book_id' => 'required|exists:books,id',
      'due_date' => 'required|date'
    ]);

    $book = Book::findOrFail($request->book_id);
    if ($book->status != 'Disponível') {
      return response()->json(['error' => 'Livro indisponível'], 400);
    }

    $loan = Loan::create([
      'user_id' => $request->user_id,
      'book_id' => $request->book_id,
      'due_date' => $request->due_date,
      'status' => 'Emprestado'
    ]);

    $book->update(['status' => 'Emprestado']);

    return response()->json($loan, 201);
  }

  public function update(Request $request, $id)
  {
    $loan = Loan::findOrFail($id);
    $loan->update($request->only('status'));

    if ($request->status === 'Devolvido') {
      $loan->book->update(['status' => 'Disponível']);
    }

    return response()->json($loan);
  }

  public function destroy($id)
  {
    Loan::destroy($id);
    return response()->json(null, 204);
  }

  public function show($id)
  {
    return response()->json(Loan::with(['user', 'book'])->findOrFail($id));
  }
}
