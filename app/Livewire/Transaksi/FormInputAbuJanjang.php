<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnit;
use App\Models\TransaksiAbuJanjang;
use App\Models\TransaksiEvidence;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class FormInputAbuJanjang extends Component
{
    use WithFileUploads;
    public $periode;
    public $unit;
    public $dataAbuJanjang;
    public $digunakan_sbg_pupuk_organik;
    public $volume_keperluan_lain;
    public $keterangan_keperluan_lain;
    public $keterangan_do_pending;
    public $dijual;
    public $harga_jual_rata_rata;
    public $diterima_dari_pks_lain;
    public $id_data_abu_janjang;
    public $photo;
    public $isAllowed = false;
    public $id_produksi;
    public $tbs_olah;
    public $produksi_abu_janjang;
    public $tankos_dibakar;

    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataAbuJanjang = MasterUnit::query()
            ->unitWithAbuJanjang($unit, $tahun, $bulan)
            ->first();
        if ($dataAbuJanjang) {
            if ($dataAbuJanjang->id_abu_janjang) {
                $this->digunakan_sbg_pupuk_organik = $dataAbuJanjang->digunakan_sbg_pupuk_organik;
                $this->volume_keperluan_lain = $dataAbuJanjang->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataAbuJanjang->keterangan_keperluan_lain;
                $this->keterangan_do_pending = $dataAbuJanjang->keterangan_do_pending;
                $this->dijual = $dataAbuJanjang->dijual;
                $this->harga_jual_rata_rata = number_format($dataAbuJanjang->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima_dari_pks_lain = $dataAbuJanjang->diterima_dari_pks_lain;
                $this->tankos_dibakar = $dataAbuJanjang->tankos_dibakar;
                $this->id_data_abu_janjang = $dataAbuJanjang->id_abu_janjang;
            } else {
                $this->cleanData();
            }
            $this->produksi_abu_janjang = $dataAbuJanjang->produksi_abu_janjang;
            $this->tbs_olah = $dataAbuJanjang->tbs_olah;
            $this->id_produksi = $dataAbuJanjang->id_produksi;
            $this->isAllowed = true;
        }
        $this->dataAbuJanjang = $dataAbuJanjang;
    }
    public function render()
    {
        list($bulan, $tahun) = explode('/', $this->periode);
        $periode = MasterPeriode::first();
        $isPeriodeOpen = false;
        $currentYear = (date('m') == 1) ? date('Y') - 1 : date('Y');
        if ((int) date('d') < $periode->tanggal_tutup) {
            $isPeriodeOpen = true;
        }
        return view('livewire.transaksi.form-input-abu-janjang', compact('isPeriodeOpen'));
    }

    #[On('setDataAbuJanjang')]
    public function setData($periode, $unit)
    {
        $this->cleanData();
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataAbuJanjang = MasterUnit::query()
            ->unitWithAbuJanjang($unit, $tahun, $bulan)
            ->first();
        if ($dataAbuJanjang) {
            if ($dataAbuJanjang->id_abu_janjang) {
                $this->digunakan_sbg_pupuk_organik = $dataAbuJanjang->digunakan_sbg_pupuk_organik;
                $this->volume_keperluan_lain = $dataAbuJanjang->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataAbuJanjang->keterangan_keperluan_lain;
                $this->keterangan_do_pending = $dataAbuJanjang->keterangan_do_pending;
                $this->dijual = $dataAbuJanjang->dijual;
                $this->harga_jual_rata_rata = number_format($dataAbuJanjang->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima_dari_pks_lain = $dataAbuJanjang->diterima_dari_pks_lain;
                $this->tankos_dibakar = $dataAbuJanjang->tankos_dibakar;
                $this->id_data_abu_janjang = $dataAbuJanjang->id_abu_janjang;
            } else {
                $this->cleanData();
            }
            $this->produksi_abu_janjang = $dataAbuJanjang->produksi_abu_janjang;
            $this->tbs_olah = $dataAbuJanjang->tbs_olah;
            $this->id_produksi = $dataAbuJanjang->id_produksi;
            $this->isAllowed = true;
        } else {
            $this->cleanData();
        }
        $this->dataAbuJanjang = $dataAbuJanjang;
        $this->render();
    }

    public function cleanData()
    {
        $this->digunakan_sbg_pupuk_organik = 0;
        $this->volume_keperluan_lain = 0;
        $this->keterangan_keperluan_lain = '';
        $this->keterangan_do_pending = '';
        $this->dijual = 0;
        $this->harga_jual_rata_rata = 0;
        $this->diterima_dari_pks_lain = 0;
        $this->tankos_dibakar = 0;
        $this->photo = null;
        $this->isAllowed = false;
    }

    #[On('confirm')]
    public function submit()
    {
        try {
            $this->digunakan_sbg_pupuk_organik = str_replace('.', '', $this->digunakan_sbg_pupuk_organik);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);
            $this->tankos_dibakar = str_replace(['.', ','], ['', '.'], $this->tankos_dibakar);
            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            $this->validate([
                'digunakan_sbg_pupuk_organik' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'keterangan_keperluan_lain' => 'nullable',
                'keterangan_do_pending' => 'nullable',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'tankos_dibakar' => 'required|numeric',
                'photo' => 'required|image',
            ]);

            DB::transaction(function () {
                list($bulan, $tahun) = explode('/', $this->periode);
                $data = [
                    'uuid' => Str::uuid(),
                    'id_t_produksi' => $this->id_produksi,
                    'digunakan_sbg_pupuk_organik' => $this->digunakan_sbg_pupuk_organik,
                    'volume_keperluan_lain' => $this->volume_keperluan_lain,
                    'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                    'keterangan_do_pending' => $this->keterangan_do_pending,
                    'dijual' => $this->dijual,
                    'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                    'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                    'tanggal' => Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('Y-m-d'),
                ];
                TransaksiAbuJanjang::create($data);
                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $data['uuid'],
                    'nama_file' => $this->photo->store('abuJanjang', 'public'),
                    'kategori' => 'abuJanjang',
                    'upload_by' => auth()->user()->nik_sap,
                ]);
            });
            $this->dispatch('updateMonitoring');
            $this->cleanData();
            $this->setData($this->periode, $this->unit);
            $this->js('berhasil()');
            $this->render();
        } catch (ValidationException $e) {
            $this->js("gagal('{$e->getMessage()}')");
        }
    }

    #[On('saveEdit')]
    public function saveEdit($keterangan)
    {
        list($bulan, $tahun) = explode('/', $this->periode);
        $data = TransaksiAbuJanjang::where('uuid', $this->id_data_abu_janjang)->first();
        try {
            $this->digunakan_sbg_pupuk_organik = str_replace('.', '', $this->digunakan_sbg_pupuk_organik);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);
            $this->tankos_dibakar = str_replace(['.', ','], ['', '.'], $this->tankos_dibakar);
            if ($this->harga_jual_rata_rata == 0) {
                $this->harga_jual_rata_rata = 0;
            }
            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            $this->validate([
                'digunakan_sbg_pupuk_organik' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'keterangan_keperluan_lain' => 'nullable',
                'keterangan_do_pending' => 'nullable',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'tankos_dibakar' => 'required|numeric',
                'photo' => 'nullable|image',
            ]);

            $input = [
                'digunakan_sbg_pupuk_organik' => $this->digunakan_sbg_pupuk_organik,
                'volume_keperluan_lain' => $this->volume_keperluan_lain,
                'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                'keterangan_do_pending' => $this->keterangan_do_pending,
                'dijual' => $this->dijual,
                'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                'tankos_dibakar' => $this->tankos_dibakar,
            ];
            $dbData = $data->only(array_keys($input));
            $changed = array_diff_assoc($input, $dbData);

            DB::transaction(function () use ($data, $dbData, $changed, $keterangan, $input) {
                if (!empty($changed)) {
                    $data->update([
                        'digunakan_sbg_pupuk_organik' => $this->digunakan_sbg_pupuk_organik,
                        'volume_keperluan_lain' => $this->volume_keperluan_lain,
                        'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                        'keterangan_do_pending' => $this->keterangan_do_pending,
                        'dijual' => $this->dijual,
                        'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                        'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                        'tankos_dibakar' => $this->tankos_dibakar,
                    ]);
                    foreach ($changed as $key => $change) {
                        LogTransaksi::create([
                            'uuid' => Str::uuid(),
                            'id_transaksi' => $data->uuid,
                            'kategori_transaksi' => $key,
                            'jenis_transaksi' => 'abuJanjang',
                            'tipe_transaksi' => 'edit',
                            'jumlah_sebelum' => $dbData[$key],
                            'jumlah_sesudah' => $input[$key],
                            'keterangan' => $keterangan,
                            'transaksi_by' => auth()->user()->nik_sap,
                            'kode_unit' => $this->unit,
                            'tanggal' => Carbon::createFromDate($data->tanggal)->endOfMonth()->format('Y-m-d')
                        ]);
                    }
                }
                if ($this->photo) {
                    $namaFile = TransaksiEvidence::where('id_transaksi', $data->uuid)->first();
                    if ($namaFile) {
                        $namaFile->delete();
                        $filePhoto = 'public/'.$namaFile->nama_file;
                        if (Storage::exists($filePhoto)) {
                            Storage::delete($filePhoto);
                        }
                    }
                    TransaksiEvidence::create([
                        'uuid' => Str::uuid(),
                        'kode_unit' => $this->unit,
                        'id_transaksi' => $data->uuid,
                        'nama_file' => $this->photo->store('abuJanjang', 'public'),
                        'kategori' => 'abuJanjang',
                        'upload_by' => auth()->user()->nik_sap
                    ]);
                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'abuJanjang',
                        'tipe_transaksi' => 'update',
                        'jumlah_sebelum' => 0,
                        'jumlah_sesudah' => 0,
                        'keterangan' => $keterangan,
                        'transaksi_by' => auth()->user()->nik_sap,
                        'kode_unit' => $this->unit,
                        'tanggal' => Carbon::createFromDate($data->tanggal)->endOfMonth()->format('Y-m-d')
                    ]);
                }
            });

            $this->cleanData();
            $this->setData($this->periode, $this->unit);
            $this->js('berhasil()');
            $this->render();
        } catch (ValidationException $e) {
            $this->js("gagal('{$e->getMessage()}')");
        }
    }
}
