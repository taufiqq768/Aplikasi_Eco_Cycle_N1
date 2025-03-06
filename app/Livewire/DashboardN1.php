<?php

namespace App\Livewire;

use App\Models\MasterRegion;
use App\Models\MasterUnitN1;
use App\Models\TransaksiProduksiN1;
use App\Repositories\RegionQuery;
use App\Repositories\StoredProcedure_N1;
use Auth;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class DashboardN1 extends Component
{
    public $dataSample = 0;
    public $dataStock;
    public $bulan;
    public $tahun;

    public function mount()
    {
        $regionService = new StoredProcedure_N1();
        $bulan = date('m');
        $tahun = date('Y');
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $this->dataStock = collect($regionService->getDashboardDataRegion_N1($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $this->dataStock = collect($regionService->getDashboardDataUnit_N1($bulan, $tahun, $kode_unit));
        } else {
            $this->dataStock = collect($regionService->getDashboardData_N1($bulan, $tahun));
        }
    }
    public function render()
    {
        $dataStockChart = [];

        $dataStock = $this->dataStock;
        $dataStock->sisaAllTeaWaste = $dataStock->sum('sisa_tea_waste');
        $dataStock->sisaAllAbuHe = $dataStock->sum('sisa_abu_he');
        $dataStock->sisaAllLimbahSerum = $dataStock->sum('sisa_limbah_serum');
        $dataStock->sisaAllTunggulKaret = $dataStock->sum('sisa_tunggul_karet');
        $dataStock->sisaAllAbu = $dataStock->sum('sisa_abu');
        $dataStock->sisaAllRanting = $dataStock->sum('sisa_ranting');
        $dataStock->sisaAllBatangKayu = $dataStock->sum('sisa_batang_kayu');
        $dataStock->sisaAllRubberTrap = $dataStock->sum('sisa_rubber_trap');
        $dataStock->sisaAllKulitBuah = $dataStock->sum('sisa_kulit_buah');
        $dataStock->sisaAllHuskSkin = $dataStock->sum('sisa_husk_skin');
        $dataStock->sisaAllMucilage = $dataStock->sum('sisa_mucilage');

        $dataStock->pendapatanTeaWaste = $dataStock->sum('pendapatan_tea_waste');
        $dataStock->pendapatanAbuHe = $dataStock->sum('pendapatan_abu_he');
        $dataStock->pendapatanLimbahSerum = $dataStock->sum('pendapatan_limbah_serum');
        $dataStock->pendapatanTunggulKaret = $dataStock->sum('pendapatan_tunggul_karet');
        $dataStock->pendapatanAbu = $dataStock->sum('pendapatan_abu');
        $dataStock->pendapatanRanting = $dataStock->sum('pendapatan_ranting');
        $dataStock->pendapatanBatangKayu = $dataStock->sum('pendapatan_batang_kayu');
        $dataStock->pendapatanRubberTrap = $dataStock->sum('pendapatan_rubber_trap');
        $dataStock->pendapatanKulitBuah = $dataStock->sum('pendapatan_kulit_buah');
        $dataStock->pendapatanHuskSkin = $dataStock->sum('pendapatan_husk_skin');
        $dataStock->pendapatanMucilage = $dataStock->sum('pendapatan_mucilage');

		$dataStock->totalPenjualanTeaWaste = $dataStock->sum('penjualan_tea_waste');
        $dataStock->totalPenjualanAbuHe = $dataStock->sum('penjualan_abu_he');
        $dataStock->totalPenjualanLimbahSerum = $dataStock->sum('penjualan_limbah_serum');
        $dataStock->totalPenjualanTunggulKaret = $dataStock->sum('penjualan_tunggul_karet');
        $dataStock->totalPenjualanAbu = $dataStock->sum('penjualan_abu');
        $dataStock->totalPenjualanRanting = $dataStock->sum('penjualan_ranting');
        $dataStock->totalPenjualanBatangKayu = $dataStock->sum('penjualan_batang_kayu');
        $dataStock->totalPenjualanRubberTrap = $dataStock->sum('penjualan_rubber_trap');
        $dataStock->totalPenjualanKulitBuah = $dataStock->sum('penjualan_kulit_buah');
        $dataStock->totalPenjualanHuskSkin = $dataStock->sum('penjualan_husk_skin');
        $dataStock->totalPenjualanMucilage = $dataStock->sum('penjualan_mucilage');
        
        $dataStock->totalPenjualan = 
		$dataStock->totalPenjualanTeaWaste
        + $dataStock->totalPenjualanAbuHe
        + $dataStock->totalPenjualanLimbahSerum
        + $dataStock->totalPenjualanTunggulKaret
        + $dataStock->totalPenjualanAbu
        + $dataStock->totalPenjualanRanting
        + $dataStock->totalPenjualanBatangKayu
        + $dataStock->totalPenjualanRubberTrap
        + $dataStock->totalPenjualanKulitBuah
        + $dataStock->totalPenjualanHuskSkin
        + $dataStock->totalPenjualanMucilage;

        $dataStock->totalPendapatan = 
        + $dataStock->pendapatanTeaWaste
        + $dataStock->pendapatanAbuHe
        + $dataStock->pendapatanLimbahSerum
        + $dataStock->pendapatanTunggulKaret
        + $dataStock->pendapatanAbu
        + $dataStock->pendapatanRanting
        + $dataStock->pendapatanBatangKayu
        + $dataStock->pendapatanRubberTrap
        + $dataStock->pendapatanKulitBuah
        + $dataStock->pendapatanHuskSkin
        + $dataStock->pendapatanMucilage;

        $dataStock->totalHargaRataTeaWaste = $dataStock->totalPenjualanTeaWaste ? $dataStock->pendapatanTeaWaste / $dataStock->totalPenjualanTeaWaste : 0;
        $dataStock->totalHargaRataAbuHe = $dataStock->totalPenjualanAbuHe ? $dataStock->pendapatanAbuHe / $dataStock->totalPenjualanAbuHe : 0;
        $dataStock->totalHargaRataLimbahSerum = $dataStock->totalPenjualanLimbahSerum ? $dataStock->pendapatanLimbahSerum / $dataStock->totalPenjualanLimbahSerum : 0;
        $dataStock->totalHargaRataTunggulKaret = $dataStock->totalPenjualanTunggulKaret ? $dataStock->pendapatanTunggulKaret / $dataStock->totalPenjualanTunggulKaret : 0;
        $dataStock->totalHargaRataAbu = $dataStock->totalPenjualanAbu ? $dataStock->pendapatanAbu / $dataStock->totalPenjualanAbu : 0;
        $dataStock->totalHargaRataRanting = $dataStock->totalPenjualanRanting ? $dataStock->pendapatanRanting / $dataStock->totalPenjualanRanting : 0;
        $dataStock->totalHargaRataBatangKayu = $dataStock->totalPenjualanBatangKayu ? $dataStock->pendapatanBatangKayu / $dataStock->totalPenjualanBatangKayu : 0;
        $dataStock->totalHargaRataRubberTrap = $dataStock->totalPenjualanRubberTrap ? $dataStock->pendapatanRubberTrap / $dataStock->totalPenjualanRubberTrap : 0;
        $dataStock->totalHargaRataKulitBuah = $dataStock->totalPenjualanKulitBuah ? $dataStock->pendapatanKulitBuah / $dataStock->totalPenjualanKulitBuah : 0;
        $dataStock->totalHargaRataHuskSkin = $dataStock->totalPenjualanHuskSkin ? $dataStock->pendapatanHuskSkin / $dataStock->totalPenjualanHuskSkin : 0;
        $dataStock->totalHargaRataMucilage = $dataStock->totalPenjualanMucilage ? $dataStock->pendapatanMucilage / $dataStock->totalPenjualanMucilage : 0;

        $bulan = date('m');
        $tahun = date('Y');
        return view('livewire.dashboard-n1', compact(
            'dataStock',
            'bulan',
            'tahun'
        ));
    }

    #[On('reload')]
    public function refresh_satu($bulan, $tahun)
    {
        $regionService = new StoredProcedure_N1();
        $this->dataStock = collect($regionService->getDashboardData_N1($bulan, $tahun));
        $this->bulan = 2;
        $this->render();
        // $this->dataSample = rand(1, 100);
        // $this->render();
    }

    public function getDataDashboardApi_N1($bulan, $tahun)
    {
        $regionService = new StoredProcedure_N1();
        $this->dataStock = collect($regionService->getDashboardData_N1($bulan, $tahun));

    }
}
