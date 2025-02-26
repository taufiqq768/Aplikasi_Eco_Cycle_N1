<?php

namespace App\Livewire\Master;

use App\Models\MasterPeriode;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ManajemenPeriode extends Component
{
    public $tanggal_buka;
    public $tanggal_tutup;
    public function render()
    {
        $data = MasterPeriode::first();
        $this->tanggal_buka = $data->tanggal_buka;
        $this->tanggal_tutup = $data->tanggal_tutup;
        return view('livewire.master.manajemen-periode', compact('data'));
    }

    public function changeTanggal()
    {
        try {
            $this->validate([
                // 'tanggal_buka' => 'required|numeric',
                'tanggal_tutup' => 'required|numeric'
            ]);

            DB::transaction(function () {
                $data = MasterPeriode::first();
                $data->update([
                    'tanggal_buka' => $this->tanggal_buka,
                    'tanggal_tutup' => $this->tanggal_tutup
                ]);
            });
            $this->js('berhasil()');
        } catch (ValidationException $e) {
            $this->js("gagal('{$e->getMessage()}')");
        }
        $this->render();
    }
}
