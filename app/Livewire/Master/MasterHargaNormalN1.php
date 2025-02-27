<?php

namespace App\Livewire\Master;

use App\Models\HargaNormalWaistN1;
use Livewire\Attributes\On;
use Livewire\Component;

class MasterHargaNormalN1 extends Component
{
    public function render()
    {
        $masterHarga = HargaNormalWaistN1::orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();
        return view('livewire.master.master-harga-normal-n1', compact('masterHarga'));
    }

    #[On('refreshTable')]
    public function refreshTable()
    {
        $this->render();
    }

    #[On('editData')]
    public function editData($tahun, $bulan, $kategori, $harga)
    {
        $this->dispatch(
            'editModal',
            $tahun,
            $bulan,
            $kategori,
            $harga
        );
    }
}
