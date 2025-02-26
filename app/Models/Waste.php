<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class waste extends Model
{
    use HasFactory;
    protected $table = 'm_jenis_waste';

    public function scopeWithAll($query)
    {
        return $query->select('m_jenis_waste.*')->orderBy('m_jenis_waste.WasteName');
    }

}
