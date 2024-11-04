<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChi extends Model
{
    use HasFactory;
    protected $table = 'dia_chi'; // Tên bảng trong cơ sở dữ liệu
    protected $fillable = ['id_user', 'dc_chi_tiet', 'phone', 'qh', 'thanh_pho' , 'ho_ten' , 'an_hien'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
