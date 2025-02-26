<?php

namespace App\Livewire;

use App\Models\MasterRegion;
use App\Models\MasterUnit;
use App\Models\TransaksiCangkang;
use App\Models\TransaksiProduksi;
use App\Repositories\RegionQuery;
use App\Repositories\StoredProcedure;
use Auth;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    public $dataSample = 0;
    public $dataStock;
    public $bulan;
    public $tahun;

    public function mount()
    {
        $regionService = new StoredProcedure();
        $bulan = date('m');
        $tahun = date('Y');
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $this->dataStock = collect($regionService->getDashboardDataRegion($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $this->dataStock = collect($regionService->getDashboardDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $this->dataStock = collect($regionService->getDashboardData($bulan, $tahun));
        }
    }
    public function render()
    {
        $dataStockChart = [];

        $dataStock = $this->dataStock;
        $dataStock->sisaAllCangkang = $dataStock->sum('sisa_cangkang');
        $dataStock->sisaAllFiber = $dataStock->sum('sisa_fiber');
        $dataStock->sisaAllTankos = $dataStock->sum('sisa_tankos');
        $dataStock->sisaAllAbuJanjang = $dataStock->sum('sisa_abu_janjang');
        $dataStock->sisaAllSolid = $dataStock->sum('sisa_solid');
        $dataStock->sisaAllPomeOil = $dataStock->sum('sisa_pome_oil');
        $dataStock->sisaAllPkm = $dataStock->sum('sisa_pkm');

        $dataStock->pendapatanCangkang = $dataStock->sum('pendapatan_cangkang');
        $dataStock->pendapatanFiber = $dataStock->sum('pendapatan_fiber');
        $dataStock->pendapatanTankos = $dataStock->sum('pendapatan_tankos');
        $dataStock->pendapatanAbuJanjang = $dataStock->sum('pendapatan_abu_janjang');
        $dataStock->pendapatanSolid = $dataStock->sum('pendapatan_solid');
        $dataStock->pendapatanPomeOil = $dataStock->sum('pendapatan_pome_oil');
        $dataStock->pendapatanPkm = $dataStock->sum('pendapatan_pkm');

        $dataStock->totalPenjualanCangkang = $dataStock->sum('penjualan_cangkang');
        $dataStock->totalPenjualanFiber = $dataStock->sum('penjualan_fiber');
        $dataStock->totalPenjualanTankos = $dataStock->sum('penjualan_tankos');
        $dataStock->totalPenjualanAbuJanjang = $dataStock->sum('penjualan_abu_janjang');
        $dataStock->totalPenjualanSolid = $dataStock->sum('penjualan_solid');
        $dataStock->totalPenjualanPomeOil = $dataStock->sum('penjualan_pome_oil');
        $dataStock->totalPenjualanPkm = $dataStock->sum('penjualan_pkm');
        $dataStock->totalPenjualan = $dataStock->totalPenjualanCangkang + $dataStock->totalPenjualanFiber + $dataStock->totalPenjualanTankos + $dataStock->totalPenjualanAbuJanjang + $dataStock->totalPenjualanSolid + $dataStock->totalPenjualanPomeOil + $dataStock->totalPenjualanPkm;

        $dataStock->totalPendapatan = $dataStock->sum('pendapatan_cangkang') + $dataStock->sum('pendapatan_fiber') + $dataStock->sum('pendapatan_tankos') + $dataStock->sum('pendapatan_abu_janjang') + $dataStock->sum('pendapatan_solid') + $dataStock->sum('pendapatan_pome_oil') + $dataStock->sum('pendapatan_pkm');

        $dataStock->totalHargaRataCangkang = $dataStock->totalPenjualanCangkang ? $dataStock->pendapatanCangkang / $dataStock->totalPenjualanCangkang : 0;
        $dataStock->totalHargaRataFiber = $dataStock->totalPenjualanFiber ? $dataStock->pendapatanFiber / $dataStock->totalPenjualanFiber : 0;
        $dataStock->totalHargaRataTankos = $dataStock->totalPenjualanTankos ? $dataStock->pendapatanTankos / $dataStock->totalPenjualanTankos : 0;
        $dataStock->totalHargaRataAbuJanjang = $dataStock->totalPenjualanAbuJanjang ? $dataStock->pendapatanAbuJanjang / $dataStock->totalPenjualanAbuJanjang : 0;
        $dataStock->totalHargaRataSolid = $dataStock->totalPenjualanSolid ? $dataStock->pendapatanSolid / $dataStock->totalPenjualanSolid : 0;
        $dataStock->totalHargaRataPomeOil = $dataStock->totalPenjualanPomeOil ? $dataStock->pendapatanPomeOil / $dataStock->totalPenjualanPomeOil : 0;
        $dataStock->totalHargaRataPkm = $dataStock->totalPenjualanPkm ? $dataStock->pendapatanPkm / $dataStock->totalPenjualanPkm : 0;
        $bulan = date('m');
        $tahun = date('Y');
        return view('livewire.dashboard', compact(
            'dataStock',
            'bulan',
            'tahun'
        ));
    }

    #[On('reload')]
    public function refresh_satu($bulan, $tahun)
    {
        $regionService = new StoredProcedure();
        $this->dataStock = collect($regionService->getDashboardData($bulan, $tahun));
        $this->bulan = 2;
        $this->render();
        // $this->dataSample = rand(1, 100);
        // $this->render();
    }

    public function getDataDashboardApi($bulan, $tahun)
    {
        $regionService = new StoredProcedure();
        $this->dataStock = collect($regionService->getDashboardData($bulan, $tahun));

    }
}
