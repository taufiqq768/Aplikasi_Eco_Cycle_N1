<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnit;
use App\Models\TransaksiEvidence;
use App\Models\TransaksiFiber;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class FormInputFiber extends Component
{
    use WithFileUploads;
    public $periode;
    public $unit;
    public $dataFiber;
    public $digunakan_u_bahan_bakar;
    public $dikirim_ke_pabrik_teh;
    public $dikirim_ke_pabrik_karet;
    public $dikirim_ke_pabrik_gula;
    public $dikirim_ke_bibitan_kelapa_sawit;
    public $dikirim_ke_pks_lain;
    public $volume_keperluan_lain;
    public $keterangan_keperluan_lain;
    public $keterangan_do_pending;
    public $dijual;
    public $harga_jual_rata_rata;
    public $diterima_dari_pks_lain;
    public $id_data_fiber;
    public $photo;
    public $isAllowed = false;
    public $id_produksi;
    public $tbs_olah;
    public $produksi_fiber;
    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataFiber = MasterUnit::query()
            ->unitWithFiber($unit, $tahun, $bulan)
            ->first();
        if ($dataFiber) {
            if ($dataFiber->id_fiber) {
                $this->digunakan_u_bahan_bakar = $dataFiber->digunakan_u_bahan_bakar;
                $this->dikirim_ke_pabrik_teh = $dataFiber->dikirim_ke_pabrik_teh;
                $this->dikirim_ke_pabrik_karet = $dataFiber->dikirim_ke_pabrik_karet;
                $this->dikirim_ke_pabrik_gula = $dataFiber->dikirim_ke_pabrik_gula;
                $this->dikirim_ke_bibitan_kelapa_sawit = $dataFiber->dikirim_ke_bibitan_kelapa_sawit;
                $this->dikirim_ke_pks_lain = $dataFiber->dikirim_ke_pks_lain;
                $this->volume_keperluan_lain = $dataFiber->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataFiber->keterangan_keperluan_lain;
                $this->keterangan_do_pending = $dataFiber->keterangan_do_pending;
                $this->dijual = $dataFiber->dijual;
                $this->harga_jual_rata_rata = number_format($dataFiber->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima_dari_pks_lain = $dataFiber->diterima_dari_pks_lain;
                $this->id_data_fiber = $dataFiber->id_fiber;
            } else {
                $this->cleanData();
            }
            $this->produksi_fiber = $dataFiber->produksi_fiber;
            $this->tbs_olah = $dataFiber->tbs_olah;
            $this->id_produksi = $dataFiber->id_produksi;
            $this->isAllowed = true;
        }
        $this->dataFiber = $dataFiber;
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
        return view('livewire.transaksi.form-input-fiber', compact('isPeriodeOpen'));
    }

    #[On('setDataFiber')]
    public function setData($periode, $unit)
    {
        $this->cleanData();
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataFiber = MasterUnit::query()
            ->unitWithFiber($unit, $tahun, $bulan)
            ->first();
        if ($dataFiber) {
            if ($dataFiber->id_fiber) {
                $this->digunakan_u_bahan_bakar = $dataFiber->digunakan_u_bahan_bakar;
                $this->dikirim_ke_pabrik_teh = $dataFiber->dikirim_ke_pabrik_teh;
                $this->dikirim_ke_pabrik_karet = $dataFiber->dikirim_ke_pabrik_karet;
                $this->dikirim_ke_pabrik_gula = $dataFiber->dikirim_ke_pabrik_gula;
                $this->dikirim_ke_bibitan_kelapa_sawit = $dataFiber->dikirim_ke_bibitan_kelapa_sawit;
                $this->dikirim_ke_pks_lain = $dataFiber->dikirim_ke_pks_lain;
                $this->volume_keperluan_lain = $dataFiber->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataFiber->keterangan_keperluan_lain;
                $this->keterangan_do_pending = $dataFiber->keterangan_do_pending;
                $this->dijual = $dataFiber->dijual;
                $this->harga_jual_rata_rata = number_format($dataFiber->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima_dari_pks_lain = $dataFiber->diterima_dari_pks_lain;
                $this->id_data_fiber = $dataFiber->id_fiber;
            } else {
                $this->cleanData();
            }
            $this->produksi_fiber = $dataFiber->produksi_fiber;
            $this->tbs_olah = $dataFiber->tbs_olah;
            $this->id_produksi = $dataFiber->id_produksi;
            $this->isAllowed = true;
        } else {
            $this->cleanData();
        }
        $this->dataFiber = $dataFiber;
        $this->render();
    }

    public function cleanData()
    {
        $this->digunakan_u_bahan_bakar = 0;
        $this->dikirim_ke_pabrik_teh = 0;
        $this->dikirim_ke_pabrik_karet = 0;
        $this->dikirim_ke_pabrik_gula = 0;
        $this->dikirim_ke_bibitan_kelapa_sawit = 0;
        $this->dikirim_ke_pks_lain = 0;
        $this->volume_keperluan_lain = 0;
        $this->keterangan_keperluan_lain = '';
        $this->keterangan_do_pending = '';
        $this->dijual = 0;
        $this->harga_jual_rata_rata = 0;
        $this->diterima_dari_pks_lain = 0;
        $this->photo = null;
        $this->isAllowed = false;
    }

    #[On('confirm')]
    public function submit()
    {
        try {
            $this->digunakan_u_bahan_bakar = str_replace('.', '', $this->digunakan_u_bahan_bakar);
            $this->dikirim_ke_pabrik_teh = str_replace('.', '', $this->dikirim_ke_pabrik_teh);
            $this->dikirim_ke_pabrik_karet = str_replace('.', '', $this->dikirim_ke_pabrik_karet);
            $this->dikirim_ke_pabrik_gula = str_replace('.', '', $this->dikirim_ke_pabrik_gula);
            $this->dikirim_ke_bibitan_kelapa_sawit = str_replace('.', '', $this->dikirim_ke_bibitan_kelapa_sawit);
            $this->dikirim_ke_pks_lain = str_replace('.', '', $this->dikirim_ke_pks_lain);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);

            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            $this->validate([
                'digunakan_u_bahan_bakar' => 'required|numeric',
                'dikirim_ke_pabrik_teh' => 'required|numeric',
                'dikirim_ke_pabrik_karet' => 'required|numeric',
                'dikirim_ke_pabrik_gula' => 'required|numeric',
                'dikirim_ke_bibitan_kelapa_sawit' => 'required|numeric',
                'dikirim_ke_pks_lain' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'keterangan_keperluan_lain' => 'nullable|string',
                'keterangan_do_pending' => 'nullable|string',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'photo' => 'required|image',
            ]);

            DB::transaction(function () {
                list($bulan, $tahun) = explode('/', $this->periode);
                $data = [
                    'uuid' => Str::uuid(),
                    'id_t_produksi' => $this->id_produksi,
                    'digunakan_u_bahan_bakar' => $this->digunakan_u_bahan_bakar,
                    'dikirim_ke_pabrik_teh' => $this->dikirim_ke_pabrik_teh,
                    'dikirim_ke_pabrik_karet' => $this->dikirim_ke_pabrik_karet,
                    'dikirim_ke_pabrik_gula' => $this->dikirim_ke_pabrik_gula,
                    'dikirim_ke_bibitan_kelapa_sawit' => $this->dikirim_ke_bibitan_kelapa_sawit,
                    'dikirim_ke_pks_lain' => $this->dikirim_ke_pks_lain,
                    'volume_keperluan_lain' => $this->volume_keperluan_lain,
                    'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                    'keterangan_do_pending' => $this->keterangan_do_pending,
                    'dijual' => $this->dijual,
                    'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                    'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                    'tanggal' => Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('Y-m-d'),
                ];
                TransaksiFiber::create($data);
                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $data['uuid'],
                    'nama_file' => $this->photo->store('fiber', 'public'),
                    'kategori' => 'fiber',
                    'upload_by' => auth()->user()->nik_sap,
                ]);
            });
            $this->dispatch('updateMonitoring');
            $this->cleanData();
            $this->setData($this->periode, $this->unit);
            $this->js('berhasil()');
            $this->render();
        } catch (\Exception $e) {
            $this->js("gagal('{$e->getMessage()}')");
        }
    }

    #[On('saveEdit')]
    public function saveEdit($keterangan)
    {
        list($bulan, $tahun) = explode('/', $this->periode);
        $data = TransaksiFiber::where('uuid', $this->id_data_fiber)->first();
        try {
            $this->digunakan_u_bahan_bakar = str_replace('.', '', $this->digunakan_u_bahan_bakar);
            $this->dikirim_ke_pabrik_teh = str_replace('.', '', $this->dikirim_ke_pabrik_teh);
            $this->dikirim_ke_pabrik_karet = str_replace('.', '', $this->dikirim_ke_pabrik_karet);
            $this->dikirim_ke_pabrik_gula = str_replace('.', '', $this->dikirim_ke_pabrik_gula);
            $this->dikirim_ke_bibitan_kelapa_sawit = str_replace('.', '', $this->dikirim_ke_bibitan_kelapa_sawit);
            $this->dikirim_ke_pks_lain = str_replace('.', '', $this->dikirim_ke_pks_lain);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);

            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            if ($this->harga_jual_rata_rata == 0) {
                $this->harga_jual_rata_rata = 0;
            }
            $this->validate([
                'digunakan_u_bahan_bakar' => 'required|numeric',
                'dikirim_ke_pabrik_teh' => 'required|numeric',
                'dikirim_ke_pabrik_karet' => 'required|numeric',
                'dikirim_ke_pabrik_gula' => 'required|numeric',
                'dikirim_ke_bibitan_kelapa_sawit' => 'required|numeric',
                'dikirim_ke_pks_lain' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'keterangan_keperluan_lain' => 'nullable|string',
                'keterangan_do_pending' => 'nullable|string',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'photo' => 'nullable|image',
            ]);

            $input = [
                'digunakan_u_bahan_bakar' => $this->digunakan_u_bahan_bakar,
                'dikirim_ke_pabrik_teh' => $this->dikirim_ke_pabrik_teh,
                'dikirim_ke_pabrik_karet' => $this->dikirim_ke_pabrik_karet,
                'dikirim_ke_pabrik_gula' => $this->dikirim_ke_pabrik_gula,
                'dikirim_ke_bibitan_kelapa_sawit' => $this->dikirim_ke_bibitan_kelapa_sawit,
                'dikirim_ke_pks_lain' => $this->dikirim_ke_pks_lain,
                'volume_keperluan_lain' => $this->volume_keperluan_lain,
                'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                'keterangan_do_pending' => $this->keterangan_do_pending,
                'dijual' => $this->dijual,
                'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
            ];

            $dbData = $data->only(array_keys($input));
            $changed = array_diff_assoc($input, $dbData);

            DB::transaction(function () use ($data, $changed, $input, $dbData, $keterangan) {
                if (!empty($changed)) {
                    $data->update([
                        'digunakan_u_bahan_bakar' => $this->digunakan_u_bahan_bakar,
                        'dikirim_ke_pabrik_teh' => $this->dikirim_ke_pabrik_teh,
                        'dikirim_ke_pabrik_karet' => $this->dikirim_ke_pabrik_karet,
                        'dikirim_ke_pabrik_gula' => $this->dikirim_ke_pabrik_gula,
                        'dikirim_ke_bibitan_kelapa_sawit' => $this->dikirim_ke_bibitan_kelapa_sawit,
                        'dikirim_ke_pks_lain' => $this->dikirim_ke_pks_lain,
                        'volume_keperluan_lain' => $this->volume_keperluan_lain,
                        'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                        'keterangan_do_pending' => $this->keterangan_do_pending,
                        'dijual' => $this->dijual,
                        'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                        'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                    ]);
                    foreach ($changed as $key => $change) {
                        LogTransaksi::create([
                            'uuid' => Str::uuid(),
                            'id_transaksi' => $data->uuid,
                            'kategori_transaksi' => $key,
                            'jenis_transaksi' => 'fiber',
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
                        'id_transaksi' => $this->id_data_fiber,
                        'nama_file' => $this->photo->store('fiber', 'public'),
                        'kategori' => 'fiber',
                        'upload_by' => auth()->user()->nik_sap,
                    ]);
                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'fiber',
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
