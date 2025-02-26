<?php

namespace App\Livewire\Master;

use App\Models\HargaNormalWaist;
use Livewire\Attributes\On;
use Livewire\Component;

class MasterHargaNormal extends Component
{
    public function render()
    {
        $masterHarga = HargaNormalWaist::orderBy('tahun', 'desc')->get();
        return view('livewire.master.master-harga-normal', compact('masterHarga'));
    }

    #[On('refreshTable')]
    public function refreshTable()
    {
        $this->render();
    }

    #[On('editData')]
    public function editData($tahun, $kategori, $harga)
    {
        $this->dispatch(
            'editModal',
            $tahun,
            $kategori,
            $harga
        );
    }
}
