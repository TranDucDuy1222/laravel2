<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DanhMuc;

class Loai extends Model
{
    use HasFactory;
    protected $table = 'loai';
    protected $primaryKey = 'id';
    protected $attributes = ['an_hien'];
    protected $fillable = [
        'ten_dm', 'slug', 'trang_thai', 'thu_tu', 'an_hien'
    ];
    public function danhMucs()
    {
        return $this->hasMany(DanhMuc::class, 'id_loai');
    }
}

