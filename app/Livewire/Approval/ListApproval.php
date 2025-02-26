<?php

namespace App\Livewire\Approval;

use App\Models\TransaksiProduksi;
use Livewire\Attributes\On;
use Livewire\Component;

class ListApproval extends Component
{
    public function render()
    {
        $listProduksi = TransaksiProduksi::query()
            ->where('kode_unit', auth()->user()->kode_unit)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.approval.list-approval', compact('listProduksi'));
    }

    #[On('approve')]
    public function approve($id)
    {
        try {
            $transaksi = TransaksiProduksi::find($id);
            $transaksi->update([
                'status_approval' => '1',
                'approved_at' => now(),
                'approved_by' => auth()->user()->nik_sap
            ]);
            $this->js('berhasil()');
            $this->render();
        } catch (\Exception $e) {
            $this->js('gagal("'.$e->getMessage().'")');
        }
    }
}
