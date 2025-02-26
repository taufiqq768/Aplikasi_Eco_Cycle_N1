<?php

namespace App\Livewire\Transaksi\Fiber;

use Livewire\Component;

class ViewData extends Component
{
    public function render()
    {
        $tahun = date('Y');
        $bulan = date('m');
        return view('livewire.transaksi.fiber.view-data', compact('tahun', 'bulan'));
    }
}
