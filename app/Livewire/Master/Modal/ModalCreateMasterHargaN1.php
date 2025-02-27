<?php

namespace App\Livewire\Master\Modal;

use App\Enum\KategoriTransaksiEnum;
use App\Helpers\JsHelpers;
use App\Livewire\Master\MasterHargaNormalN1;
use App\Models\HargaNormalWaistN1;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalCreateMasterHargaN1 extends Component
{
    public $tahunSelected;
    public $bulanSelected;
    public $kategori;
    public $harga;
    public function render()
    {
        $tahunStart = 2024;
        $tahunSekarang = Carbon::now()->year;
        $bulanStart = 1;
        $bulanAkhir = 12;


        // Gabungkan range tahunStart ke tahunSekarang dan tahunSekarang ke 3 tahun ke depan
        $rentangTahun = array_unique(array_merge(
            range($tahunStart, $tahunSekarang),
            range($tahunSekarang, $tahunSekarang + 3)
        ));

        $rentangBulan = array_unique(
            range($bulanStart, $bulanAkhir)
        );

        $kategoriTransaksi = array_filter(KategoriTransaksiEnum::cases(), function($kategori) {
            return strpos($kategori->value, 'N1') === 0; // Filter categories that start with 'N1'
        });
        return view('livewire.master.modal.modal-create-master-harga-n1', compact('rentangTahun', 'rentangBulan', 'kategoriTransaksi'));
    }

    public function save()
    {
        $this->validate([
            'tahunSelected' => 'required|numeric',
            'bulanSelected' => 'required|numeric',
            'kategori' => 'required',
            'harga' => 'required|numeric'
        ]);

        $dataSearch = [
            'tahun' => $this->tahunSelected,
            'bulan' => $this->tahunSelected,
            'kategori' => $this->kategori
        ];

        $dataChange = [
            'harga_per_kg' => $this->harga
        ];
        try {
            HargaNormalWaistN1::updateOrCreate($dataSearch, $dataChange);
            $this->tahunSelected = null;
            $this->bulanSelected = null;
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
    public function editModal($tahun, $bulan, $kategori, $harga)
    {
        $this->tahunSelected = $tahun;
        $this->bulanSelected = $tahun;
        $this->kategori = $kategori;
        $this->harga = $harga;
        $this->js("setDataModal('$tahun', '$bulan', '$kategori', '$harga')");
        // dd($tahun, $kategori, $harga);
    }
}
