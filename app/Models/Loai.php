<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loai extends Model
{
    use HasFactory;
    protected $table = 'loai';
    public $primaryKey = 'id';
    public $attributes = ['an_hien' => [0, 1]];
    public $fillable = ['ten_loai', 'slug', 'thutu'];
}
