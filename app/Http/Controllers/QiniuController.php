<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Illuminate\Support\Facades\Storage;

class QiniuController extends Controller
{
    protected $disk = null;

    public function __construct()
    {
        $this->disk= \Storage::disk('public');
    }

    public function upLoad(Request $request)
    {
//        dd($this->disk->files('test'));
//        dd($request->file('file'));
        // dd($this->disk->get('test/uQqqhyTHZSwDZr8hJKRLzq4ibF428QtQxBy9r6dp.jpeg'));
//            dd($this->disk->exists('video/5j66qpaQfBxRZ4Kn7sa8oWAYKJauR0JP3NlBIDzV.jpeg'));
       return $this->disk->put('test',$request->file('file'));
    }
    public function getvideo(Request $request)
    {
      $label = Video::where('id',$request->video)->first();
      // dd($label->label);
      $label = $label->label;
      $url = Storage::url($label);
      // dd($url);
      return $url;
    }
}
