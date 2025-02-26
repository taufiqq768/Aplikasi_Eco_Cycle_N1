<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiCangkang extends Model
{
    use HasFactory, HasUuids;
    protected $table = 't_cangkang';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $appends = ['stock', 'sisa_cangkang'];
    protected $guarded = [];
    public function produksi()
    {
        return $this->belongsTo(TransaksiProduksi::class, 'id_t_produksi', 'uuid');
    }

    public function scopeWithProduksiUnit($query)
    {
        return $query->leftJoin('t_produksi', 't_produksi.uuid', '=', 't_cangkang.id_t_produksi')
            ->leftJoin('m_unit', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->select(
                't_cangkang.*',
                't_produksi.produksi_cangkang',
                'm_unit.nama_unit'
            );
    }
}
