<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
  public function run()
  {
    User::create([
      'name' => 'João da Silva',
      'email' => 'joao@example.com',
      'registration_number' => '2021001'
    ]);

    User::create([
      'name' => 'Maria Oliveira',
      'email' => 'maria@example.com',
      'registration_number' => '2021002'
    ]);
  }
}
