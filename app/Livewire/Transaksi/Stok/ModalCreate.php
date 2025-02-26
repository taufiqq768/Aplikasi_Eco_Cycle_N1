<?php

namespace App\Livewire\Transaksi\Stok;

use App\Helpers\JsHelpers;
use App\Models\MasterUnit;
use App\Models\TransaksiStok;
use Livewire\Component;

class ModalCreate extends Component
{
    public $unit;
    public $tahun;
    public $cangkang;
    public $fiber;
    public $tankos;
    public $abu_janjang;
    public $solid;
    public $pome_oil;
    public $pkm;
    public $tea_waste;
    public $limbah_serum;
    public $tunggul_karet;
    public $abu;
    public $ranting;
    public $batang_kayu;
    public $kulit_buah;
    public $husk_skin;
    public $mucilage;


    public function render()
    {
        $units = MasterUnit::where('jenis_unit', '=', 'PKS')
            ->select(
                'kode as kode_unit',
                'nama_unit',
            )
            ->get();
        return view('livewire.transaksi.stok.modal-create', compact('units'));
    }

    public function save()
    {
        $validate = $this->validate([
            'unit' => 'required',
            'tahun' => 'required',
            'cangkang' => 'required|numeric',
            'fiber' => 'required|numeric',
            'tankos' => 'required',
            'abu_janjang' => 'required|numeric',
            'solid' => 'required|numeric',
            'pome_oil' => 'required|numeric',
            'pkm' => 'required|numeric',
            'tea_waste' => 'required|numeric',
            'limbah_serum' => 'required|numeric',
            'tunggul_karet' => 'required|numeric',
            'abu' => 'required|numeric',
            'ranting' => 'required|numeric',
            'kulit_buah' => 'required|numeric',
            'husk_skin' => 'required|numeric',
            'mucilage' => 'required|numeric',
        ]);

        TransaksiStok::create([
            'kode_unit' => $this->unit,
            'tahun' => $this->tahun,
            'stok_cangkang' => $this->cangkang,
            'stok_fiber' => $this->fiber,
            'stok_tankos' => $this->tankos,
            'stok_abu_janjang' => $this->abu_janjang,
            'stok_solid' => $this->solid,
            'stok_pome_oil' => $this->pome_oil,
            'stok_pkm' => $this->pkm,
            'stok_tea_waste' => $this->tea_waste,
            'stok_limbah_serum' => $this->limbah_serum,
            'stok_tunggul_karet' => $this->tunggul_karet,
            'stok_abu' => $this->abu,
            'stok_ranting' => $this->ranting,
            'stok_kulit_buah' => $this->kulit_buah,
            'stok_husk_skin' => $this->husk_skin,
            'stok_mucilage' => $this->mucilage,
        ]);

        $this->reset();
        $this->dispatch('refreshTable');
        JsHelpers::closeModal($this, 'modalCreate');
    }
}
