<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhGia extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'danh_gia';
    public $primaryKey = 'id';
    //protected $attributes = ['an_hien'=>1,'hot'=>0,'luot_xem'=>0];
    protected $dates = ['thoi_diem'];
    protected $fillable = ['id_sp','id_user', 'noidung','quality_product','hinh_dg',
    'feedback', 'an_hien'];
}
