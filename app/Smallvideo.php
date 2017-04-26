<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smallvideo extends Model
{
  protected $table = 'smallvideo';
  protected $fillable = [
      'start', 'end', 'video_id'
  ];
}
