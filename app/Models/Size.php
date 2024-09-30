<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    public $primaryKey = 'id';
    public $attributes = ['an_hien' => [0, 1]];
    public $fillable = ['size_product', 'soluong', 'id_product'];
}
