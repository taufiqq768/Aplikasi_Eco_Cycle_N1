<?php

namespace App\Livewire\Transaksi;

use App\Enum\KategoriTransaksiEnum;
use App\Models\MasterPeriode;
use App\Models\MasterUnit;
use App\Models\MasterUnitN1;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class FormInputContainer extends Component
{
    public $tanggal;
    public $jenis;
    public $unit;
    public $namaUnit;
    public $bulan;
    public $tahun;
    public $dataMonitoring;
    public $dataMonitoringN1;
    public function render()
    {
        return view('livewire.transaksi.form-input-container');
    }

    #[On('setData')]
    public function setData($tanggal, $jenis, $unit)
    {
        $this->tanggal = $tanggal;
        list($bulan, $tahun) = explode('/', $tanggal);
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->jenis = $jenis;
        $this->unit = $unit;
        $this->dataMonitoring = null;
        $this->dataMonitoringN1 = null;
        if ($jenis == KategoriTransaksiEnum::PRODUKSI->value) {
            $this->dispatch('setDataProduksi', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::CANGKANG->value) {
            $this->dispatch('setDataCangkang', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::FIBER->value) {
            $this->dispatch('setDataFiber', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::ABU_JANJANG->value) {
            $this->dispatch('setDataAbuJanjang', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::TANKOS->value) {
            $this->dispatch('setDataTankos', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::SOLID->value) {
            $this->dispatch('setDataSolid', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::POME_OIL->value) {
            $this->dispatch('setDataPomeOil', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::PKM->value) {
            $this->dispatch('setDataPkm', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::ABU_BOILER->value) {
            $this->dispatch('setDataAbuBoiler', $this->tanggal, $this->unit);
        } 
        $this->namaUnit = MasterUnit::where('kode', $unit)->first();

        $dataMonitoring = DB::table('m_unit')
            ->select(
                'm_unit.kode as kode_unit',
                'm_unit.nama_unit',
                't_produksi.uuid as id_produksi',
                't_abu_janjang.uuid as id_abu_janjang',
                't_abu_boiler.uuid as id_abu_boiler',
                't_cangkang.uuid as id_cangkang',
                't_fiber.uuid as id_fiber',
                't_pkm.uuid as id_pkm',
                't_pome.uuid as id_pome_oil',
                't_solid.uuid as id_solid',
                't_tankos.uuid as id_tankos',
            )
            ->leftJoin(
                DB::raw("(SELECT t_produksi.uuid, t_produksi.kode_unit FROM t_produksi WHERE YEAR(t_produksi.tanggal) = {$tahun} AND MONTH(t_produksi.tanggal) = {$bulan}) as t_produksi"),
                'm_unit.kode',
                '=',
                't_produksi.kode_unit'
            )
            ->leftJoin('t_abu_janjang', 't_produksi.uuid', '=', 't_abu_janjang.id_t_produksi')
            ->leftJoin('t_abu_boiler', 't_produksi.uuid', '=', 't_abu_boiler.id_t_produksi')
            ->leftJoin('t_cangkang', 't_produksi.uuid', '=', 't_cangkang.id_t_produksi')
            ->leftJoin('t_fiber', 't_produksi.uuid', '=', 't_fiber.id_t_produksi')
            ->leftJoin('t_pkm', 't_produksi.uuid', '=', 't_pkm.id_t_produksi')
            ->leftJoin('t_pome', 't_produksi.uuid', '=', 't_pome.id_t_produksi')
            ->leftJoin('t_solid', 't_produksi.uuid', '=', 't_solid.id_t_produksi')
            ->leftJoin('t_tankos', 't_produksi.uuid', '=', 't_tankos.id_t_produksi')
            ->where('m_unit.kode', $unit);

        // if ($jenis == KategoriTransaksiEnum::PRODUKSI_N1->value) {
        //     $this->dispatch('setDataProduksiN1', $this->tanggal, $this->unit);
        // } elseif ($jenis == KategoriTransaksiEnum::TEA_WASTE->value) {
        //     $this->dispatch('setDataTeaWaste', $this->tanggal, $this->unit);
        // } elseif ($jenis == KategoriTransaksiEnum::LIMBAH_SERUM->value) {
        //     $this->dispatch('setDataLimbahSerum', $this->tanggal, $this->unit);
        // } elseif ($jenis == KategoriTransaksiEnum::TUNGGUL_KARET->value) {
        //     $this->dispatch('setDataTunggulKaret', $this->tanggal, $this->unit);
        // } elseif ($jenis == KategoriTransaksiEnum::ABU->value) {
        //     $this->dispatch('setDataAbu', $this->tanggal, $this->unit);
        // } elseif ($jenis == KategoriTransaksiEnum::RANTING->value) {
        //     $this->dispatch('setDataRanting', $this->tanggal, $this->unit);
        // } elseif ($jenis == KategoriTransaksiEnum::KULIT_BUAH->value) {
        //     $this->dispatch('setDataKulitBuah', $this->tanggal, $this->unit);
        // } elseif ($jenis == KategoriTransaksiEnum::HUSK_SKIN->value) {
        //     $this->dispatch('setDataHuskSkin', $this->tanggal, $this->unit);
        // } elseif ($jenis == KategoriTransaksiEnum::MUCILAGE->value) {
        //     $this->dispatch('setDataMucilage', $this->tanggal, $this->unit);
        // }    
        // $this->namaUnit = MasterUnitN1::where('kode', $unit)->first();            

        // $dataMonitoringN1 = DB::table('m_unit_n1')
        //     ->select(
        //         'm_unit_n1.kode as kode_unit',
        //         'm_unit_n1.nama_unit',
        //         't_produksi_n1.uuid as id_produksi',
        //         't_tea_waste.uuid as id_teawaste',
        //         't_limbah_serum.uuid as id_limbahserum',
        //         't_tunggul_karet.uuid as id_tunggulkaret',
        //         't_abu.uuid as id_abu',
        //         't_ranting.uuid as id_ranting',
        //         't_kulit_buah.uuid as id_kulitbuah',
        //         't_husk_skin.uuid as id_huskskin',
        //         't_mucilage.uuid as id_mucilage',
        //     )
        //     ->leftJoin(
        //         DB::raw("(SELECT t_produksi_n1.uuid, t_produksi_n1.kode_unit FROM t_produksi_n1 WHERE YEAR(t_produksi_n1.tanggal) = {$tahun} AND MONTH(t_produksi_n1.tanggal) = {$bulan}) as t_produksi_n1"),
        //         'm_unit_n1.kode',
        //         '=',
        //         't_produksi_n1.kode_unit'
        //     )
        //     // ptpn1
        //     ->leftJoin('t_tea_waste', 't_produksi_n1.uuid', '=', 't_tea_waste.id_t_produksi')
        //     ->leftJoin('t_limbah_serum', 't_produksi_n1.uuid', '=', 't_limbah_serum.id_t_produksi')
        //     ->leftJoin('t_tunggul_karet', 't_produksi_n1.uuid', '=', 't_tunggul_karet.id_t_produksi')
        //     ->leftJoin('t_abu', 't_produksi_n1.uuid', '=', 't_abu.id_t_produksi')
        //     ->leftJoin('t_ranting', 't_produksi_n1.uuid', '=', 't_ranting.id_t_produksi')
        //     ->leftJoin('t_kulit_buah', 't_produksi_n1.uuid', '=', 't_kulit_buah.id_t_produksi')
        //     ->leftJoin('t_husk_skin', 't_produksi_n1.uuid', '=', 't_husk_skin.id_t_produksi')
        //     ->leftJoin('t_mucilage', 't_produksi_n1.uuid', '=', 't_mucilage.id_t_produksi')
        //     ->where('m_unit_n1.kode', $unit);


        if (is_null($dataMonitoring))
         {
            $this->dataMonitoring = $dataMonitoringN1->first();
         }
        else 
        {
            $this->dataMonitoring = $dataMonitoring->first();
         }
        
        $this->render();
    }

    #[On('refreshContainer')]
    public function refreshContainer()
    {
        $this->dataMonitoring = null;
        $this->render();
    }

    #[On('updateMonitoring')]
    public function updateMonitoring()
    {
        $this->setData($this->tanggal, $this->jenis, $this->unit);
    }
}
