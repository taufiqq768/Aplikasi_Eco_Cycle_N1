<?php

namespace App\Livewire\Transaksi;

use App\Models\MasterPeriode;
use Livewire\Component;

class FormInputAir extends Component
{
    public $periode;
    public $unit;
    public $jenis;

    // Air
    public $pengolahan;
    public $teknik;
    public $laboratorium;
    public $sarana_sosial;
    public $perumahan;
    public $lain_lain;
    public $photo;
    public $id_data_air;

    public function render()
    {
        list($bulan, $tahun) = explode('/', $this->periode);
        $periode = MasterPeriode::first();
        $isPeriodeOpen = false;
        $currentYear = (date('m') == 1) ? date('Y') - 1 : date('Y');
        if ((int) date('d') < $periode->tanggal_tutup) {
            $isPeriodeOpen = true;
        }
        return view('livewire.transaksi.form-input-air', compact('isPeriodeOpen'));
    }
}
