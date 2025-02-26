<?php

namespace App\Livewire\Transaksi\Huskskin;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.huskskin.view-data', compact('tahun', 'bulan'));
    }
}
