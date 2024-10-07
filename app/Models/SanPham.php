<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'san_pham';
    public $primaryKey = 'id';
    //protected $attributes = ['an_hien'=>1,'hot'=>0,'luot_xem'=>0];
    protected $dates = ['ngay'];
    protected $fillable = ['ten_sp','slug', 'gia','gia_km','id_dm',
    'hinh', 'mo_ta_ct', 'mo_ta_ngan','trang_thai', 'luot_mua', 'color'];
}
