<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoanController extends Controller
{
  public function index()
  {
    $loans = Loan::all();

    return response()->json([
      'success' => true,
      'message' => 'Lista de empréstimos recuperada com sucesso.',
      'data' => $loans
    ], Response::HTTP_OK);
  }

  public function store(Request $request)
  {
    // Verifica se já existe empréstimo com o mesmo ID
    if (Loan::find($request->id)) {
      return response()->json([
        'success' => false,
        'message' => 'Já existe um empréstimo com este ID.'
      ], Response::HTTP_CONFLICT);
    }

    $loan = Loan::create($request->all());

    return response()->json([
      'success' => true,
      'message' => 'Empréstimo criado com sucesso.',
      'data' => $loan
    ], Response::HTTP_CREATED);
  }

  public function show($id)
  {
    $loan = Loan::find($id);

    if (!$loan) {
      return response()->json([
        'success' => false,
        'message' => 'Empréstimo não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    return response()->json([
      'success' => true,
      'message' => 'Empréstimo recuperado com sucesso.',
      'data' => $loan
    ], Response::HTTP_OK);
  }

  public function update(Request $request, $id)
  {
    $loan = Loan::find($id);

    if (!$loan) {
      return response()->json([
        'success' => false,
        'message' => 'Empréstimo não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    // Se o status for informado, valida se é permitido
    if ($request->has('status')) {
      $status = strtolower($request->status);
      if (!in_array($status, ['atrasado', 'devolvido'])) {
        return response()->json([
          'success' => false,
          'message' => 'Status inválido. Os valores permitidos são: atrasado ou devolvido.'
        ], Response::HTTP_BAD_REQUEST);
      }

      $loan->status = $status;
    }

    $loan->fill($request->except('status'));
    $loan->save();

    return response()->json([
      'success' => true,
      'message' => 'Empréstimo atualizado com sucesso.',
      'data' => $loan
    ], Response::HTTP_OK);
  }

  public function destroy($id)
  {
    $loan = Loan::find($id);

    if (!$loan) {
      return response()->json([
        'success' => false,
        'message' => 'Empréstimo não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    $loan->delete();

    return response()->json([
      'success' => true,
      'message' => 'Empréstimo deletado com sucesso.'
    ], Response::HTTP_OK);
  }
}
