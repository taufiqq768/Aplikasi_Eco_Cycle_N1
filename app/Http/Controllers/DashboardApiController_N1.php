<?php

namespace App\Http\Controllers;

use App\Models\HargaNormalWaist;
use App\Models\MasterUnitN1;
use App\Repositories\StoredProcedure_N1;
use Auth;
use Illuminate\Http\Request;

class DashboardApiController_N1 extends Controller
{
    protected $storedProcedure;
    public function __construct()
    {
        $this->storedProcedure = new StoredProcedure_N1();
    }

    public function dashboardDataPenjualan_N1($bulan, $tahun)
    {
        $dataApi['labels'] = [
            'Tea Waste',
            'Abu HE',
            'Limbah Serum',
            'Tunggul Karet',
            'Abu',
            'Ranting',
            'Batang Kayu',
            'Kulit Buah',
            'Husk Skin',
            'Mucilage',
        ];
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStock = collect($this->storedProcedure->getDashboardDataRegion_N1($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStock = collect($this->storedProcedure->getDashboardDataUnit_N1($bulan, $tahun, $kode_unit));
        } else {
            $dataStock = collect($this->storedProcedure->getDashboardData_N1($bulan, $tahun));
        }

        $dataStock->pendapatanTeaWaste = $dataStock->sum('pendapatan_tea_waste');
        $dataStock->pendapatanAbuHe = $dataStock->sum('pendapatan_abu_he');
        $dataStock->pendapatanLimbahSerum = $dataStock->sum('pendapatan_limbah_serum');
        $dataStock->pendapatanTunggulKaret = $dataStock->sum('pendapatan_tunggul_karet');
        $dataStock->pendapatanAbu = $dataStock->sum('pendapatan_abu');
        $dataStock->pendapatanRanting = $dataStock->sum('pendapatan_ranting');
        $dataStock->pendapatanBatangKayu = $dataStock->sum('pendapatan_batang_kayu');
        $dataStock->pendapatanKulitBuah = $dataStock->sum('pendapatan_kulit_buah');
        $dataStock->pendapatanHuskSkin = $dataStock->sum('pendapatan_husk_skin');
        $dataStock->pendapatanMucilage = $dataStock->sum('pendapatan_mucilage');
        $dataStock->totalPendapatan = 
        $dataStock->sum('pendapatan_tea_waste')
        + $dataStock->sum('pendapatan_abu_he') 
        + $dataStock->sum('pendapatan_limbah_serum') 
        + $dataStock->sum('pendapatan_tunggul_karet') 
        + $dataStock->sum('pendapatan_abu') 
        + $dataStock->sum('pendapatan_ranting') 
        + $dataStock->sum('pendapatan_batang_kayu')
        + $dataStock->sum('pendapatan_kulit_buah') 
        + $dataStock->sum('pendapatan_husk_skin') 
        + $dataStock->sum('pendapatan_mucilage');

        $dataStock->penjualanTeaWaste = $dataStock->sum('penjualan_tea_waste');
        $dataStock->penjualanAbuHe = $dataStock->sum('penjualan_abu_he');
        $dataStock->penjualanLimbahSerum = $dataStock->sum('penjualan_limbah_serum');
        $dataStock->penjualanTunggulKaret = $dataStock->sum('penjualan_tunggul_karet');
        $dataStock->penjualanAbu = $dataStock->sum('penjualan_abu');
        $dataStock->penjualanRanting = $dataStock->sum('penjualan_ranting');
        $dataStock->penjualanBatangKayu = $dataStock->sum('penjualan_batang_kayu');
        $dataStock->penjualanKulitBuah = $dataStock->sum('penjualan_kulit_buah');
        $dataStock->penjualanHuskSkin = $dataStock->sum('penjualan_husk_skin');
        $dataStock->penjualanMucilage = $dataStock->sum('penjualan_mucilage');
        $dataStock->totalPenjualan = 
        $dataStock->sum('penjualan_tea_waste') 
        + $dataStock->sum('penjualan_abu_he')
        + $dataStock->sum('penjualan_limbah_serum') 
        + $dataStock->sum('penjualan_tunggul_karet') 
        + $dataStock->sum('penjualan_abu') 
        + $dataStock->sum('penjualan_ranting') 
        + $dataStock->sum('penjualan_batang_kayu') 
        + $dataStock->sum('penjualan_kulit_buah') 
        + $dataStock->sum('penjualan_husk_skin') 
        + $dataStock->sum('penjualan_mucilage');

        $dataApi['dataPenjualan'] = [
            $dataStock->penjualanTeaWaste,
            $dataStock->penjualanAbuHe,
            $dataStock->penjualanLimbahSerum,
            $dataStock->penjualanTunggulKaret,
            $dataStock->penjualanAbu,
            $dataStock->penjualanRanting,
            $dataStock->penjualanBatangKayu,
            $dataStock->penjualanKulitBuah,
            $dataStock->penjualanHuskSkin,
            $dataStock->penjualanMucilage,
        ];

        $dataApi['dataPendapatan'] = [
            $dataStock->pendapatanTeaWaste,
            $dataStock->pendapatanAbuHe,
            $dataStock->pendapatanLimbahSerum,
            $dataStock->pendapatanTunggulKaret,
            $dataStock->pendapatanAbu,
            $dataStock->pendapatanRanting,
            $dataStock->pendapatanBatangKayu,
            $dataStock->pendapatanKulitBuah,
            $dataStock->pendapatanHuskSkin,
            $dataStock->pendapatanMucilage,
            ];

        $hargaNormal = HargaNormalWaist::where('tahun', $tahun)->get()->toArray();
        $hargaNormalByKategori = [];
        foreach ($hargaNormal as $item) {
            $hargaNormalByKategori[$item['kategori']] = $item;
        }
        if ($hargaNormal) {
            $dataApi['hargaNormal'] = [
                $hargaNormalByKategori['Tea Waste']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Abu He']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Limbah Serum']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Tunggul Karet']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Abu']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Ranting']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Batang Kayu']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Kulit Buah']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Husk Skin']['harga_per_kg'] ?? 0,
                $hargaNormalByKategori['Mucilage']['harga_per_kg'] ?? 0,
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
                0,
                0,
                0,
            ];
        }

        return response()->json($dataApi);
    }

    public function dataStokChartPie_N1($bulan, $tahun)
    {
        $dataApi['labels'] = [
            'Tea Waste',
            'Abu HE',
            'Limbah Serum',
            'Tunggul Karet',
            'Abu',
            'Ranting',
            'Batang Kayu',
            'Kulit Buah',
            'Husk Skin',
            'Mucilage',
        ];

        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStock = collect($this->storedProcedure->getDashboardDataRegion_N1($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStock = collect($this->storedProcedure->getDashboardDataUnit_N1($bulan, $tahun, $kode_unit));
        } else {
            $dataStock = collect($this->storedProcedure->getDashboardData_N1($bulan, $tahun));
        }

        $dataStock->sisaAllTeaWaste = $dataStock->sum('sisa_tea_waste');
        $dataStock->sisaAllAbuHe = $dataStock->sum('sisa_abu_he');
        $dataStock->sisaAllLimbahSerum = $dataStock->sum('sisa_limbah_Serum');
        $dataStock->sisaAllTunggulKaret = $dataStock->sum('sisa_tunggul_karet');
        $dataStock->sisaAllAbu = $dataStock->sum('sisa_abu');
        $dataStock->sisaAllRanting = $dataStock->sum('sisa_ranting');
        $dataStock->sisaAllBatangKayu = $dataStock->sum('sisa_batang_kayu');
        $dataStock->sisaAllKulitBuah = $dataStock->sum('sisa_kulit_buah');
        $dataStock->sisaAllHuskSkin = $dataStock->sum('sisa_husk_skin');
        $dataStock->sisaAllMucilage = $dataStock->sum('sisa_mucilage');


        $dataApi['dataStokChart'] = [
            $dataStock->sisaAllTeaWaste,
            $dataStock->sisaAllAbuHe,
            $dataStock->sisaAllLimbahSerum,
            $dataStock->sisaAllTunggulKaret,
            $dataStock->sisaAllAbu,
            $dataStock->sisaAllRanting,
            $dataStock->sisaAllBatangKayu,
            $dataStock->sisaAllKulitBuah,
            $dataStock->sisaAllHuskSkin,
            $dataStock->sisaAllMucilage,
            ];

        return response()->json($dataApi);
    }

    public function dataRegionStokChart_N1($bulan, $tahun)
    {
        $labels = [
            'Tea Waste',
            'Abu He',
            'Limbah Serum',
            'Tunggul Karet',
            'Abu',
            'Ranting',
            'Batang Kayu',
            'Kulit Buah',
            'Husk Skin',
            'Mucilage',
        ];

        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStock = collect($this->storedProcedure->getDashboardDataRegion_N1($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStock = collect($this->storedProcedure->getDashboardDataUnit_N1($bulan, $tahun, $kode_unit));
        } else {
            $dataStock = collect($this->storedProcedure->getDashboardData_N1($bulan, $tahun));

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
            $dataRegionStockChart[0]['data'][] = $data->sisa_tea_waste / 1000;
            $dataRegionStockChart[1]['data'][] = $data->sisa_abu_he / 1000;
            $dataRegionStockChart[2]['data'][] = $data->sisa_limbah_serum / 1000;
            $dataRegionStockChart[3]['data'][] = $data->sisa_tunggul_karet / 1000;
            $dataRegionStockChart[4]['data'][] = $data->sisa_abu / 1000;
            $dataRegionStockChart[5]['data'][] = $data->sisa_ranting / 1000;
            $dataRegionStockChart[6]['data'][] = $data->sisa_batang_kayu / 1000;
            $dataRegionStockChart[7]['data'][] = $data->sisa_kulit_buah / 1000;
            $dataRegionStockChart[8]['data'][] = $data->sisa_husk_skin / 1000;
            $dataRegionStockChart[9]['data'][] = $data->sisa_mucilage / 1000;
        }

        $dataApi['labels'] = $listRegion;
        $dataApi['dataRegionStockChart'] = $dataRegionStockChart;

        return response()->json($dataApi);
    }

    public function dataProduksiDigunakanChart_N1($bulan, $tahun)
    {
        $labels = [
            'Tea Waste',
            'Abu He',
            'Limbah Serum',
            'Tunggul Karet',
            'Abu',
            'Ranting',
            'Batang Kayu',
            'Kulit Buah',
            'Husk Skin',
            'Mucilage',
        ];
        $dataApi['labels'] = $labels;

        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStock = collect($this->storedProcedure->getDashboardDataRegion_N1($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStock = collect($this->storedProcedure->getDashboardDataUnit_N1($bulan, $tahun, $kode_unit));
        } else {
            $dataStock = collect($this->storedProcedure->getDashboardData_N1($bulan, $tahun));
        }

        $dataApi['digunakan'][0] = $dataStock->sum('tea_waste_digunakan');
        $dataApi['digunakan'][1] = $dataStock->sum('abu_he_digunakan');
        $dataApi['digunakan'][2] = $dataStock->sum('limbah_serum_digunakan');
        $dataApi['digunakan'][3] = $dataStock->sum('tunggul_karet_digunakan');
        $dataApi['digunakan'][4] = $dataStock->sum('abu_digunakan');
        $dataApi['digunakan'][5] = $dataStock->sum('ranting_digunakan');
        $dataApi['digunakan'][6] = $dataStock->sum('batang_kayu_digunakan');
        $dataApi['digunakan'][7] = $dataStock->sum('kulit_buah_digunakan');
        $dataApi['digunakan'][8] = $dataStock->sum('husk_skin_digunakan');
        $dataApi['digunakan'][9] = $dataStock->sum('mucilage_digunakan');

        $dataApi['diproduksi'][0] = $dataStock->sum('produksi_tea_waste') + $dataStock->sum('stok_tea_waste_awal_tahun');
        $dataApi['diproduksi'][1] = $dataStock->sum('produksi_abu_he') + $dataStock->sum('stok_abu_he_awal_tahun');
        $dataApi['diproduksi'][2] = $dataStock->sum('produksi_limbah_serum') + $dataStock->sum('stok_limbah_serum_awal_tahun');
        $dataApi['diproduksi'][3] = $dataStock->sum('produksi_tunggul_karet') + $dataStock->sum('stok_tunggul_karet_awal_tahun');
        $dataApi['diproduksi'][4] = $dataStock->sum('produksi_abu') + $dataStock->sum('stok_abu_awal_tahun');
        $dataApi['diproduksi'][5] = $dataStock->sum('produksi_ranting') + $dataStock->sum('stok_ranting_awal_tahun');
        $dataApi['diproduksi'][6] = $dataStock->sum('produksi_batang_kayu') + $dataStock->sum('stok_batang_kayu_awal_tahun');
        $dataApi['diproduksi'][7] = $dataStock->sum('produksi_kulit_buah') + $dataStock->sum('stok_kulit_buah_awal_tahun');
        $dataApi['diproduksi'][8] = $dataStock->sum('produksi_husk_skin') + $dataStock->sum('stok_husk_skin_awal_tahun');
        $dataApi['diproduksi'][9] = $dataStock->sum('produksi_mucilage') + $dataStock->sum('stok_mucilage_awal_tahun');

        $dataApi['stokSaatIni'][0] = $dataStock->sum('sisa_tea_waste');
        $dataApi['stokSaatIni'][1] = $dataStock->sum('sisa_abu_he');
        $dataApi['stokSaatIni'][2] = $dataStock->sum('sisa_limbah_serum');
        $dataApi['stokSaatIni'][3] = $dataStock->sum('sisa_tunggul_karet');
        $dataApi['stokSaatIni'][4] = $dataStock->sum('sisa_abu');
        $dataApi['stokSaatIni'][5] = $dataStock->sum('sisa_ranting');
        $dataApi['stokSaatIni'][6] = $dataStock->sum('sisa_batang_kayu');
        $dataApi['stokSaatIni'][7] = $dataStock->sum('sisa_kulit_buah');
        $dataApi['stokSaatIni'][8] = $dataStock->sum('sisa_husk_skin');
        $dataApi['stokSaatIni'][9] = $dataStock->sum('sisa_mucilage');

        $dataApi['dijual'][0] = $dataStock->sum('penjualan_tea_waste');
        $dataApi['dijual'][1] = $dataStock->sum('penjualan_abu_he');
        $dataApi['dijual'][2] = $dataStock->sum('penjualan_limbah_serum');
        $dataApi['dijual'][3] = $dataStock->sum('penjualan_tunggul_karet');
        $dataApi['dijual'][4] = $dataStock->sum('penjualan_abu');
        $dataApi['dijual'][5] = $dataStock->sum('penjualan_ranting');
        $dataApi['dijual'][6] = $dataStock->sum('penjualan_batang_kayu');
        $dataApi['dijual'][7] = $dataStock->sum('penjualan_kulit_buah');
        $dataApi['dijual'][8] = $dataStock->sum('penjualan_husk_skin');
        $dataApi['dijual'][9] = $dataStock->sum('penjualan_mucilage');

        return response()->json($dataApi);
    }

    public function dataScatter_N1($bulan, $tahun, $tipe)
    {
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStockRaw = collect($this->storedProcedure->getUnitAllDataRegion_N1($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStockRaw = collect($this->storedProcedure->getUnitAllDataUnit_N1($bulan, $tahun, $kode_unit));
        } else {
            $dataStockRaw = collect($this->storedProcedure->getUnitAllData_N1($bulan, $tahun));
        }
        $tipe == 'pome' ? $tipeStok = 'pome_oil' : $tipeStok = $tipe;

        $dataStockFiltered = $dataStockRaw->filter(function ($item) use ($tipeStok) {
            return isset($item->{'penjualan_'.$tipeStok}) && $item->{'penjualan_'.$tipeStok} > 0;
        })->values();

        $dataApi['dataSeries'] = $dataStockFiltered->map(function ($item) use ($tipe, $tipeStok) {
            return [
                'x' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'}, 
                // + $item->{$tipe.'_diterima_dari_pks_lain'},
                'y' => $item->{'penjualan_'.$tipeStok},
                'name' => $item->nama_unit,
                'customData' => [
                    'name' => $item->nama_unit,
                    'produksi' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'},
                    // + $item->{$tipe.'_diterima_dari_pks_lain'},
                    'penjualan' => $item->{'penjualan_'.$tipeStok}
                ]
            ];
        })->values();

        $dataApi['annotations'] = $dataStockFiltered->map(function ($item) use ($tipe, $tipeStok) {
            return [
                'x' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'}, 
                // + $item->{$tipe.'_diterima_dari_pks_lain'},
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

    public function dataScatterBi_N1($bulan, $tahun, $tipe)
    {
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $dataStockRaw = collect($this->storedProcedure->getUnitAllDataRegion_N1($bulan, $tahun, $kode_region));
        } else if (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $dataStockRaw = collect($this->storedProcedure->getUnitAllDataUnit_N1($bulan, $tahun, $kode_unit));
        } else {
            $dataStockRaw = collect($this->storedProcedure->getUnitAllData_N1($bulan, $tahun, true));
        }
        $tipe == 'pome' ? $tipeStok = 'pome_oil' : $tipeStok = $tipe;

        $dataStockFiltered = $dataStockRaw->filter(function ($item) use ($tipeStok) {
            return isset($item->{'penjualan_'.$tipeStok}) && $item->{'penjualan_'.$tipeStok} > 0;
        })->values();

        $dataApi['dataSeries'] = $dataStockFiltered->map(function ($item) use ($tipe, $tipeStok) {
            return [
                'x' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'}, 
                // + $item->{$tipe.'_diterima_dari_pks_lain'},
                'y' => $item->{'penjualan_'.$tipeStok},
                'name' => $item->nama_unit,
                'customData' => [
                    'name' => $item->nama_unit,
                    'produksi' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'}, 
                    // + $item->{$tipe.'_diterima_dari_pks_lain'},
                    'penjualan' => $item->{'penjualan_'.$tipeStok}
                ]
            ];
        })->values();

        $dataApi['annotations'] = $dataStockFiltered->map(function ($item) use ($tipe, $tipeStok) {
            return [
                'x' => $item->{'produksi_'.$tipeStok} + $item->{'stok_'.$tipeStok.'_awal_tahun'}, 
                // + $item->{$tipe.'_diterima_dari_pks_lain'},
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

    public function getDetailChartSd_N1($bulan, $tahun, $tipe)
    {
        // $data = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $data = collect($this->storedProcedure->getDashboardDataRegion_N1($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $data = collect($this->storedProcedure->getDashboardDataUnit_N1($bulan, $tahun, $kode_unit));
        } else {
            $data = collect($this->storedProcedure->getDashboardData_N1($bulan, $tahun));
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

    public function getDetailChartBi_N1($bulan, $tahun, $tipe)
    {
        // $data = collect($this->storedProcedure->getDashboardData($bulan, $tahun));
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $data = collect($this->storedProcedure->getDashboardDataRegionBi_N1($bulan, $tahun, $kode_region));
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $data = collect($this->storedProcedure->getDashboardDataUnitBi_N1($bulan, $tahun, $kode_unit));
        } else {
            $data = collect($this->storedProcedure->getDashboardDataBi_N1($bulan, $tahun));
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

    public function getDataItemDetail_N1($bulan, $tahun, $tipe)
    {
        try {
            if (in_array($tipe, ['tea_waste', 'abu_he', 'limbah_serum', 'tunggul_karet', 'abu', 'ranting', 'batang_kayu', 'kulit_buah', 'husk_skin', 'mucilage'])) {
                if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
                    $kode_region = substr(Auth::user()->kode_unit, 0, 1);
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormatRegion_N1($bulan, $tahun, false, $tipe, $kode_region));
                } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
                    $kode_unit = Auth::user()->kode_unit;
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormatUnit_N1($bulan, $tahun, false, $tipe, $kode_unit));
                } else {
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormat_N1($tahun, $bulan, false, $tipe));
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

    public function getDataItemDetailBi_N1($bulan, $tahun, $tipe)
    {
        try {
            if (in_array($tipe, ['tea_waste', 'abu_he', 'limbah_serum', 'tunggul_karet', 'abu', 'ranting', 'batang_kayu', 'kulit_buah', 'husk_skin', 'mucilage'])) {
                if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
                    $kode_region = substr(Auth::user()->kode_unit, 0, 1);
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormatRegion_N1($bulan, $tahun, true, $tipe, $kode_region));
                } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
                    $kode_unit = Auth::user()->kode_unit;
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormatUnit_N1($bulan, $tahun, true, $tipe, $kode_unit));
                } else {
                    $dataItem = collect($this->storedProcedure->getUnitAllDataWithFormat_N1($tahun, $bulan, true, $tipe));
                }
                // $dataItem = MasterUnitN1::query()
                //     ->withMucilage($bulan, $tahun)
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
