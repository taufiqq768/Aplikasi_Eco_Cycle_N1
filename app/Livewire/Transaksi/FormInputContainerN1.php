<?php

namespace App\Livewire\Transaksi;

use App\Enum\KategoriTransaksiEnum;
use App\Models\MasterPeriode;
use App\Models\MasterUnitN1;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class FormInputContainerN1 extends Component
{
    public $tanggal;
    public $jenis;
    public $unit;
    public $namaUnit;
    public $bulan;
    public $tahun;
    public $dataMonitoring;
    public function render()
    {
        return view('livewire.transaksi.form-input-container-n1');
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
        if ($jenis == KategoriTransaksiEnum::PRODUKSI_N1->value) {
            $this->dispatch('setDataProduksiN1', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::TEA_WASTE->value) {
            $this->dispatch('setDataTeaWaste', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::ABU_HE->value) {
            $this->dispatch('setDataAbuHe', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::LIMBAH_SERUM->value) {
            $this->dispatch('setDataLimbahSerum', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::TUNGGUL_KARET->value) {
            $this->dispatch('setDataTunggulKaret', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::ABU->value) {
            $this->dispatch('setDataAbu', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::RANTING->value) {
            $this->dispatch('setDataRanting', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::BATANG_KAYU->value) {
            $this->dispatch('setDataBatangKayu', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::RUBBER_TRAP->value) {
            $this->dispatch('setDataRubberTrap', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::KULIT_BUAH->value) {
            $this->dispatch('setDataKulitBuah', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::HUSK_SKIN->value) {
            $this->dispatch('setDataHuskSkin', $this->tanggal, $this->unit);
        } elseif ($jenis == KategoriTransaksiEnum::MUCILAGE->value) {
            $this->dispatch('setDataMucilage', $this->tanggal, $this->unit);
        }    
        $this->namaUnit = MasterUnitN1::where('kode', $unit)->first();

        $dataMonitoring = DB::table('m_unit_n1')
            ->select(
                'm_unit_n1.kode as kode_unit',
                'm_unit_n1.nama_unit',
                't_produksi_n1.uuid as id_produksi_n1',
                't_tea_waste.uuid as id_tea_waste',
                't_abu_he.uuid as id_abu_he',                
                't_limbah_serum.uuid as id_limbah_serum',
                't_tunggul_karet.uuid as id_tunggul_karet',
                't_abu.uuid as id_abu',
                't_ranting.uuid as id_ranting',
                't_batang_kayu.uuid as id_batang_kayu',
                't_rubber_trap.uuid as id_rubber_trap',
                't_kulit_buah.uuid as id_kulit_buah',
                't_husk_skin.uuid as id_husk_skin',
                't_mucilage.uuid as id_mucilage',
            )
            ->leftJoin(
                DB::raw("(SELECT t_produksi_n1.uuid, t_produksi_n1.kode_unit FROM t_produksi_n1 WHERE YEAR(t_produksi_n1.tanggal) = {$tahun} AND MONTH(t_produksi_n1.tanggal) = {$bulan}) as t_produksi_n1"),
                'm_unit_n1.kode',
                '=',
                't_produksi_n1.kode_unit'
            )
           // ptpn1
            ->leftJoin('t_tea_waste', 't_produksi_n1.uuid', '=', 't_tea_waste.id_t_produksi')
            ->leftJoin('t_abu_he', 't_produksi_n1.uuid', '=', 't_abu_he.id_t_produksi')
            ->leftJoin('t_limbah_serum', 't_produksi_n1.uuid', '=', 't_limbah_serum.id_t_produksi')
            ->leftJoin('t_tunggul_karet', 't_produksi_n1.uuid', '=', 't_tunggul_karet.id_t_produksi')
            ->leftJoin('t_abu', 't_produksi_n1.uuid', '=', 't_abu.id_t_produksi')
            ->leftJoin('t_ranting', 't_produksi_n1.uuid', '=', 't_ranting.id_t_produksi')
            ->leftJoin('t_batang_kayu', 't_produksi_n1.uuid', '=', 't_batang_kayu.id_t_produksi')
            ->leftJoin('t_rubber_trap', 't_produksi_n1.uuid', '=', 't_rubber_trap.id_t_produksi')
            ->leftJoin('t_kulit_buah', 't_produksi_n1.uuid', '=', 't_kulit_buah.id_t_produksi')
            ->leftJoin('t_husk_skin', 't_produksi_n1.uuid', '=', 't_husk_skin.id_t_produksi')
            ->leftJoin('t_mucilage', 't_produksi_n1.uuid', '=', 't_mucilage.id_t_produksi')
            ->where('m_unit_n1.kode', $unit);
        if ($dataMonitoring) {
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
