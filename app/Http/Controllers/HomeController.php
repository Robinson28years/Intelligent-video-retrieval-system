<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use zgldh\QiniuStorage\QiniuStorage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disk = \Storage::disk('qiniu');
//     $disk = QiniuStorage::disk('qiniu');
      // $disk->exists('FiZkIB3NFiE7ffTjFcXUqVwym2lB');                      //文件是否存在
      // $disk->get('file.jpg');
       $contents="2q342435";
      // $disk->put('test.txt',$contents);
//      dd( $disk->files(''));
//      dd($disk->downloadUrl('FiZkIB3NFiE7ffTjFcXUqVwym2lB'));
        return view('home');
    }
}
