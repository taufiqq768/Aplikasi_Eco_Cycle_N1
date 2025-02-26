<?php

namespace App\Livewire\Transaksi\Pome;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $bulan = date('m');
        $tahun = date('Y');
        return view('livewire.transaksi.pome.view-data', compact('bulan', 'tahun'));
    }
}
