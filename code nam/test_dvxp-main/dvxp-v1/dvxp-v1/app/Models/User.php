<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'user';

    protected $fillable = [
        'id',
        'tenuser',
        'gioitinh',
        'ngaysinh',
        'diachi',
        'sdt',
        'email',
        'password',
        'idchucvu'
    ];
}
