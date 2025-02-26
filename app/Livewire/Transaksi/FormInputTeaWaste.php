<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnitN1;
use App\Models\TransaksiEvidence;
use App\Models\TransaksiTeaWaste;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class FormInputTeawaste extends Component
{
    use WithFileUploads;
    public $periode;
    public $unit;
    public $dataTeawaste;
    public $digunakan;
    public $dikirim;
    public $volume_keperluan_lain;
    public $keterangan_keperluan_lain;
    public $dijual;
    public $harga_jual_rata_rata;
    public $diterima;
    public $id_data_teawaste;
    public $photo;
    public $isAllowed = false;
    public $id_produksi;
    public $tbs_olah;
    public $produksi_teawaste;
    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataTeawaste = MasterUnitN1::query()
            ->unitWithTeawaste($unit, $tahun, $bulan)
            ->first();
        if ($dataTeawaste) {
            if ($dataTeawaste->id_teawaste) {
                $this->digunakan = $dataTeawaste->digunakan;
                $this->dikirim = $dataTeawaste->dikirim;
                $this->volume_keperluan_lain = $dataTeawaste->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataTeawaste->keterangan_keperluan_lain;
                $this->dijual = $dataTeawaste->dijual;
                $this->harga_jual_rata_rata = number_format($dataTeawaste->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima = $dataTeawaste->diterima;
                $this->id_data_teawaste = $dataTeawaste->id_teawaste;
            } else {
                $this->cleanData();
            }
            $this->produksi_teawaste = $dataTeawaste->produksi_teawaste;
            $this->tbs_olah = $dataTeawaste->tbs_olah;
            $this->id_produksi = $dataTeawaste->id_produksi;
            $this->isAllowed = true;
        }
        $this->dataTeawaste = $dataTeawaste;
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
        return view('livewire.transaksi.form-input-tea-waste', compact('isPeriodeOpen'));
    }

    #[On('setDataTeawaste')]
    public function setData($periode, $unit)
    {
        $this->cleanData();
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataTeawaste = MasterUnitN1::query()
            ->unitWithTeawaste($unit, $tahun, $bulan)
            ->first();
        if ($dataTeawaste) {
            if ($dataTeawaste->id_teawaste) {
                $this->digunakan = $dataTeawaste->digunakan;
                $this->dibkirim = $dataTeawaste->dikirim;
                $this->volume_keperluan_lain = $dataTeawaste->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataTeawaste->keterangan_keperluan_lain;
                $this->dijual = $dataTeawaste->dijual;
                $this->harga_jual_rata_rata = number_format($dataTeawaste->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima = $dataTeawaste->diterima;
                $this->id_data_teawaste = $dataTeawaste->id_teawaste;
            } else {
                $this->cleanData();
            }
            $this->produksi_teawaste = $dataTeawaste->produksi_teawaste;
            $this->tbs_olah = $dataTeawaste->tbs_olah;
            $this->id_produksi = $dataTeawaste->id_produksi;
            $this->isAllowed = true;
        } else {
            $this->cleanData();
        }
        $this->dataTeawaste = $dataTeawaste;
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
        $this->diterima = 0;
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
            $this->diterima = str_replace('.', '', $this->diterima);
            $this->validate([
                'digunakan' => 'required|numeric',
                'dikirim' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima' => 'required|numeric',
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
                    'diterima' => $this->diterima,
                    'tanggal' => Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('Y-m-d'),
                ];
                TransaksiTeawaste::create($data);
                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $data['uuid'],
                    'nama_file' => $this->photo->store('teawaste', 'public'),
                    'kategori' => 'teawaste',
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
        $data = TransaksiTeawaste::where('uuid', $this->id_data_teawaste)->first();
        try {
            $this->digunakan = str_replace('.', '', $this->digunakan);
            $this->dikirim = str_replace('.', '', $this->dikirim);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);
            $this->diterima = str_replace('.', '', $this->diterima);
            if ($this->harga_jual_rata_rata == 0) {
                $this->harga_jual_rata_rata = 0;
            }
            $this->validate([
                'digunakan' => 'required|numeric',
                'dikirim' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima' => 'required|numeric',
                'photo' => 'nullable|image'
            ]);

            $input = [
                'digunakan' => $this->digunakan,
                'dikirim' => $this->dikirim,
                'volume_keperluan_lain' => $this->volume_keperluan_lain,
                'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                'dijual' => $this->dijual,
                'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                'diterima' => $this->diterima,
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
                        'diterima' => $this->diterima,
                    ]);
                    foreach ($changed as $key => $change) {
                        LogTransaksi::create([
                            'uuid' => Str::uuid(),
                            'id_transaksi' => $data->uuid,
                            'kategori_transaksi' => $key,
                            'jenis_transaksi' => 'teawaste',
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
                        'nama_file' => $this->photo->store('teawaste', 'public'),
                        'kategori' => 'teawaste',
                        'upload_by' => auth()->user()->nik_sap
                    ]);
                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'teawaste',
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
