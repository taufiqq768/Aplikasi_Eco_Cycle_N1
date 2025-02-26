<?php

namespace App\Livewire\Forms;

use App\Models\LogTransaksi;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class CreateLogForm extends Form
{
    public $uuid;
    public $id_transaksi;
    public $kategori_transaksi;
    public $tipe_transaksi;
    public $jenis_transaksi;
    public $jumlah_sebelum;
    public $jumlah_sesudah;
    public $keterangan;
    public $transaksi_by;
    public $kode_unit;
    public $tanggal;

    public function store()
    {
        LogTransaksi::create([
            'uuid' => Str::uuid(),
            'id_transaksi' => $this->uuid,
            'kategori_transaksi' => 'all',
            'jenis_transaksi' => 'tankos',
            'tipe_transaksi' => 'update',
            'jumlah_sebelum' => '',
            'jumlah_sesudah' => '',
            'keterangan' => '',
            'transaksi_by' => auth()->user()->nik_sap,
            'kode_unit' => $this->kode_unit,
            'tanggal' => Carbon::createFromDate($this->tanggal)->endOfMonth()->format('Y-m-d')
        ]);
    }
}
