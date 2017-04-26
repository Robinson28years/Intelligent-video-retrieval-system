<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
  protected $table = 'video';
  protected $fillable = [
      'name', 'lng', 'lat','start','label','status','lawcase_id'
  ];
  public function smallvideo()
  {
    return $this->hasMany(Smallvideo::class);
  }
}
