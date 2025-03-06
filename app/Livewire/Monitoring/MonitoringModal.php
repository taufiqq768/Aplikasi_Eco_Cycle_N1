<?php

namespace App\Livewire\Monitoring;

use App\Models\LogTransaksi;
use App\Models\MasterRegion;
use App\Models\MasterUnit;
use App\Models\TransaksiAbuJanjang;
use App\Models\TransaksiCangkang;
use App\Models\TransaksiEvidence;
use App\Models\TransaksiFiber;
use App\Models\TransaksiPkm;
use App\Models\TransaksiPome;
use App\Models\TransaksiSolid;
use App\Models\TransaksiTankos;
use App\Models\TransaksiProduksiN1;
use App\Models\TransaksiTeawaste;
use App\Models\TransaksiAbuhe;
use App\Models\TransaksiLimbahserum;
use App\Models\TransaksiTunggulkaret;
use App\Models\TransaksiAbu;
use App\Models\TransaksiRanting;
use App\Models\TransaksiBatangkayu;
use App\Models\TransaksiRubbertrap;
use App\Models\TransaksiKulitbuah;
use App\Models\TransaksiHuskskin;
use App\Models\TransaksiMucilage;

use Livewire\Attributes\On;
use Livewire\Component;

class MonitoringModal extends Component
{
    public $jenis;
    public $id;
    public $dataModal;
    public $evidence;
    public $logTransaksi;
    public function render()
    {
        return view('livewire.monitoring.monitoring-modal');
    }

    #[On('showModal')]
    public function setModalData($id, $jenis)
    {
        $this->id = $id;
        $this->jenis = $jenis;
        $log = LogTransaksi::where('id_transaksi', $id);
        if ($jenis == 't_produksi') {
            $this->dataModal = MasterUnit::monitoringDetail($id, $jenis)->get();
        } else if ($jenis == 't_cangkang') {
            $log = $log->where('jenis_transaksi', 'cangkang');
            $this->dataModal = TransaksiCangkang::where('t_cangkang.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_fiber') {
            $log = $log->where('jenis_transaksi', 'fiber');
            $this->dataModal = TransaksiFiber::where('t_fiber.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_tankos') {
            $log = $log->where('jenis_transaksi', 'tankos');
            $this->dataModal = TransaksiTankos::where('t_tankos.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_abu_janjang') {
            $log = $log->where('jenis_transaksi', 'abu_janjang');
            $this->dataModal = TransaksiAbuJanjang::where('t_abu_janjang.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_solid') {
            $log = $log->where('jenis_transaksi', 'solid');
            $this->dataModal = TransaksiSolid::where('t_solid.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_pome') {
            $log = $log->where('jenis_transaksi', 't_pome');
            $this->dataModal = TransaksiPome::where('t_pome.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_pkm') {
            $log = $log->where('jenis_transaksi', 't_pkm');
            $this->dataModal = TransaksiPkm::where('t_pkm.uuid', $id)->withProduksiUnit()->get();
        // PTPN1    
        } else if ($jenis == 't_produksi_n1') {
            $log = $log->where('jenis_transaksi', 't_produksi_n1');
            $this->dataModal = TransaksiProduksiN1::where('t_produksi_n1.uuid', $id)->get();
        } else if ($jenis == 't_tea_waste') {
            $log = $log->where('jenis_transaksi', 't_tea_waste');
            $this->dataModal = TransaksiTeawaste::where('t_tea_waste.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_limbah_serum') {
            $log = $log->where('jenis_transaksi', 't_limbah_serum');
            $this->dataModal = TransaksiLimbahserum::where('t_limbah_serum.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_tunggul_karet') {
            $log = $log->where('jenis_transaksi', 't_tunggul_karet');
            $this->dataModal = TransaksiTunggulkaret::where('t_tunggul_karet.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_abu') {
            $log = $log->where('jenis_transaksi', 't_abu');
            $this->dataModal = TransaksiAbu::where('t_abu.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_ranting') {
            $log = $log->where('jenis_transaksi', 't_ranting');
            $this->dataModal = TransaksiRanting::where('t_ranting.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_batang_kayu') {
            $log = $log->where('jenis_transaksi', 't_batang_kayu');
            $this->dataModal = TransaksiBatangkayu::where('t_batang_kayu.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_rubber_trap') {
            $log = $log->where('jenis_transaksi', 't_rubber_trap');
            $this->dataModal = TransaksiRubbertrap::where('t_rubber_trap.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_kulit_buah') {
            $log = $log->where('jenis_transaksi', 't_kulit_buah');
            $this->dataModal = TransaksiKulitbuah::where('t_kulit_buah.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_husk_skin') {
            $log = $log->where('jenis_transaksi', 't_husk_skin');
            $this->dataModal = TransaksiHuskskin::where('t_husk_skin.uuid', $id)->withProduksiUnit()->get();
        } else if ($jenis == 't_mucilage') {
            $log = $log->where('jenis_transaksi', 't_mucilage');
            $this->dataModal = TransaksiMucilage::where('t_mucilage.uuid', $id)->withProduksiUnit()->get();

        }

        $this->evidence = TransaksiEvidence::where('id_transaksi', $id)->get();

        $log = $log->select(
            't_log_transaksi.*',
            'm_unit.nama_unit',
            'users.nama as nama_user',
            'users.nik_sap'

        )
            ->leftJoin('m_unit', 't_log_transaksi.kode_unit', '=', 'm_unit.kode')
            ->leftJoin('users', 't_log_transaksi.transaksi_by', '=', 'users.nik_sap')
            ->orderBy('t_log_transaksi.tanggal', 'desc')
            ->get();
        $this->logTransaksi = $log;
        $this->render();
    }
}
