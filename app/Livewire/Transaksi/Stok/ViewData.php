<?php

namespace App\Livewire\Transaksi\Stok;

use App\Models\MasterUnit;
use App\Models\TransaksiStok;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $stok = TransaksiStok::get();
        $this->dispatch('initDataTable');
        return view('livewire.transaksi.stok.view-data', compact('stok'));
    }

    public function getData()
    {
        $stok = TransaksiStok::with('unit')->get();

        $stokCount = $stok->count();

        $json_data = [
            "recordsTotal" => intval($stokCount),
            "data" => $stok
        ];
        return response()->json($json_data);
    }

    #[On('refreshTable')]
    public function refreshTable()
    {
        $this->render();
    }
}
