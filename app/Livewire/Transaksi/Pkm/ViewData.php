<?php

namespace App\Livewire\Transaksi\Pkm;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $bulan = date('m');
        $tahun = date('Y');
        return view('livewire.transaksi.pkm.view-data', compact('bulan', 'tahun'));
    }
}
