<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DonHang;

class ChiTietDonHang extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_don_hang';
    public $primaryKey = 'id';
    protected $fillable = [
        'id_dh', 
        'id_sp', 
        'so_luong', 
        'gia'
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'id_dh');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_sp');
    }
}
