<?php

namespace App\Livewire\Transaksi\Kulitbuah;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.kulitbuah.view-data', compact('tahun', 'bulan'));
    }
}
