<?php

namespace App\Livewire\Transaksi;

use App\Enum\KategoriPemakaianSumberDaya;
use App\Enum\KategoriTransaksiEnum;
use App\Enum\UserRoleEnum;
use App\Models\MasterUnit;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class FormInput extends Component
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
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $allUnit = MasterUnit::query()
                ->select(
                    'kode as kode_unit',
                    'nama_unit'
                )
                ->where('kode_region', $kode_region)
                ->get();
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $allUnit = MasterUnit::query()
                ->select(
                    'kode as kode_unit',
                    'nama_unit'
                )
                ->where('kode', $kode_unit)
                ->get();
        } else {
            $allUnit = MasterUnit::query()
                ->select(
                    'kode as kode_unit',
                    'nama_unit',
                    'is_active'
                )
                ->where('is_active', 1)
                ->get();
        }
        $jenisList = KategoriTransaksiEnum::cases();
        $jenisList = array_merge($jenisList, KategoriPemakaianSumberDaya::cases());
        $this->dispatch('jsInit');
        return view('livewire.transaksi.form-input', compact(
            'jenisList',
            'allUnit',
        ));
    }
}
