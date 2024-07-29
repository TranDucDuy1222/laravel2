<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'sanpham';
    public $primaryKey = 'masp';
    //protected $attributes = ['an_hien'=>1,'hot'=>0,'luot_xem'=>0];
    protected $dates = ['ngay'];
    protected $fillable = ['tensp','slug', 'gia','giakhuyenmai','madm',
    'anhsp', 'soluong','motachitiet', 'motangan','trangthai','ngay'];
}
