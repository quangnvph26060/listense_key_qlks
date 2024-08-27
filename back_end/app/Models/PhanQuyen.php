<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanQuyen extends Model
{
    use HasFactory;
    protected $table = 'phan_quyen';
    protected $fillable = [
        "phan_quyen"
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
