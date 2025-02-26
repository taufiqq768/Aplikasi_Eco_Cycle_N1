<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnit;
use App\Models\TransaksiEvidence;
use App\Models\TransaksiTankos;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class FormInputTankos extends Component
{
    use WithFileUploads;
    public $periode;
    public $unit;
    public $dataTankos;
    public $digunakan_sbg_pupuk_organik;
    public $digunakan_u_pltbm;
    public $dikembalikan_ke_pemasok;
    public $dibakar_di_tungku_bakar;
    public $volume_keperluan_lain;
    public $keterangan_keperluan_lain;
    public $keterangan_do_pending;
    public $dijual;
    public $harga_jual_rata_rata;
    public $diterima_dari_pks_lain;
    public $id_data_tankos;
    public $photo;
    public $isAllowed = false;
    public $id_produksi;
    public $tbs_olah;
    public $produksi_tankos;
    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataTankos = MasterUnit::query()
            ->unitWithTankos($unit, $tahun, $bulan)
            ->first();
        if ($dataTankos) {
            if ($dataTankos->id_tankos) {
                $this->digunakan_sbg_pupuk_organik = $dataTankos->digunakan_sbg_pupuk_organik;
                $this->digunakan_u_pltbm = $dataTankos->digunakan_u_pltbm;
                $this->dikembalikan_ke_pemasok = $dataTankos->dikembalikan_ke_pemasok;
                $this->dibakar_di_tungku_bakar = $dataTankos->dibakar_di_tungku_bakar;
                $this->volume_keperluan_lain = $dataTankos->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataTankos->keterangan_keperluan_lain;
                $this->keterangan_do_pending = $dataTankos->keterangan_do_pending;
                $this->dijual = $dataTankos->dijual;
                $this->harga_jual_rata_rata = number_format($dataTankos->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima_dari_pks_lain = $dataTankos->diterima_dari_pks_lain;
                $this->id_data_tankos = $dataTankos->id_tankos;
            } else {
                $this->cleanData();
            }
            $this->produksi_tankos = $dataTankos->produksi_tankos;
            $this->tbs_olah = $dataTankos->tbs_olah;
            $this->id_produksi = $dataTankos->id_produksi;
            $this->isAllowed = true;
        }
        $this->dataTankos = $dataTankos;
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
        return view('livewire.transaksi.form-input-tankos', compact('isPeriodeOpen'));
    }

    #[On('setDataTankos')]
    public function setData($periode, $unit)
    {
        $this->cleanData();
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataTankos = MasterUnit::query()
            ->unitWithTankos($unit, $tahun, $bulan)
            ->first();
        if ($dataTankos) {
            if ($dataTankos->id_tankos) {
                $this->digunakan_sbg_pupuk_organik = $dataTankos->digunakan_sbg_pupuk_organik;
                $this->digunakan_u_pltbm = $dataTankos->digunakan_u_pltbm;
                $this->dikembalikan_ke_pemasok = $dataTankos->dikembalikan_ke_pemasok;
                $this->dibakar_di_tungku_bakar = $dataTankos->dibakar_di_tungku_bakar;
                $this->volume_keperluan_lain = $dataTankos->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataTankos->keterangan_keperluan_lain;
                $this->keterangan_do_pending = $dataTankos->keterangan_do_pending;
                $this->dijual = $dataTankos->dijual;
                $this->harga_jual_rata_rata = number_format($dataTankos->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima_dari_pks_lain = $dataTankos->diterima_dari_pks_lain;
                $this->id_data_tankos = $dataTankos->id_tankos;
            } else {
                $this->cleanData();
            }
            $this->produksi_tankos = $dataTankos->produksi_tankos;
            $this->tbs_olah = $dataTankos->tbs_olah;
            $this->id_produksi = $dataTankos->id_produksi;
            $this->isAllowed = true;
        } else {
            $this->cleanData();
        }
        $this->dataTankos = $dataTankos;
        $this->render();
    }

    public function cleanData()
    {
        $this->digunakan_sbg_pupuk_organik = 0;
        $this->digunakan_u_pltbm = 0;
        $this->dikembalikan_ke_pemasok = 0;
        $this->dibakar_di_tungku_bakar = 0;
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
            $this->digunakan_sbg_pupuk_organik = str_replace('.', '', $this->digunakan_sbg_pupuk_organik);
            $this->digunakan_u_pltbm = str_replace('.', '', $this->digunakan_u_pltbm);
            $this->dikembalikan_ke_pemasok = str_replace('.', '', $this->dikembalikan_ke_pemasok);
            $this->dibakar_di_tungku_bakar = str_replace('.', '', $this->dibakar_di_tungku_bakar);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);

            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            $this->validate([
                'digunakan_sbg_pupuk_organik' => 'required|numeric',
                'digunakan_u_pltbm' => 'required|numeric',
                'dikembalikan_ke_pemasok' => 'required|numeric',
                'dibakar_di_tungku_bakar' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'photo' => 'required|image'
            ]);

            DB::transaction(function () {
                list($bulan, $tahun) = explode('/', $this->periode);
                $data = [
                    'uuid' => Str::uuid(),
                    'id_t_produksi' => $this->id_produksi,
                    'digunakan_sbg_pupuk_organik' => $this->digunakan_sbg_pupuk_organik,
                    'digunakan_u_pltbm' => $this->digunakan_u_pltbm,
                    'dikembalikan_ke_pemasok' => $this->dikembalikan_ke_pemasok,
                    'dibakar_di_tungku_bakar' => $this->dibakar_di_tungku_bakar,
                    'volume_keperluan_lain' => $this->volume_keperluan_lain,
                    'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                    'keterangan_do_pending' => $this->keterangan_do_pending,
                    'dijual' => $this->dijual,
                    'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                    'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                    'tanggal' => Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('Y-m-d'),
                ];
                TransaksiTankos::create($data);
                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $data['uuid'],
                    'nama_file' => $this->photo->store('tankos', 'public'),
                    'kategori' => 'tankos',
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
        $data = TransaksiTankos::where('uuid', $this->id_data_tankos)->first();
        try {
            $this->digunakan_sbg_pupuk_organik = str_replace('.', '', $this->digunakan_sbg_pupuk_organik);
            $this->digunakan_u_pltbm = str_replace('.', '', $this->digunakan_u_pltbm);
            $this->dikembalikan_ke_pemasok = str_replace('.', '', $this->dikembalikan_ke_pemasok);
            $this->dibakar_di_tungku_bakar = str_replace('.', '', $this->dibakar_di_tungku_bakar);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->dijual = str_replace('.', '', $this->dijual);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);

            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            if ($this->harga_jual_rata_rata == 0) {
                $this->harga_jual_rata_rata = 0;
            }
            $this->validate([
                'digunakan_sbg_pupuk_organik' => 'required|numeric',
                'digunakan_u_pltbm' => 'required|numeric',
                'dikembalikan_ke_pemasok' => 'required|numeric',
                'dibakar_di_tungku_bakar' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'dijual' => 'required|numeric',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'photo' => 'nullable|image'
            ]);

            $input = [
                'digunakan_sbg_pupuk_organik' => $this->digunakan_sbg_pupuk_organik,
                'digunakan_u_pltbm' => $this->digunakan_u_pltbm,
                'dikembalikan_ke_pemasok' => $this->dikembalikan_ke_pemasok,
                'dibakar_di_tungku_bakar' => $this->dibakar_di_tungku_bakar,
                'volume_keperluan_lain' => $this->volume_keperluan_lain,
                'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                'keterangan_do_pending' => $this->keterangan_do_pending,
                'dijual' => $this->dijual,
                'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain
            ];

            $dbData = $data->only(array_keys($input));
            $changed = array_diff_assoc($input, $dbData);

            DB::transaction(function () use ($data, $changed, $dbData, $keterangan, $input) {
                if (!empty($changed)) {
                    $data->update([
                        'digunakan_sbg_pupuk_organik' => $this->digunakan_sbg_pupuk_organik,
                        'digunakan_u_pltbm' => $this->digunakan_u_pltbm,
                        'dikembalikan_ke_pemasok' => $this->dikembalikan_ke_pemasok,
                        'dibakar_di_tungku_bakar' => $this->dibakar_di_tungku_bakar,
                        'volume_keperluan_lain' => $this->volume_keperluan_lain,
                        'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                        'keterangan_do_pending' => $this->keterangan_do_pending,
                        'dijual' => $this->dijual,
                        'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                        'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain
                    ]);
                    foreach ($changed as $key => $change) {
                        LogTransaksi::create([
                            'uuid' => Str::uuid(),
                            'id_transaksi' => $data->uuid,
                            'kategori_transaksi' => $key,
                            'jenis_transaksi' => 'tankos',
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
                        'nama_file' => $this->photo->store('tankos', 'public'),
                        'kategori' => 'tankos',
                        'upload_by' => auth()->user()->nik_sap
                    ]);
                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'tankos',
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
