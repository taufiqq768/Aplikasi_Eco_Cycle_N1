<?php

namespace App\Livewire\Transaksi\Abu;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.abu.view-data', compact('tahun', 'bulan'));
    }
}
