<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lawcase;
use App\Video;
use App\Smallvideo;

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
    public function addSmallvidedo(Request $request)
    {
      return Smallvideo::create(array_merge($request->all()));
    }
    public function allSmallvideo($id)
    {
      return Smallvideo::where('video_id',$id)->get();
    }
    public function lockVideo($id)
    {
      Video::where('id',$id)
            ->update(['status'=>"锁定"]);
    }
    public function finishVideo($id)
    {
      Video::where('id',$id)
            ->update(['status'=>"完成"]);
    }
}
