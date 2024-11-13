<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DiaChi;
use Illuminate\Support\Carbon;

class DonHang extends Model
{
    use HasFactory;
    protected $table = 'don_hang';
    public $primaryKey = 'id';
    protected $dates = 'thoi_diem_mua_hang';
    protected $fillable = [
        'id_user', 
        'id_dc',
        'tong_dh', 
        'pttt', 
        'uu_dai',
        'trang_thai'
    ];

    public function diaChi()
    {
        return $this->belongsTo(DiaChi::class, 'id_dc'); // 'id_dc' là khóa ngoại
    }

    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class, 'id_dh');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
