<?php

namespace App\Livewire\Transaksi\Batangkayu;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.batangkayu.view-data', compact('tahun', 'bulan'));
    }
}
