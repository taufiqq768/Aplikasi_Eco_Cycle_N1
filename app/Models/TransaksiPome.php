<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPome extends Model
{
    use HasFactory, HasUuids;
    protected $table = 't_pome';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $guarded = [];

    public function scopeWithProduksiUnit($query)
    {
        return $query->leftJoin('t_produksi', 't_produksi.uuid', '=', 't_pome.id_t_produksi')
            ->leftJoin('m_unit', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->select(
                't_pome.*',
                't_produksi.produksi_pome_oil',
                'm_unit.nama_unit'
            );
    }
}
