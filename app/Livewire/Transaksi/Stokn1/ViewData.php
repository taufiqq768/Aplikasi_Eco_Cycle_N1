<?php

namespace App\Livewire\Transaksi\Stokn1;

use App\Models\MasterUnitN1;
use App\Models\TransaksiStokN1;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $stok = TransaksiStokN1::get();
        $this->dispatch('initDataTable');
        return view('livewire.transaksi.stokn1.view-data', compact('stok'));
    }

    public function getData()
    {
        $stok = TransaksiStokN1::with('unit')->get();

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
