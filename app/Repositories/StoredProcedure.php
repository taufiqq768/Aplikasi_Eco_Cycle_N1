<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StoredProcedure
{
    public function getDashboardData($bulan, $tahun)
    {
        return DB::select('CALL SP_GET_ALL_DASHBOARD(?, ?)', [$tahun, $bulan]);
    }

    public function getDashboardDataBi($bulan, $tahun)
    {
        return DB::select('CALL SP_GET_ALL_DASHBOARD_BI(?, ?)', [$tahun, $bulan]);
    }

    public function getUnitAllData($bulan, $tahun, $isBi = NULL)
    {
        return DB::select('CALL SP_GET_ALL_UNIT_DATA(?, ?, ?)', [$tahun, $bulan, $isBi]);
    }

    public function getUnitAllDataRegion($bulan, $tahun, $region)
    {
        return DB::select('CALL SP_GET_ALL_UNIT_DATA_REGION(?, ?, ?)', [$tahun, $bulan, $region]);
    }

    public function getUnitAllDataUnit($bulan, $tahun, $unit)
    {
        return DB::select('CALL SP_GET_ALL_UNIT_DATA_UNIT(?, ?, ?)', [$tahun, $bulan, $unit]);
    }

    public function getUnitAllDataWithFormat($tahun, $bulan, $isBi, $tipe)
    {
        $data = DB::select('CALL SP_GET_ALL_UNIT_DATA_W_FORMAT(?, ?, ?, ?)', [$tahun, $bulan, $isBi, $tipe]);
        return $data;
    }

    public function getUnitAllDataWithFormatRegion($tahun, $bulan, $isBi, $tipe, $region)
    {
        return DB::select('CALL SP_GET_ALL_UNIT_DATA_W_FORMAT_REGION(?, ?, ?, ?, ?)', [$tahun, $bulan, $isBi, $tipe, $region]);
    }

    public function getUnitAllDataWithFormatUnit($tahun, $bulan, $isBi, $tipe, $unit)
    {
        return DB::select('CALL SP_GET_ALL_UNIT_DATA_W_FORMAT_UNIT(?, ?, ?, ?, ?)', [$tahun, $bulan, $isBi, $tipe, $unit]);
    }

    public function getDashboardDataRegion($bulan, $tahun, $region)
    {
        return DB::select('CALL SP_GET_REGION_DASHBOARD(?, ?, ?)', [$tahun, $bulan, $region]);
    }

    public function getDashboardDataRegionBi($bulan, $tahun, $region)
    {
        return DB::select('CALL SP_GET_REGION_DASHBOARD_BI(?, ?, ?)', [$tahun, $bulan, $region]);
    }

    public function getDashboardDataUnit($bulan, $tahun, $unit)
    {
        return DB::select('CALL SP_GET_UNIT_DASHBOARD(?, ?, ?)', [$tahun, $bulan, $unit]);
    }

    public function getDashboardDataUnitBi($bulan, $tahun, $unit)
    {
        return DB::select('CALL SP_GET_UNIT_DASHBOARD_BI(?, ?, ?)', [$tahun, $bulan, $unit]);
    }
}