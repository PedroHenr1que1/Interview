<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GenreController extends Controller
{
  public function index()
  {
    $genres = Genre::all();

    return response()->json([
      'success' => true,
      'message' => 'Lista de gêneros recuperada com sucesso.',
      'data' => $genres
    ], Response::HTTP_OK);
  }

  public function store(Request $request)
  {
    // Verifica se já existe gênero com o mesmo ID
    if (Genre::find($request->id)) {
      return response()->json([
        'success' => false,
        'message' => 'Já existe um gênero com este ID.'
      ], Response::HTTP_CONFLICT);
    }

    // Verifica duplicidade de nome
    if (Genre::where('name', $request->name)->exists()) {
      return response()->json([
        'success' => false,
        'message' => 'Já existe um gênero com este nome.'
      ], Response::HTTP_CONFLICT);
    }

    $genre = Genre::create($request->all());

    return response()->json([
      'success' => true,
      'message' => 'Gênero cadastrado com sucesso.',
      'data' => $genre
    ], Response::HTTP_CREATED);
  }

  public function show($id)
  {
    $genre = Genre::find($id);

    if (!$genre) {
      return response()->json([
        'success' => false,
        'message' => 'Gênero não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    return response()->json([
      'success' => true,
      'message' => 'Gênero recuperado com sucesso.',
      'data' => $genre
    ], Response::HTTP_OK);
  }

  public function update(Request $request, $id)
  {
    $genre = Genre::find($id);

    if (!$genre) {
      return response()->json([
        'success' => false,
        'message' => 'Gênero não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    // Verifica se outro gênero já possui o mesmo nome
    if ($request->has('name') && Genre::where('name', $request->name)->where('id', '!=', $id)->exists()) {
      return response()->json([
        'success' => false,
        'message' => 'Já existe outro gênero com este nome.'
      ], Response::HTTP_CONFLICT);
    }

    $genre->update($request->all());

    return response()->json([
      'success' => true,
      'message' => 'Gênero atualizado com sucesso.',
      'data' => $genre
    ], Response::HTTP_OK);
  }

  public function destroy($id)
  {
    $genre = Genre::find($id);

    if (!$genre) {
      return response()->json([
        'success' => false,
        'message' => 'Gênero não encontrado.'
      ], Response::HTTP_NOT_FOUND);
    }

    // Verifica se existem livros vinculados ao gênero
    if ($genre->books()->count() > 0) {
      return response()->json([
        'success' => false,
        'message' => 'Não é possível excluir este gênero pois ele está vinculado a um ou mais livros.'
      ], Response::HTTP_BAD_REQUEST);
    }

    $genre->delete();

    return response()->json([
      'success' => true,
      'message' => 'Gênero deletado com sucesso.'
    ], Response::HTTP_OK);
  }
}
