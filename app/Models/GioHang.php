<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;
    protected $table = 'gio_hang';
    protected $fillable = [
        'user_id',
        'id_sp',
        'id_size',
        'so_luong',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_sp');
    }
    
    public function size()
    {
        return $this->belongsTo(Size::class, 'id_size');
    }
}
