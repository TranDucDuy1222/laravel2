<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table = 'danh_muc';
    public $primaryKey = 'id';
    public $atttributes = ['an_hien'=>0, 'an_hien'=>1];
    public $fillable = ['ten_dm', 'slug', 'trang_thai', 'thutu'];
}
