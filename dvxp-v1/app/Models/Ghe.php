<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ghe extends Model
{
    use HasFactory;
    protected $table = 'ghe';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'tenghe',
        'idphong',
        'idlichchieu',
        'giaghe'
    ];
}
