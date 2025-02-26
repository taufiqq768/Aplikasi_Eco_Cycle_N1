<?php

namespace App\Livewire\Transaksi\Tankos;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.tankos.view-data', compact('tahun', 'bulan'));
    }
}
