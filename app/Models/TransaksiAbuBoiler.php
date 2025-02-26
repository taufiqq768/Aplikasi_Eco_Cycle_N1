<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiAbuBoiler extends Model
{
    use HasFactory, HasUuids;

    protected $table = 't_abu_boiler';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $guarded = [];
}
