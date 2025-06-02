<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'author', 'register_number', 'status', 'genre_id'];

  public function genre()
  {
    return $this->belongsTo(Genre::class);
  }

  public function loans()
  {
    return $this->hasMany(Loan::class);
  }
}
