<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBatangKayu extends Model
{
    use HasFactory, HasUuids;

    protected $table = 't_batang_kayu';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $guarded = [];

    public function scopeWithProduksiUnit($query)
    {
        return $query->leftJoin('t_produksi_n1', 't_produksi_n1.uuid', '=', 't_batang_kayu.id_t_produksi')
            ->leftJoin('m_unit_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->select(
                't_batang_kayu.*',
                't_produksi_n1.produksi_batangkayu',
                'm_unit_n1.nama_unit'
            );
    }
}
