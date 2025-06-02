<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
  public function index()
  {
    return response()->json(Genre::all());
  }

  public function store(Request $request)
  {
    $request->validate(['name' => 'required|unique:genres']);
    $genre = Genre::create($request->all());
    return response()->json($genre, 201);
  }

  public function show($id)
  {
    return response()->json(Genre::findOrFail($id));
  }

  public function update(Request $request, $id)
  {
    $genre = Genre::findOrFail($id);
    $genre->update($request->all());
    return response()->json($genre);
  }

  public function destroy($id)
  {
    Genre::destroy($id);
    return response()->json(null, 204);
  }
}
