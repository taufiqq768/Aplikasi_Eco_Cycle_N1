<?php

namespace App\Livewire\Transaksi\Abuboiler;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.abuboiler.view-data', compact('tahun', 'bulan'));
    }
}
