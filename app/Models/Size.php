<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    public $primaryKey = 'id';
    public $fillable = ['size_product', 'so_luong', 'id_product'];
}
