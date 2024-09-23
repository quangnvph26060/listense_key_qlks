<?php

namespace App\Models;

use App\Trait\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListenseKey extends Model
{
    use HasFactory, BaseModel;
    protected $table = 'listense_keys';

    public function __construct()
    {
        parent::__construct();
        $this->model = $this;
    }



    protected $fillable = [
        'code',
        'url',
        'user',
        'email',
        'product'
    ];
}
