<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lawcase extends Model
{
  protected $table = 'lawcase';
  protected $fillable = [
      'name', 'email', 'password',
  ];
  public function video()
  {
    return $this->hasMany(Video::class);
  }
}
