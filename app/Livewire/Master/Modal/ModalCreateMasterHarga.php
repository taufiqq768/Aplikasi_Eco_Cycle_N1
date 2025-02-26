<?php

namespace App\Livewire\Master\Modal;

use App\Enum\KategoriTransaksiEnum;
use App\Helpers\JsHelpers;
use App\Livewire\Master\MasterHargaNormal;
use App\Models\HargaNormalWaist;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalCreateMasterHarga extends Component
{
    public $tahunSelected;
    public $kategori;
    public $harga;
    public function render()
    {
        $tahunStart = 2024;
        $tahunSekarang = Carbon::now()->year;

        // Gabungkan range tahunStart ke tahunSekarang dan tahunSekarang ke 3 tahun ke depan
        $rentangTahun = array_unique(array_merge(
            range($tahunStart, $tahunSekarang),
            range($tahunSekarang, $tahunSekarang + 3)
        ));

        $kategoriTransaksi = KategoriTransaksiEnum::cases();
        return view('livewire.master.modal.modal-create-master-harga', compact('rentangTahun', 'kategoriTransaksi'));
    }

    public function save()
    {
        $this->validate([
            'tahunSelected' => 'required|numeric',
            'kategori' => 'required',
            'harga' => 'required|numeric'
        ]);

        $dataSearch = [
            'tahun' => $this->tahunSelected,
            'kategori' => $this->kategori
        ];

        $dataChange = [
            'harga_per_kg' => $this->harga
        ];
        try {
            HargaNormalWaist::updateOrCreate($dataSearch, $dataChange);
            $this->tahunSelected = null;
            $this->kategori = null;
            $this->harga = null;
            JsHelpers::closeModal($this, 'modalCreateHarga');
            $this->js('berhasil()');
            $this->dispatch('refreshTable');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    #[On('editModal')]
    public function editModal($tahun, $kategori, $harga)
    {
        $this->tahunSelected = $tahun;
        $this->kategori = $kategori;
        $this->harga = $harga;
        $this->js("setDataModal('$tahun', '$kategori', '$harga')");
        // dd($tahun, $kategori, $harga);
    }
}
