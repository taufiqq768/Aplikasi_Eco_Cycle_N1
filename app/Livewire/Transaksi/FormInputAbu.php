<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnitN1;
use App\Models\TransaksiEvidence;
use App\Models\TransaksiAbu;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class FormInputAbu extends Component
{
    use WithFileUploads;
    public $periode;
    public $unit;
    public $dataAbu;
    public $digunakan;
    public $dikirim;
    public $volume_keperluan_lain;
    public $keterangan_keperluan_lain;
    public $dijual;
    public $harga_jual_rata_rata;
    public $id_data_abu;
    public $photo;
    public $isAllowed = false;
    public $id_produksi;
    public $tbs_olah;
    public $produksi_abu;
    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataAbu = MasterUnitN1::query()
            ->unitWithAbu($unit, $tahun, $bulan)
            ->first();
        if ($dataAbu) {
            if ($dataAbu->id_abu) {
                $this->digunakan = $dataAbu->digunakan;
                $this->dikirim = $dataAbu->dikirim;
                $this->volume_keperluan_lain = $dataAbu->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataAbu->keterangan_keperluan_lain;
                $this->dijual = $dataABu->dijual;
                $this->harga_jual_rata_rata = number_format($dataAbu->harga_jual_rata_rata, 2, ',', '.');
                $this->id_data_abu = $dataAbu->id_abu;
            } else {
                $this->cleanData();
            }
            $this->produksi_abu = $dataAbu->produksi_abu;
            $this->tbs_olah = $dataAbu->tbs_olah;
            $this->id_produksi = $dataAbu->id_produksi;
            $this->isAllowed = true;
        }
        $this->dataAbu = $dataAbu;
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
        return view('livewire.transaksi.form-input-abu', compact('isPeriodeOpen'));
    }

    #[On('setDataAbu')]
    public function setData($periode, $unit)
    {
        $this->cleanData();
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataAbu = MasterUnitN1::query()
            ->unitWithAbu($unit, $tahun, $bulan)
            ->first();
        if ($dataAbu) {
            if ($dataAbu->id_abu) {
                $this->digunakan = $dataAbu->digunakan;
                $this->dikirim = $dataAbu->dikirim;
                $this->volume_keperluan_lain = $dataAbu->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataAbu->keterangan_keperluan_lain;
                $this->dijual = $dataAbu->dijual;
                $this->harga_jual_rata_rata = number_format($dataAbu->harga_jual_rata_rata, 2, ',', '.');
                $this->id_data_abu = $dataAbu->id_abu;
            } else {
                $this->cleanData();
            }
            $this->produksi_abu = $dataAbu->produksi_abu;
            $this->tbs_olah = $dataAbu->tbs_olah;
            $this->id_produksi = $dataAbu->id_produksi;
            $this->isAllowed = true;
        } else {
            $this->cleanData();
        }
        $this->dataAbu = $dataAbu;
        $this->render();
    }

    public function cleanData()
    {
        $this->digunakan = 0;
        $this->dikirim = 0;
        $this->volume_keperluan_lain = 0;
        $this->keterangan_keperluan_lain = '';
        $this->dijual = 0;
        $this->harga_jual_rata_rata = 0;
        $this->photo = null;
        $this->isAllowed = false;
    }

    #[On('confirm')]
    public function submit()
    {
        try {
            $this->digunakan = str_replace('.', '', $this->digunakan);
            $this->dikirim = str_replace('.', '', $this->dikirim);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);

            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            $this->validate([
                'digunakan' => 'required|numeric',
                'dikirim' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'photo' => 'required|image'
            ]);

            DB::transaction(function () {
                list($bulan, $tahun) = explode('/', $this->periode);
                $data = [
                    'uuid' => Str::uuid(),
                    'id_t_produksi' => $this->id_produksi,
                    'digunakan' => $this->digunakan,
                    'dikirim' => $this->dikirim,
                    'volume_keperluan_lain' => $this->volume_keperluan_lain,
                    'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                    'dijual' => $this->dijual,
                    'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                    'tanggal' => Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('Y-m-d'),
                ];
                TransaksiAbu::create($data);
                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $data['uuid'],
                    'nama_file' => $this->photo->store('abu', 'public'),
                    'kategori' => 'abu',
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
        $data = TransaksiAbu::where('uuid', $this->id_data_abu)->first();
        try {
            $this->digunakan = str_replace('.', '', $this->digunakan);
            $this->dikirim = str_replace('.', '', $this->dikirim);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);
            if ($this->harga_jual_rata_rata == 0) {
                $this->harga_jual_rata_rata = 0;
            }
            $this->validate([
                'digunakan' => 'required|numeric',
                'dikirim' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'photo' => 'nullable|image'
            ]);

            $input = [
                'digunakan' => $this->digunakan,
                'dikirim' => $this->dikirim,
                'volume_keperluan_lain' => $this->volume_keperluan_lain,
                'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                'dijual' => $this->dijual,
                'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
            ];

            $dbData = $data->only(array_keys($input));
            $changed = array_diff_assoc($input, $dbData);

            DB::transaction(function () use ($data, $changed, $dbData, $keterangan, $input) {
                if (!empty($changed)) {
                    $data->update([
                        'digunakan' => $this->digunakan,
                        'dikirim' => $this->dikirim,
                        'volume_keperluan_lain' => $this->volume_keperluan_lain,
                        'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                        'dijual' => $this->dijual,
                        'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                    ]);
                    foreach ($changed as $key => $change) {
                        LogTransaksi::create([
                            'uuid' => Str::uuid(),
                            'id_transaksi' => $data->uuid,
                            'kategori_transaksi' => $key,
                            'jenis_transaksi' => 'abu',
                            'tipe_transaksi' => 'update',
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
                        'nama_file' => $this->photo->store('abu', 'public'),
                        'kategori' => 'abu',
                        'upload_by' => auth()->user()->nik_sap
                    ]);
                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'abu',
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
