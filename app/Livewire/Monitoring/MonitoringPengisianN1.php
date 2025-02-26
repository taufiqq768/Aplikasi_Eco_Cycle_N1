<?php

namespace App\Livewire\Monitoring;

use App\Models\MasterRegion;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class MonitoringPengisianN1 extends Component
{
    public $bulan;
    public $tahun;
    public function mount()
    {
        $this->bulan = date('m');
        $this->tahun = date('Y');
    }
    public function render()
    {
        if (Auth::user()->role == 'ADMIN_REGIONAL' || Auth::user()->role == 'VIEWER_REGIONAL') {
            $kode_region = substr(Auth::user()->kode_unit, 0, 1);
            $data = MasterRegion::withMonitoringN1($this->bulan, $this->tahun)
                ->where('kode_region', $kode_region)
                ->orderBy('urutan')
                ->orderBy('kode_unit')
                ->get();
        } elseif (Auth::user()->role == 'ADMIN_UNIT' || Auth::user()->role == 'VIEWER_UNIT' || Auth::user()->role == 'APPROVER_UNIT') {
            $kode_unit = Auth::user()->kode_unit;
            $data = MasterRegion::withMonitoringN1($this->bulan, $this->tahun)
                ->where('kode_unit', $kode_unit)
                ->orderBy('urutan')
                ->orderBy('kode_unit')
                ->get();
        } else {
            $data = MasterRegion::withMonitoringN1($this->bulan, $this->tahun)
                ->orderBy('urutan')
                ->orderBy('kode_unit')
                ->get();
        }

        return view('livewire.monitoring.monitoring-pengisian-n1', compact('data'));
    }

    #[On('setData')]
    public function setData($bulan, $tahun)
    {
        // $this->data = MasterRegion::withMonitoring($this->bulan, $this->tahun)->get();
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->render();
    }
}
