<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lawcase;
use App\Video;

class VideoController extends Controller
{
    public function allCase()
    {
      return Lawcase::all();
    }
    public function addCase(Request $request)
    {
      return Lawcase::create(array_merge($request->all()));
    }
    public function addVideo(Request $request)
    {
      return Video::create(array_merge($request->all()));
    }
    public function allVideo($id)
    {
      return Video::where('lawcase_id',$id)->get();
    }
}
