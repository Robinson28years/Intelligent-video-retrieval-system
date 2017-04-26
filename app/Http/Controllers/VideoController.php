<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lawcase;

class VideoController extends Controller
{
    public function allCase()
    {
      return Lawcase::all();
    }
    public function addCase(Request $request)
    {
      Lawcase::create(array_merge($request->all()));
    }
}
