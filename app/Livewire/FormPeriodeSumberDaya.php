<?php

namespace App\Livewire;

use App\Enum\KategoriPemakaianSumberDaya;
use App\Enum\KategoriTransaksiEnum;
use App\Models\MasterUnit;
use Livewire\Component;

class FormPeriodeSumberDaya extends Component
{
    public $periode;
    public $bulan;
    public $tahun;
    public $unitSelected;
    public $tempPeriode;
    public $bulanList;

    public function mount()
    {
        $this->bulanList = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];
    }
    public function render()
    {
        $allUnit = MasterUnit::query()
            ->select(
                'kode as kode_unit',
                'nama_unit'
            )
            ->get();
        $jenisList = KategoriPemakaianSumberDaya::cases();
        $this->dispatch('jsInit');
        return view('livewire.form-periode-sumber-daya', compact(
            'jenisList',
            'allUnit'
        ));
    }
}
