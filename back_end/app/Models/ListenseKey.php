<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListenseKey extends Model
{
    use HasFactory;
    protected $table = 'listense_key';
    protected $fillable = [
        'code', 'url', 'user', 'email', 'product'
    ];
}
