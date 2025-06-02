<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'email', 'registration_number'];

  public function loans()
  {
    return $this->hasMany(Loan::class);
  }
}
