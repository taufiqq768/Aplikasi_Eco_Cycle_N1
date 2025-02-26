<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiEvidence extends Model
{
    use HasFactory, HasUuids;

    protected $table = 't_evidence';
    protected $guarded = [];
    protected $primaryKey = 'uuid';

}
