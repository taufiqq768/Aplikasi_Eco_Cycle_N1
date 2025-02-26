<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StoredProcedure_N1
{
    public function getDashboardData_N1($bulan, $tahun)
    {
        return DB::select('CALL eco_cycle.SP_GET_ALL_DASHBOARD_N1(?, ?)', [$tahun, $bulan]);
    }

    public function getDashboardDataBi_N1($bulan, $tahun)
    {
        return DB::select('CALL eco_cycle.SP_GET_ALL_DASHBOARD_BI_N1(?, ?)', [$tahun, $bulan]);
    }

    public function getUnitAllData_N1($bulan, $tahun, $isBi = NULL)
    {
        return DB::select('CALL eco_cycle.SP_GET_ALL_UNIT_DATA_N1(?, ?, ?)', [$tahun, $bulan, $isBi]);
    }

    public function getUnitAllDataRegion_N1($bulan, $tahun, $region)
    {
        return DB::select('CALL SP_GET_ALL_UNIT_DATA_REGION_N1(?, ?, ?)', [$tahun, $bulan, $region]);
    }

    public function getUnitAllDataUnit_N1($bulan, $tahun, $unit)
    {
        return DB::select('CALL SP_GET_ALL_UNIT_DATA_UNIT_N1(?, ?, ?)', [$tahun, $bulan, $unit]);
    }

    public function getUnitAllDataWithFormat_N1($tahun, $bulan, $isBi, $tipe)
    {
        $data = DB::select('CALL eco_cycle.SP_GET_ALL_UNIT_DATA_W_FORMAT_N1(?, ?, ?, ?)', [$tahun, $bulan, $isBi, $tipe]);
        return $data;
    }

    public function getUnitAllDataWithFormatRegion_N1($tahun, $bulan, $isBi, $tipe, $region)
    {
        return DB::select('CALL eco_cycle.SP_GET_ALL_UNIT_DATA_W_FORMAT_REGION_N1(?, ?, ?, ?, ?)', [$tahun, $bulan, $isBi, $tipe, $region]);
    }

    public function getUnitAllDataWithFormatUnit_N1($tahun, $bulan, $isBi, $tipe, $unit)
    {
        return DB::select('CALL eco_cycle.SP_GET_ALL_UNIT_DATA_W_FORMAT_UNIT_N1(?, ?, ?, ?, ?)', [$tahun, $bulan, $isBi, $tipe, $unit]);
    }

    public function getDashboardDataRegion_N1($bulan, $tahun, $region)
    {
        return DB::select('CALL SP_GET_REGION_DASHBOARD_N1(?, ?, ?)', [$tahun, $bulan, $region]);
    }

    public function getDashboardDataRegionBi_N1($bulan, $tahun, $region)
    {
        return DB::select('CALL SP_GET_REGION_DASHBOARD_BI_N1(?, ?, ?)', [$tahun, $bulan, $region]);
    }

    public function getDashboardDataUnit_N1($bulan, $tahun, $unit)
    {
        return DB::select('CALL SP_GET_UNIT_DASHBOARD_N1(?, ?, ?)', [$tahun, $bulan, $unit]);
    }

    public function getDashboardDataUnitBi_N1($bulan, $tahun, $unit)
    {
        return DB::select('CALL SP_GET_UNIT_DASHBOARD_BI_N1(?, ?, ?)', [$tahun, $bulan, $unit]);
    }
}