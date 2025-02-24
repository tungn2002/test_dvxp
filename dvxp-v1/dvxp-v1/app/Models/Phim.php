<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    use HasFactory;
    protected $table = 'phim';

    protected $fillable = [
        'id',
        'tenphim',
        'theloai',
        'noidung',
        'daodien',
        'image',
        'thoiluong'
    ];
}
