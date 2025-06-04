<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
  public function index()
  {
    $users = User::all();

    return response()->json([
      'success' => true,
      'message' => 'Lista de usuários recuperada com sucesso.',
      'data' => $users
    ], Response::HTTP_OK);
  }

  public function store(Request $request)
  {
    // Verifica se já existe usuário com mesmo ID
    if (User::find($request->id)) {
      return response()->json([
        'success' => false,
        'message' => 'Já existe um usuário com este ID.'
      ], Response::HTTP_CONFLICT);
    }

    $user = User::create($request->all());

    return response()->json([
      'success' => true,
      'message' => 'Usuário cadastrado com sucesso.',
      'data' => $user
    ], Response::HTTP_CREATED);
  }

  public function show($id)
  {
    $user = User::find($id);

    //Verifica se o usuário existe
    if (!$user) {
      return response()->json([
        'success' => false,
        'message' => 'Usuário não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    return response()->json([
      'success' => true,
      'message' => 'Usuário recuperado com sucesso.',
      'data' => $user
    ], Response::HTTP_OK);
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);

    //Verifica se o usuário existe
    if (!$user) {
      return response()->json([
        'success' => false,
        'message' => 'Usuário não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    $user->update($request->all());

    return response()->json([
      'success' => true,
      'message' => 'Usuário atualizado com sucesso.',
      'data' => $user
    ], Response::HTTP_OK);
  }

  public function destroy($id)
  {
    $user = User::find($id);

    //Verifica se o usuário existe
    if (!$user) {
      return response()->json([
        'success' => false,
        'message' => 'Usuário não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    $user->delete();

    return response()->json([
      'success' => true,
      'message' => 'Usuário deletado com sucesso.'
    ], Response::HTTP_OK);
  }
}
