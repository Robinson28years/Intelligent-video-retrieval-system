<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QiniuController extends Controller
{
    protected $disk = null;

    public function __construct()
    {
        $this->disk= \Storage::disk('ftp');
    }

    public function upLoad(Request $request)
    {
//        dd($this->disk->files('test'));
//        dd($request->file('file'));
        // dd($this->disk->get('test/uQqqhyTHZSwDZr8hJKRLzq4ibF428QtQxBy9r6dp.jpeg'));
//            dd($this->disk->exists('video/5j66qpaQfBxRZ4Kn7sa8oWAYKJauR0JP3NlBIDzV.jpeg'));
       return $this->disk->put('test',$request->file('file'));
    }
}
