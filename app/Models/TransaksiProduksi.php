<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiProduksi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 't_produksi';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $guarded = [];
    public function cangkang()
    {
        return $this->hasOne(TransaksiCangkang::class, 'id_t_produksi', 'uuid');
    }
}
