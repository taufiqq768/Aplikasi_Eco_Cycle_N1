<?php

namespace App\Livewire\Transaksi\Mucilage;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.mucilage.view-data', compact('tahun', 'bulan'));
    }
}
