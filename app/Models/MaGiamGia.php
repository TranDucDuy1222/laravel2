<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    use HasFactory;
    protected $table = 'magiamgia';
    public $primaryKey = 'id';
    protected $dates = ['ngay_het_han'];
    protected $fillable = [
        'code',
        'phan_tram',
        'mo_ta',
        'id_kh',
        'ma_gioi_han',
        'mot_nhieu',
        'is_active',
    ];
    public function isValidForUser($userId)
    {
        // Kiểm tra xem mã giảm giá đã hết hạn chưa
        if ($this->ngay_het_han < now()) {
            return false;
        }
        // Kiểm tra loại mã giảm giá: một lần dùng hoặc nhiều lần dùng
        if ($this->loai_ma == 'once') {
            // Nếu là mã một lần, kiểm tra người dùng đã sử dụng mã này chưa
            $used = DonHang::where('user_id', $userId)
                            ->where('magiamgia', $this->code)
                            ->exists();
            return !$used; // Trả về false nếu đã sử dụng mã này
        }
        // Nếu là mã nhiều lần dùng, cho phép tiếp tục sử dụng
        return true;
    }

    public function getDiscountAmount()
    {
        return $this->gia_tri;
    }
}
