<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
  public function run()
  {
    Book::create([
      'title' => 'Aventuras de Sherlock Holmes',
      'author' => 'Arthur Conan Doyle',
      'register_number' => 'B1001',
      'status' => 'Disponível',
      'genre_id' => 1
    ]);

    Book::create([
      'title' => 'O Senhor dos Anéis',
      'author' => 'J.R.R. Tolkien',
      'register_number' => 'B1002',
      'status' => 'Disponível',
      'genre_id' => 2
    ]);
  }
}
