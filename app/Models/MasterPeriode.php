<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPeriode extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'm_periode';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $guarded = [];
}
