<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loai extends Model
{
    use HasFactory;
    protected $table = 'danh_muc';
    protected $primaryKey = 'id';
    protected $attributes = ['an_hien'];
    protected $fillable = [
        'ten_dm', 'slug', 'trang_thai', 'thu_tu', 'an_hien'
    ];
}
