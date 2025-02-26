<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnit;
use App\Models\TransaksiEvidence;
use App\Models\TransaksiPkm;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Storage;
use Str;

class FormInputPkm extends Component
{
    use \Livewire\WithFileUploads;
    public $periode;
    public $unit;
    public $dataPkm;
    public $inti_diolah;
    public $dijual;
    public $harga_jual_rata_rata;
    public $volume_keperluan_lain;
    public $keterangan_keperluan_lain;
    public $diterima_dari_pks_lain;
    public $id_data_pkm;
    public $photo;
    public $isAllowed = false;
    public $id_produksi;
    public $tbs_olah;
    public $produksi_pkm;
    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataPkm = MasterUnit::query()
            ->unitWithPkm($unit, $tahun, $bulan)
            ->first();
        if ($dataPkm) {
            if ($dataPkm->id_pkm) {
                $this->inti_diolah = $dataPkm->inti_diolah;
                $this->volume_keperluan_lain = $dataPkm->volume_keperluan_lain;
                $this->diterima_dari_pks_lain = $dataPkm->diterima_dari_pks_lain;
                $this->keterangan_keperluan_lain = $dataPkm->keterangan_keperluan_lain;
                $this->dijual = $dataPkm->dijual;
                $this->harga_jual_rata_rata = number_format($dataPkm->harga_jual_rata_rata, 2, ',', '.');
                $this->id_data_pkm = $dataPkm->id_pkm;
            } else {
                $this->cleanData();
            }
            $this->produksi_pkm = $dataPkm->produksi_pkm;
            $this->tbs_olah = $dataPkm->tbs_olah;
            $this->id_produksi = $dataPkm->id_produksi;
            $this->isAllowed = true;
        }
        $this->dataPkm = $dataPkm;
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
        return view('livewire.transaksi.form-input-pkm', compact('isPeriodeOpen'));
    }
    #[On('setDataPkm')]
    public function setData($periode, $unit)
    {
        $this->cleanData();
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataPkm = MasterUnit::query()
            ->unitWithPkm($unit, $tahun, $bulan)
            ->first();
        if ($dataPkm) {
            if ($dataPkm->id_pkm) {
                $this->inti_diolah = $dataPkm->inti_diolah;
                $this->volume_keperluan_lain = $dataPkm->volume_keperluan_lain;
                $this->diterima_dari_pks_lain = $dataPkm->diterima_dari_pks_lain;
                $this->keterangan_keperluan_lain = $dataPkm->keterangan_keperluan_lain;
                $this->dijual = $dataPkm->dijual;
                $this->harga_jual_rata_rata = number_format($dataPkm->harga_jual_rata_rata, 2, ',', '.');
                $this->id_data_pkm = $dataPkm->id_pkm;
            } else {
                $this->cleanData();
            }
            $this->produksi_pkm = $dataPkm->produksi_pkm;
            $this->tbs_olah = $dataPkm->tbs_olah;
            $this->id_produksi = $dataPkm->id_produksi;
            $this->isAllowed = true;
        } else {
            $this->cleanData();
        }
        $this->dataPkm = $dataPkm;
        $this->render();
    }

    public function cleanData()
    {
        $this->inti_diolah = 0;
        $this->volume_keperluan_lain = 0;
        $this->keterangan_keperluan_lain = '';
        $this->diterima_dari_pks_lain = 0;
        $this->dijual = 0;
        $this->harga_jual_rata_rata = 0;
        $this->photo = null;
        $this->isAllowed = false;
    }

    #[On('confirm')]
    public function submit()
    {
        try {
            $this->inti_diolah = str_replace('.', '', $this->inti_diolah);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);

            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            $this->validate([
                'inti_diolah' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'keterangan_keperluan_lain' => 'nullable',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'photo' => 'required|image',
            ]);

            DB::transaction(function () {
                list($bulan, $tahun) = explode('/', $this->periode);
                $data = [
                    'uuid' => Str::uuid(),
                    'id_t_produksi' => $this->id_produksi,
                    'inti_diolah' => $this->inti_diolah,
                    'volume_keperluan_lain' => $this->volume_keperluan_lain,
                    'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                    'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                    'dijual' => $this->dijual,
                    'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                    'tanggal' => Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('Y-m-d'),
                ];
                TransaksiPkm::create($data);
                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $data['uuid'],
                    'nama_file' => $this->photo->store('pkm', 'public'),
                    'kategori' => 'pkm',
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
        $data = TransaksiPkm::where('uuid', $this->id_data_pkm)->first();
        try {
            $this->inti_diolah = str_replace('.', '', $this->inti_diolah);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);

            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            if ($this->harga_jual_rata_rata == 0) {
                $this->harga_jual_rata_rata = 0;
            }
            $this->validate([
                'inti_diolah' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'keterangan_keperluan_lain' => 'nullable',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'photo' => 'nullable|image',
            ]);

            $input = [
                'inti_diolah' => $this->inti_diolah,
                'volume_keperluan_lain' => $this->volume_keperluan_lain,
                'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                'dijual' => $this->dijual,
                'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
            ];
            $dbData = $data->only(array_keys($input));
            $changed = array_diff_assoc($input, $dbData);

            DB::transaction(function () use ($data, $dbData, $changed, $keterangan, $input) {
                if (!empty($changed)) {
                    $data->update([
                        'inti_diolah' => $this->inti_diolah,
                        'volume_keperluan_lain' => $this->volume_keperluan_lain,
                        'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                        'dijual' => $this->dijual,
                        'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                        'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                    ]);
                    foreach ($changed as $key => $change) {
                        LogTransaksi::create([
                            'uuid' => Str::uuid(),
                            'id_transaksi' => $data->uuid,
                            'kategori_transaksi' => $key,
                            'jenis_transaksi' => 'pkm',
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
                        'nama_file' => $this->photo->store('pkm', 'public'),
                        'kategori' => 'pkm',
                        'upload_by' => auth()->user()->nik_sap
                    ]);
                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'pkm',
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
