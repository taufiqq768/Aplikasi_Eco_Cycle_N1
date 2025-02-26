<?php

namespace App\Livewire\Transaksi\Abujanjang;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.abujanjang.view-data', compact('tahun', 'bulan'));
    }
}
