<?php

namespace App\Livewire\Transaksi\Cangkang;

use App\Models\MasterRegion;
use App\Models\MasterUnit;
use App\Models\TransaksiCangkang;
use App\Repositories\StoredProcedure;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class View extends Component
{
    public function render()
    {
        // $data = MasterRegion::withAll()->get();
        // dd($data);
        // dd($this->storedProcedure->getDashboardData(2024));
        $bulan = date('m');
        $tahun = date('Y');
        $bulan = date('m');
        // $data = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        // $labels = $data->pluck('nama');
        // $stokAwalTahun = $data->pluck('stok_cangkang_awal_tahun');
        // $stokSaatIni = $data->pluck('sisa_cangkang');
        // $produksi = $data->pluck('produksi_cangkang');
        // $diterima = $data->pluck('cangkang_diterima_dari_pks_lain');
        // $digunakan = $data->pluck('cangkang_digunakan');
        // $diproduksi = $produksi->map(function ($item, $key) use ($diterima, $stokAwalTahun) {
        //     return $item + $diterima[$key] + $stokAwalTahun[$key];
        // });
        // $this->dispatch('initDataTable');

        return view('livewire.transaksi.cangkang.view', compact(
            'bulan',
            'tahun'
        ));
    }

    public function getCangkang($bulan, $tahun)
    {
        try {
            $dataCangkang = MasterUnit::query()
                ->withCangkang($bulan, $tahun)
                ->get();

            $totalData = $dataCangkang->count();

            $json_data = [
                "recordsTotal" => $totalData,
                "data" => $dataCangkang
            ];

            return response()->json($json_data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    #[On('render')]
    public function refresh()
    {
        $this->render();
    }

    public function getChartCangkangSd(StoredProcedure $storedProcedure, $bulan, $tahun)
    {
        // $data = collect($storedProcedure->getDashboardData($bulan, $tahun));
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $data = collect($storedProcedure->getDashboardDataRegion($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $data = collect($storedProcedure->getDashboardDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $data = collect($storedProcedure->getDashboardData($bulan, $tahun));
        }
        $labels = $data->pluck('nama');
        $stokAwalTahun = $data->pluck('stok_cangkang_awal_tahun');
        $stokSaatIni = $data->pluck('sisa_cangkang');
        $pendapatan = $data->pluck('pendapatan_cangkang');
        $dijual = $data->pluck('penjualan_cangkang');
        $produksi = $data->pluck('produksi_cangkang');
        $diterima = $data->pluck('cangkang_diterima_dari_pks_lain');
        $digunakan = $data->pluck('cangkang_digunakan');
        $hargaRataRata = $dijual->map(function ($item, $key) use ($pendapatan) {
            return $item != 0 ? round($pendapatan[$key] / $item, 2) : 0;
        });
        $diproduksi = $produksi->map(function ($item, $key) use ($diterima, $stokAwalTahun) {
            return $item + $diterima[$key] + $stokAwalTahun[$key];
        });

        return response()->json([
            'labels' => $labels,
            'diproduksi' => $diproduksi,
            'digunakan' => $digunakan,
            'stokSaatIni' => $stokSaatIni,
            'dijual' => $dijual,
            'pendapatan' => $pendapatan,
            'hargaRataRata' => $hargaRataRata
        ]);
    }
}
