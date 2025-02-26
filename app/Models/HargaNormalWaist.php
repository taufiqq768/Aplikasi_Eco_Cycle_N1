<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaNormalWaist extends Model
{
    use HasFactory;

    protected $table = 'harga_normal_waist';
    protected $guarded = ['id'];
}
