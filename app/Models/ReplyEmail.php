<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyEmail extends Model
{
    use HasFactory;
    protected $table = 'reply_email';
    public $primaryKey = 'id';
    public $fillable = ['email', 'ho_ten', 'noi_dung','an_hien','feedback'];

}
