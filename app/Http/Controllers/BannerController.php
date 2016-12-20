<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Http\Requests;
use DB;

class BannerController extends Controller
{
    public function index(Request $request) {
        $banners = Banner::with('audio.singers','image')->get();

        return $banners;
    }
}
