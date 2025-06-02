<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
  public function run()
  {
    $genres = ['Ficção', 'Romance', 'Fantasia', 'Aventura', 'Terror', 'Drama'];

    foreach ($genres as $name) {
      Genre::create(['name' => $name]);
    }
  }
}
