<?php

namespace App\Livewire\Transaksi\Limbahserum;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.limbahserum.view-data', compact('tahun', 'bulan'));
    }
}
