<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komoditas extends Model
{
    use HasFactory;
    protected $table = 'm_komoditas';
    protected $primaryKey = 'KomoditasId';
    // public $timestamps = false;

    public function scopeWithAll($query)
    {
        return $query->select(
            'm_komoditas.*')->orderBy('m_komoditas.KomoditasId', 'asc');
    }

}
