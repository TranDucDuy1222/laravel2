<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplyEmail;
use App\Mail\ReplyemailUser;
use Illuminate\Support\Facades\Mail;
use DB;

class AdminemailController extends AdminController
{
    public function index(Request $request){
        $perpage = 12;
        $email_arr = ReplyEmail::
        orderByRaw('IFNULL(reply_email.feedback, 1) ASC')
        ->orderBy('reply_email.id', 'asc')
        ->paginate($perpage)
        ->withQueryString();

        $setting = DB::table('settings')->select('phone' , 'facebook' , 'site_name')->first();

        return view('admin.reply_email' , compact('email_arr' , 'setting'));
    }

    public function sendReply($id, Request $request){
        $email = ReplyEmail::find($id);
        $email->feedback = $request->input('feedback');
        $email->an_hien = 0;
        $email->save();

        // Send email reply
        $data = [
            'hoTen' => $email->name,
            'noiDung' => $email->feedback,
        ];
        Mail::mailer('smtp')->to($email->email)->send(new ReplyemailUser($data['hoTen'], $data['noiDung']));
        return redirect()->route('email.index')->with('success', 'Gửi mail thành công!');
    }
}
