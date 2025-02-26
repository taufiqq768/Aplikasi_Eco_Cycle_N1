<?php

namespace App\Livewire\Transaksi\Solid;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.solid.view-data', compact('tahun', 'bulan'));
    }
}
