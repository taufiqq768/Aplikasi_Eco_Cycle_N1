<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'nik_sap';
    protected $fillable = [
        'nama',
        'nik_sap',
        'unit_penugasan',
        'tanggal_selesai_penugasan',
        'role',
        'kode_unit',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }

    public function setKodeUnitAttribute($value): void
    {
        if (!is_null($this->unit_penugasan) && $this->isPenugasanActive()) {
            $this->attributes['kode_unit'] = $this->unit_penugasan;
        } else {
            $this->attributes['kode_unit'] = $value;
        }
    }

    public function isPenugasanActive(): bool
    {
        return is_null($this->tanggal_selesai_penugasan) || Carbon::parse($this->tanggal_selesai_penugasan)->isFuture();
    }

    public function getKodeUnitAttribute(): string
    {
        if (!is_null($this->unit_penugasan) && $this->isPenugasanActive()) {
            return $this->unit_penugasan;
        }

        return $this->attributes['kode_unit'] ?? '';
    }
}
