<?php

namespace App\Livewire\Transaksi\Ranting;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.ranting.view-data', compact('tahun', 'bulan'));
    }

    public function getRanting($bulan, $tahun)
    {
        try {
            $dataRanting = MasterUnit::query()
                ->withRanting($bulan, $tahun)
                ->get();

            $totalData = $dataRanting->count();

            $json_data = [
                "recordsTotal" => $totalData,
                "data" => $dataRanting
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

    public function getChartRantingSd(StoredProcedure $storedProcedure_N1, $bulan, $tahun)
    {
        // $data = collect($storedProcedure->getDashboardData($bulan, $tahun));
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $data = collect($storedProcedure_N1->getDashboardDataRegion($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $data = collect($storedProcedure_N1->getDashboardDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $data = collect($storedProcedure_N1->getDashboardData($bulan, $tahun));
        }
        $labels = $data->pluck('nama');
        $stokAwalTahun = $data->pluck('stok_ranting_awal_tahun');
        $stokSaatIni = $data->pluck('sisa_ranting');
        $pendapatan = $data->pluck('pendapatan_ranting');
        $dijual = $data->pluck('penjualan_ranting');
        $produksi = $data->pluck('produksi_ranting');
        // $diterima = $data->pluck('ranting_diterima_dari_pks_lain');
        $digunakan = $data->pluck('ranting_digunakan');
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
