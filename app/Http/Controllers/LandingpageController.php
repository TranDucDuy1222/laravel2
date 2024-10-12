<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LandingpageController extends Controller
{
    public function index(){
        $layout_page = DB::table('landing_page')->first();
        return view('admin/home_landingpage');
    }
}
