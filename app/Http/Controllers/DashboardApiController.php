<?php

namespace App\Http\Controllers;

use App\Models\HargaNormalWaist;
use App\Models\MasterUnit;
use App\Repositories\StoredProcedure;
use Auth;
use Illuminate\Http\Request;

class DashboardApiController extends Controller
{
    protected $storedProcedure;
    public function __construct()
    {
        $this->storedProcedure = new StoredProcedure();
    }

    public function dashboardDataPenjualan($bulan, $tahun)
    {
        $dataApi['labels'] = [
            'Cangkang',
            'Fiber',
            'Tankos',
            'Abu Janjang',
            'Solid',
            'Pome Oil',
            'PKM',
        ];
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStock = collect($this->storedProcedure->getDashboardDataRegion($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStock = collect($this->storedProcedure->getDashboardDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $dataStock = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        }

        $dataStock->pendapatanCangkang = $dataStock->sum('pendapatan_cangkang');
        $dataStock->pendapatanFiber = $dataStock->sum('pendapatan_fiber');
        $dataStock->pendapatanTankos = $dataStock->sum('pendapatan_tankos');
        $dataStock->pendapatanAbuJanjang = $dataStock->sum('pendapatan_abu_janjang');
        $dataStock->pendapatanSolid = $dataStock->sum('pendapatan_solid');
        $dataStock->pendapatanPomeOil = $dataStock->sum('pendapatan_pome_oil');
        $dataStock->pendapatanPkm = $dataStock->sum('pendapatan_pkm');
        $dataStock->totalPendapatan = $dataStock->sum('pendapatan_cangkang') + $dataStock->sum('pendapatan_fiber') + $dataStock->sum('pendapatan_tankos') + $dataStock->sum('pendapatan_abu_janjang') + $dataStock->sum('pendapatan_solid') + $dataStock->sum('pendapatan_pome_oil') + $dataStock->sum('pendapatan_pkm');

        $dataStock->totalPenjualanCangkang = $dataStock->sum('penjualan_cangkang');
        $dataStock->totalPenjualanFiber = $dataStock->sum('penjualan_fiber');
        $dataStock->totalPenjualanTankos = $dataStock->sum('penjualan_tankos');
        $dataStock->totalPenjualanAbuJanjang = $dataStock->sum('penjualan_abu_janjang');
        $dataStock->totalPenjualanSolid = $dataStock->sum('penjualan_solid');
        $dataStock->totalPenjualanPomeOil = $dataStock->sum('penjualan_pome_oil');
        $dataStock->totalPenjualanPkm = $dataStock->sum('penjualan_pkm');
        $dataStock->totalPenjualan = $dataStock->totalPenjualanCangkang + $dataStock->totalPenjualanFiber + $dataStock->totalPenjualanTankos + $dataStock->totalPenjualanAbuJanjang + $dataStock->totalPenjualanSolid + $dataStock->totalPenjualanPomeOil + $dataStock->totalPenjualanPkm;

        $dataApi['dataPenjualan'] = [
            $dataStock->totalPenjualanCangkang,
            $dataStock->totalPenjualanFiber,
            $dataStock->totalPenjualanTankos,
            $dataStock->totalPenjualanAbuJanjang,
            $dataStock->totalPenjualanSolid,
            $dataStock->totalPenjualanPomeOil,
            $dataStock->totalPenjualanPkm,
        ];

        $dataApi['dataPendapatan'] = [
            $dataStock->pendapatanCangkang,
            $dataStock->pendapatanFiber,
            $dataStock->pendapatanTankos,
            $dataStock->pendapatanAbuJanjang,
            $dataStock->pendapatanSolid,
            $dataStock->pendapatanPomeOil,
            $dataStock->pendapatanPkm,
        ];

        $hargaNormal = HargaNormalWaist::where('tahun', $tahun)->get()->toArray();
        $hargaNormalByKategori = [];
        foreach ($hargaNormal as $item) {
            $hargaNormalByKategori[$item['kategori']] = $item;
        }
        if ($hargaNormal) {
            $dataApi['hargaNormal'] = [
                $hargaNormalByKategori['Cangkang']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Fiber']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Tankos']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Abu Janjang']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Solid']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Pome Oil']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['PKM']['harga_per_kg'] ?? 0,
            ];
        } else {
            $dataApi['hargaNormal'] = [
                0,
                0,
                0,
                0,
                0,
                0,
                0,
            ];
        }

        return response()->json($dataApi);
    }

    public function dataStokChartPie($bulan, $tahun)
    {
        $dataApi['labels'] = [
            'Cangkang',
            'Fiber',
            'Tankos',
            'Abu Janjang',
            'Solid',
            'Pome Oil',
            'PKM',
        ];

        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStock = collect($this->storedProcedure->getDashboardDataRegion($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStock = collect($this->storedProcedure->getDashboardDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $dataStock = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        }

        $dataStock->sisaAllCangkang = $dataStock->sum('sisa_cangkang');
        $dataStock->sisaAllFiber = $dataStock->sum('sisa_fiber');
        $dataStock->sisaAllTankos = $dataStock->sum('sisa_tankos');
        $dataStock->sisaAllAbuJanjang = $dataStock->sum('sisa_abu_janjang');
        $dataStock->sisaAllSolid = $dataStock->sum('sisa_solid');
        $dataStock->sisaAllPomeOil = $dataStock->sum('sisa_pome_oil');
        $dataStock->sisaAllPkm = $dataStock->sum('sisa_pkm');

        $dataApi['dataStokChart'] = [
            $dataStock->sisaAllCangkang,
            $dataStock->sisaAllFiber,
            $dataStock->sisaAllTankos,
            $dataStock->sisaAllAbuJanjang,
            $dataStock->sisaAllSolid,
            $dataStock->sisaAllPomeOil,
            $dataStock->sisaAllPkm,
        ];

        return response()->json($dataApi);
    }

    public function dataRegionStokChart($bulan, $tahun)
    {
        $labels = [
            'Cangkang',
            'Fiber',
            'Tankos',
            'Abu Janjang',
            'Solid',
            'Pome Oil',
            'PKM',
        ];

        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStock = collect($this->storedProcedure->getDashboardDataRegion($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStock = collect($this->storedProcedure->getDashboardDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $dataStock = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        }
        $listRegion = $dataStock->pluck('nama')->toArray();

        $dataRegionStockChart = [];

        foreach ($labels as $label) {
            $dataRegionStockChart[] = [
                'name' => $label,
                'data' => [],
            ];
        }

        foreach ($dataStock as $data) {
            $dataRegionStockChart[0]['data'][] = $data->sisa_cangkang / 1000;
            $dataRegionStockChart[1]['data'][] = $data->sisa_fiber / 1000;
            $dataRegionStockChart[2]['data'][] = $data->sisa_tankos / 1000;
            $dataRegionStockChart[3]['data'][] = $data->sisa_abu_janjang / 1000;
            $dataRegionStockChart[4]['data'][] = $data->sisa_solid / 1000;
            $dataRegionStockChart[5]['data'][] = $data->sisa_pome_oil / 1000;
            $dataRegionStockChart[6]['data'][] = $data->sisa_pkm / 1000;
        }

        $dataApi['labels'] = $listRegion;
        $dataApi['dataRegionStockChart'] = $dataRegionStockChart;

        return response()->json($dataApi);
    }

    public function dataProduksiDigunakanChart($bulan, $tahun)
    {
        $labels = [
            'Cangkang',
            'Fiber',
            'Tankos',
            'Abu Janjang',
            'Solid',
            'Pome Oil',
            'PKM',
        ];
        $dataApi['labels'] = $labels;

        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStock = collect($this->storedProcedure->getDashboardDataRegion($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStock = collect($this->storedProcedure->getDashboardDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $dataStock = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        }

        $dataApi['digunakan'][0] = $dataStock->sum('cangkang_digunakan');
        $dataApi['digunakan'][1] = $dataStock->sum('fiber_digunakan');
        $dataApi['digunakan'][2] = $dataStock->sum('tankos_digunakan');
        $dataApi['digunakan'][3] = $dataStock->sum('abu_janjang_digunakan');
        $dataApi['digunakan'][4] = $dataStock->sum('solid_digunakan');
        $dataApi['digunakan'][5] = $dataStock->sum('pome_digunakan');
        $dataApi['digunakan'][6] = $dataStock->sum('pkm_digunakan');

        $dataApi['diproduksi'][0] = $dataStock->sum('produksi_cangkang') + $dataStock->sum('cangkang_diterima_dari_pks_lain') + $dataStock->sum('stok_cangkang_awal_tahun');
        $dataApi['diproduksi'][1] = $dataStock->sum('produksi_fiber') + $dataStock->sum('fiber_diterima_dari_pks_lain') + $dataStock->sum('stok_fiber_awal_tahun');
        $dataApi['diproduksi'][2] = $dataStock->sum('produksi_tankos') + $dataStock->sum('tankos_diterima_dari_pks_lain') + $dataStock->sum('stok_tankos_awal_tahun');
        $dataApi['diproduksi'][3] = $dataStock->sum('produksi_abu_janjang') + $dataStock->sum('abu_janjang_diterima_dari_pks_lain') + $dataStock->sum('stok_abu_janjang_awal_tahun');
        $dataApi['diproduksi'][4] = $dataStock->sum('produksi_solid') + $dataStock->sum('solid_diterima_dari_pks_lain') + $dataStock->sum('stok_solid_awal_tahun');
        $dataApi['diproduksi'][5] = $dataStock->sum('produksi_pome_oil') + $dataStock->sum('pome_diterima_dari_pks_lain') + $dataStock->sum('stok_pome_oil_awal_tahun');
        $dataApi['diproduksi'][6] = $dataStock->sum('produksi_pkm') + $dataStock->sum('pkm_diterima_dari_pks_lain') + $dataStock->sum('stok_pkm_awal_tahun');

        $dataApi['stokSaatIni'][0] = $dataStock->sum('sisa_cangkang');
        $dataApi['stokSaatIni'][1] = $dataStock->sum('sisa_fiber');
        $dataApi['stokSaatIni'][2] = $dataStock->sum('sisa_tankos');
        $dataApi['stokSaatIni'][3] = $dataStock->sum('sisa_abu_janjang');
        $dataApi['stokSaatIni'][4] = $dataStock->sum('sisa_solid');
        $dataApi['stokSaatIni'][5] = $dataStock->sum('sisa_pome_oil');
        $dataApi['stokSaatIni'][6] = $dataStock->sum('sisa_pkm');

        $dataApi['dijual'][0] = $dataStock->sum('penjualan_cangkang');
        $dataApi['dijual'][1] = $dataStock->sum('penjualan_fiber');
        $dataApi['dijual'][2] = $dataStock->sum('penjualan_tankos');
        $dataApi['dijual'][3] = $dataStock->sum('penjualan_abu_janjang');
        $dataApi['dijual'][4] = $dataStock->sum('penjualan_solid');
        $dataApi['dijual'][5] = $dataStock->sum('penjualan_pome_oil');
        $dataApi['dijual'][6] = $dataStock->sum('penjualan_pkm');

        return response()->json($dataApi);
    }

    public function dataScatter($bulan, $tahun, $tipe)
    {
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStockRaw = collect($this->storedProcedure->getUnitAllDataRegion($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStockRaw = collect($this->storedProcedure->getUnitAllDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $dataStockRaw = collect($this->storedProcedure->getUnitAllData($bulan, $tahun));
        }
        $tipe == 'pome' ? $tipeStok = 'pome_oil' : $tipeStok = $tipe;

        $dataStockFiltered = $dataStockRaw->filter(function ($item) use ($tipeStok) {
            return isset($item->{'penjualan_'.$tipeStok}) && $item->{'penjualan_'.$tipeStok} > 0;
        })->values();

        $dataApi['dataSeries'] = $dataStockFiltered->map(function ($item) use ($tipe, $tipeStok) {
            return [
                'x' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'} + $item->{$tipe.'_diterima_dari_pks_lain'},
                'y' => $item->{'penjualan_'.$tipeStok},
                'name' => $item->nama_unit,
                'customData' => [
                    'name' => $item->nama_unit,
                    'produksi' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'} + $item->{$tipe.'_diterima_dari_pks_lain'},
                    'penjualan' => $item->{'penjualan_'.$tipeStok}
                ]
            ];
        })->values();

        $dataApi['annotations'] = $dataStockFiltered->map(function ($item) use ($tipe, $tipeStok) {
            return [
                'x' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'} + $item->{$tipe.'_diterima_dari_pks_lain'},
                'y' => $item->{'penjualan_'.$tipeStok},
                'label' => [
                    'text' => $item->nama_unit,
                    'style' => [
                        'fontSize' => '8px',
                        'color' => '#fff',
                        'background' => 'transparent',
                    ],
                    'offsetY' => 0,
                ]
            ];
        })->values();


        return response()->json($dataApi);
    }

    public function dataScatterBi($bulan, $tahun, $tipe)
    {
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStockRaw = collect($this->storedProcedure->getUnitAllDataRegion($bulan, $tahun, $kode_region));
        } else if (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStockRaw = collect($this->storedProcedure->getUnitAllDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $dataStockRaw = collect($this->storedProcedure->getUnitAllData($bulan, $tahun, true));
        }
        $tipe == 'pome' ? $tipeStok = 'pome_oil' : $tipeStok = $tipe;

        $dataStockFiltered = $dataStockRaw->filter(function ($item) use ($tipeStok) {
            return isset($item->{'penjualan_'.$tipeStok}) && $item->{'penjualan_'.$tipeStok} > 0;
        })->values();

        $dataApi['dataSeries'] = $dataStockFiltered->map(function ($item) use ($tipe, $tipeStok) {
            return [
                'x' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'} + $item->{$tipe.'_diterima_dari_pks_lain'},
                'y' => $item->{'penjualan_'.$tipeStok},
                'name' => $item->nama_unit,
                'customData' => [
                    'name' => $item->nama_unit,
                    'produksi' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'} + $item->{$tipe.'_diterima_dari_pks_lain'},
                    'penjualan' => $item->{'penjualan_'.$tipeStok}
                ]
            ];
        })->values();

        $dataApi['annotations'] = $dataStockFiltered->map(function ($item) use ($tipe, $tipeStok) {
            return [
                'x' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'} + $item->{$tipe.'_diterima_dari_pks_lain'},
                'y' => $item->{'penjualan_'.$tipeStok},
                'label' => [
                    'text' => $item->nama_unit,
                    'style' => [
                        'fontSize' => '8px',
                        'color' => '#fff',
                        'background' => 'transparent',
                    ],
                    'offsetY' => 0,
                ]
            ];
        })->values();


        return response()->json($dataApi);
    }

    public function getDetailChartSd($bulan, $tahun, $tipe)
    {
        // $data = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $data = collect($this->storedProcedure->getDashboardDataRegion($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $data = collect($this->storedProcedure->getDashboardDataUnit($bulan, $tahun, $kode_unit));
        } else {
            $data = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        }
        $labels = $data->pluck('nama');
        if ($tipe == 'pome') {
            $tipeStok = 'pome_oil';
        } else {
            $tipeStok = $tipe;
        }
        $stokAwalTahun = $data->pluck('stok_'.$tipeStok.'_awal_tahun');
        $stokSaatIni = $data->pluck('sisa_'.$tipeStok);
        $pendapatan = $data->pluck('pendapatan_'.$tipeStok);
        $dijual = $data->pluck('penjualan_'.$tipeStok);
        $produksi = $data->pluck('produksi_'.$tipeStok);
        $diterima = $data->pluck($tipeStok.'_diterima_dari_pks_lain');
        $digunakan = $data->pluck($tipe.'_digunakan');
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

    public function getDetailChartBi($bulan, $tahun, $tipe)
    {
        // $data = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $data = collect($this->storedProcedure->getDashboardDataRegionBi($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $data = collect($this->storedProcedure->getDashboardDataUnitBi($bulan, $tahun, $kode_unit));
        } else {
            $data = collect($this->storedProcedure->getDashboardDataBi($bulan, $tahun));
        }
        $labels = $data->pluck('nama');
        if ($tipe == 'pome') {
            $tipeStok = 'pome_oil';
        } else {
            $tipeStok = $tipe;
        }
        $stokAwalTahun = $data->pluck('stok_'.$tipeStok.'_awal_tahun');
        $stokSaatIni = $data->pluck('sisa_'.$tipeStok);
        $pendapatan = $data->pluck('pendapatan_'.$tipeStok);
        $dijual = $data->pluck('penjualan_'.$tipeStok);
        $produksi = $data->pluck('produksi_'.$tipeStok);
        $diterima = $data->pluck($tipeStok.'_diterima_dari_pks_lain');
        $digunakan = $data->pluck($tipe.'_digunakan');
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

    public function getDataItemDetail($bulan, $tahun, $tipe)
    {
        try {
            if (in_array($tipe, ['cangkang', 'fiber', 'tankos', 'abu_janjang', 'solid', 'pome', 'pkm'])) {
                if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
                    $kode_region = substr(Auth::user()->kode_unit, 0, 1);
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormatRegion($bulan, $tahun, false, $tipe, $kode_region));
                } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
                    $kode_unit = Auth::user()->kode_unit;
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormatUnit($bulan, $tahun, false, $tipe, $kode_unit));
                } else {
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormat($bulan, $tahun, false, $tipe));
                }
                // $dataItem = MasterUnit::query()
                //     ->withCangkang($bulan, $tahun)
                //     ->get();
            } else {
                return response()->json([
                    'error' => 'Something went wrong',
                    'message' => 'Tipe not found'
                ], 500);
            }

            $totalData = $dataItem->count();

            $json_data = [
                "recordsTotal" => $totalData,
                "data" => $dataItem
            ];

            return response()->json($json_data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getDataItemDetailBi($bulan, $tahun, $tipe)
    {
        try {
            if (in_array($tipe, ['cangkang', 'fiber', 'tankos', 'abu_janjang', 'solid', 'pome', 'pkm'])) {
                if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
                    $kode_region = substr(Auth::user()->kode_unit, 0, 1);
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormatRegion($bulan, $tahun, true, $tipe, $kode_region));
                } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
                    $kode_unit = Auth::user()->kode_unit;
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormatUnit($bulan, $tahun, true, $tipe, $kode_unit));
                } else {
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormat($bulan, $tahun, true, $tipe));
                }
                // $dataItem = MasterUnit::query()
                //     ->withCangkang($bulan, $tahun)
                //     ->get();
            } else {
                return response()->json([
                    'error' => 'Something went wrong',
                    'message' => 'Tipe not found'
                ], 500);
            }

            $totalData = $dataItem->count();

            $json_data = [
                "recordsTotal" => $totalData,
                "data" => $dataItem
            ];

            return response()->json($json_data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
