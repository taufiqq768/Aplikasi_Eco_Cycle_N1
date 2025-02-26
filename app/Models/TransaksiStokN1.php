<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiStokN1 extends Model
{
    use HasFactory, HasUuids;

    protected $table = 't_stok';
    protected $guarded = ['uuid'];
    protected $primaryKey = 'uuid';

    public function unit()
    {
        return $this->belongsTo(MasterUnitN1::class, 'kode_unit');
    }

}
