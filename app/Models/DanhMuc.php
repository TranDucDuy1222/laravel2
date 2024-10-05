<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table = 'danh_muc';
    public $primaryKey = 'id';
    public $attributes = ['an_hien' => [0, 1]];
    public $fillable = ['ten_dm', 'slug', 'trang_thai', 'thutu'];
    public function loai()
    {
        return $this->belongsTo(Loai::class, 'id_loai');
    }

}
