<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnitN1;
use App\Models\TransaksiEvidence;
use App\Models\TransaksiLimbahserum;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class FormInputLimbahserum extends Component
{
    use WithFileUploads;
    public $periode;
    public $unit;
    public $dataLimbahserum;
    public $digunakan;
    public $dikirim;
    public $volume_keperluan_lain;
    public $keterangan_keperluan_lain;
    public $dijual;
    public $harga_jual_rata_rata;
    public $id_data_limbahserum;
    public $photo;
    public $isAllowed = false;
    public $id_produksi;
    public $tbs_olah;
    public $produksi_limbahserum;
    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataLimbahserum = MasterUnitN1::query()
            ->unitWithLimbahserum($unit, $tahun, $bulan)
            ->first();
        if ($dataLimbahserum) {
            if ($dataLimbahserum->id_limbahserum) {
                $this->digunakan = $dataLimbahserum->digunakan;
                $this->dikirim = $dataLimbahserum->dikirim;
                $this->volume_keperluan_lain = $dataLimbahserum->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataLimbahserum->keterangan_keperluan_lain;
                $this->dijual = $dataLimbahserum->dijual;
                $this->harga_jual_rata_rata = number_format($dataLimbahserum->harga_jual_rata_rata, 2, ',', '.');
                $this->id_data_limbahserum = $dataLimbahserum->id_limbahserum;
            } else {
                $this->cleanData();
            }
            $this->produksi_limbahserum = $dataLimbahserum->produksi_limbahserum;
            $this->tbs_olah = $dataLimbahserum->tbs_olah;
            $this->id_produksi = $dataLimbahserum->id_produksi;
            $this->isAllowed = true;
        }
        $this->dataLimbahserum = $dataLimbahserum;
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
        return view('livewire.transaksi.form-input-limbah-serum', compact('isPeriodeOpen'));
    }

    #[On('setDataN1limbahserum')]
    public function setData($periode, $unit)
    {
        $this->cleanData();
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataLimbahserum = MasterUnitN1::query()
            ->unitWithLimbahserum($unit, $tahun, $bulan)
            ->first();
        if ($dataLimbahserum) {
            if ($dataLimbahserum->id_limbahserum) {
                $this->digunakan = $dataLimbahserum->digunakan;
                $this->dikirim = $dataLimbahserum->dikirim;
                $this->volume_keperluan_lain = $dataLimbahserum->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataLimbahserum->keterangan_keperluan_lain;
                $this->dijual = $dataLimbahserum->dijual;
                $this->harga_jual_rata_rata = number_format($dataLimbahserum->harga_jual_rata_rata, 2, ',', '.');
                $this->id_data_limbahserum = $dataLimbahserum->id_limbahserum;
            } else {
                $this->cleanData();
            }
            $this->produksi_limbahserum = $dataLimbahserum->produksi_limbahserum;
            $this->tbs_olah = $dataLimbahserum->tbs_olah;
            $this->id_produksi = $dataLimbahserum->id_produksi;
            $this->isAllowed = true;
        } else {
            $this->cleanData();
        }
        $this->dataLimbahserum = $dataLimbahserum;
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
                TransaksiLimbahserum::create($data);
                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $data['uuid'],
                    'nama_file' => $this->photo->store('limbahserum', 'public'),
                    'kategori' => 'limbahserum',
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
        $data = TransaksiLimbahserum::where('uuid', $this->id_data_limbahserum)->first();
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
                            'jenis_transaksi' => 'limbahserum',
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
                        'nama_file' => $this->photo->store('limbahserum', 'public'),
                        'kategori' => 'limbahserum',
                        'upload_by' => auth()->user()->nik_sap
                    ]);
                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'limbahserum',
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
