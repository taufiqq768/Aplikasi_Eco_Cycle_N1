<?php

namespace App\Livewire\Transaksi\Stokn1;

use App\Helpers\JsHelpers;
use App\Models\MasterUnitN1;
use App\Models\TransaksiStokN1;
use Livewire\Component;

class ModalCreate extends Component
{
    public $unit;
    public $tahun;
    public $tea_waste;
    public $abu_he;
    public $limbah_serum;
    public $tunggul_karet;
    public $abu;
    public $ranting;
    public $batang_kayu;
    public $rubber_trap;
    public $kulit_buah;
    public $husk_skin;
    public $mucilage;


    public function render()
    {
        $units = MasterUnitN1::whereIn('jenis_unit', ['TEH', 'KARET', 'KOPI'])
            ->select(
                'kode as kode_unit',
                'nama_unit',
            )
            ->get();
        return view('livewire.transaksi.stokn1.modal-create', compact('units'));
    }

    public function save()
    {
        $validate = $this->validate([
            'unit' => 'required',
            'tahun' => 'required',
            'tea_waste' => 'required|numeric',
            'abu_he' => 'required|numeric',
            'limbah_serum' => 'required|numeric',
            'tunggul_karet' => 'required|numeric',
            'abu' => 'required|numeric',
            'ranting' => 'required|numeric',
            'batang_kayu' => 'required|numeric',
            'rubber_trap' => 'required|numeric',
            'kulit_buah' => 'required|numeric',
            'husk_skin' => 'required|numeric',
            'mucilage' => 'required|numeric',
        ]);

        TransaksiStokN1::create([
            'kode_unit' => $this->unit,
            'tahun' => $this->tahun,
            'stok_abu_he' => $this->abu_he,
            'stok_tea_waste' => $this->tea_waste,
            'stok_limbah_serum' => $this->limbah_serum,
            'stok_tunggul_karet' => $this->tunggul_karet,
            'stok_abu' => $this->abu,
            'stok_ranting' => $this->ranting,
            'stok_batang_kayu' => $this->batang_kayu,
            'stok_rubber_trap' => $this->rubber_trap,
            'stok_kulit_buah' => $this->kulit_buah,
            'stok_husk_skin' => $this->husk_skin,
            'stok_mucilage' => $this->mucilage,
        ]);

        $this->reset();
        $this->dispatch('refreshTable');
        JsHelpers::closeModal($this, 'modalCreate');
    }
}
