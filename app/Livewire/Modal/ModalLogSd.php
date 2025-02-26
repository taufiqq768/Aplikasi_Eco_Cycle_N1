<?php

namespace App\Livewire\Modal;

use App\Models\LogTransaksi;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalLogSd extends Component
{
    public $data;
    public $log;
    public function render()
    {
        return view('livewire.modal.modal-log-sd');
    }

    #[On('openModal')]
    public function setData($kode, $bulan, $tahun)
    {
        $log = LogTransaksi::where('t_log_transaksi.kode_unit', $kode)
            ->select(
                't_log_transaksi.*',
                'm_unit.nama_unit',
                'users.nama as nama_user',
                'users.nik_sap'

            )
            ->leftJoin('m_unit', 't_log_transaksi.kode_unit', '=', 'm_unit.kode')
            ->leftJoin('users', 't_log_transaksi.transaksi_by', '=', 'users.nik_sap')
            ->whereMonth('tanggal', '<=', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'desc')
            ->get();
        $this->log = $log;
    }
}
