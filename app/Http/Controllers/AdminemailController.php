<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminemailController extends AdminController
{
    public function index(Request $request){
        return view('admin.reply_email');
    }
}
