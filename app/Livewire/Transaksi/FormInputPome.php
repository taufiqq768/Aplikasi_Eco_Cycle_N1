<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnit;
use App\Models\TransaksiEvidence;
use App\Models\TransaksiPome;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class FormInputPome extends Component
{
    use WithFileUploads;
    public $periode;
    public $unit;
    public $dataPomeOil;
    public $digunakan_biogas_pks;
    public $dikirim_kebun_u_land_aplikasi;
    public $dibuang_ke_aliran_sungai;
    public $potensi_pome_oil;
    public $pome_oil_dikutip;
    public $pome_oil_terkutip_diolah_kembali;
    public $pome_oil_terkutip_dikirim_pks_lain;
    public $pome_oil_terkutip_dijual;
    public $volume_keperluan_lain;
    public $keterangan_keperluan_lain;
    public $keterangan_do_pending;
    public $harga_jual_rata_rata;
    public $diterima_dari_pks_lain;
    public $id_data_pome_oil;
    public $photo;
    public $isAllowed = false;
    public $id_produksi;
    public $tbs_olah;
    public $produksi_pome_oil;
    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataPomeOil = MasterUnit::query()
            ->unitWithPomeOil($unit, $tahun, $bulan)
            ->first();
        if ($dataPomeOil) {
            if ($dataPomeOil->id_pome) {
                $this->digunakan_biogas_pks = $dataPomeOil->digunakan_biogas_pks;
                $this->dikirim_kebun_u_land_aplikasi = $dataPomeOil->dikirim_kebun_u_land_aplikasi;
                $this->dibuang_ke_aliran_sungai = $dataPomeOil->dibuang_ke_aliran_sungai;
                $this->potensi_pome_oil = $dataPomeOil->potensi_pome_oil;
                $this->pome_oil_dikutip = $dataPomeOil->pome_oil_dikutip;
                $this->pome_oil_terkutip_diolah_kembali = $dataPomeOil->pome_oil_terkutip_diolah_kembali;
                $this->pome_oil_terkutip_dikirim_pks_lain = $dataPomeOil->pome_oil_terkutip_dikirim_pks_lain;
                $this->pome_oil_terkutip_dijual = $dataPomeOil->pome_oil_terkutip_dijual;
                $this->volume_keperluan_lain = $dataPomeOil->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataPomeOil->keterangan_keperluan_lain;
                $this->keterangan_do_pending = $dataPomeOil->keterangan_do_pending;
                $this->harga_jual_rata_rata = number_format($dataPomeOil->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima_dari_pks_lain = $dataPomeOil->diterima_dari_pks_lain;

                $this->id_data_pome_oil = $dataPomeOil->id_pome;
            } else {
                $this->cleanData();
            }
            $this->produksi_pome_oil = $dataPomeOil->produksi_pome_oil;
            $this->tbs_olah = $dataPomeOil->tbs_olah;
            $this->id_produksi = $dataPomeOil->id_produksi;
            $this->isAllowed = true;
        }
        $this->dataPomeOil = $dataPomeOil;
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
        return view('livewire.transaksi.form-input-pome', compact('isPeriodeOpen'));
    }

    #[On('setDataPomeOil')]
    public function setData($periode, $unit)
    {
        $this->cleanData();
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataPomeOil = MasterUnit::query()
            ->unitWithPomeOil($unit, $tahun, $bulan)
            ->first();
        if ($dataPomeOil) {
            if ($dataPomeOil->id_pome) {
                $this->digunakan_biogas_pks = $dataPomeOil->digunakan_biogas_pks;
                $this->dikirim_kebun_u_land_aplikasi = $dataPomeOil->dikirim_kebun_u_land_aplikasi;
                $this->dibuang_ke_aliran_sungai = $dataPomeOil->dibuang_ke_aliran_sungai;
                $this->potensi_pome_oil = $dataPomeOil->potensi_pome_oil;
                $this->pome_oil_dikutip = $dataPomeOil->pome_oil_dikutip;
                $this->pome_oil_terkutip_diolah_kembali = $dataPomeOil->pome_oil_terkutip_diolah_kembali;
                $this->pome_oil_terkutip_dikirim_pks_lain = $dataPomeOil->pome_oil_terkutip_dikirim_pks_lain;
                $this->pome_oil_terkutip_dijual = $dataPomeOil->pome_oil_terkutip_dijual;
                $this->volume_keperluan_lain = $dataPomeOil->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataPomeOil->keterangan_keperluan_lain;
                $this->keterangan_do_pending = $dataPomeOil->keterangan_do_pending;
                $this->harga_jual_rata_rata = number_format($dataPomeOil->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima_dari_pks_lain = $dataPomeOil->diterima_dari_pks_lain;

                $this->id_data_pome_oil = $dataPomeOil->id_pome;
            } else {
                $this->cleanData();
            }
            $this->produksi_pome_oil = $dataPomeOil->produksi_pome_oil;
            $this->tbs_olah = $dataPomeOil->tbs_olah;
            $this->id_produksi = $dataPomeOil->id_produksi;
            $this->isAllowed = true;
        } else {
            $this->cleanData();
        }
        $this->dataPomeOil = $dataPomeOil;
        $this->render();
    }

    public function cleanData()
    {
        $this->digunakan_biogas_pks = 0;
        $this->dikirim_kebun_u_land_aplikasi = 0;
        $this->dibuang_ke_aliran_sungai = 0;
        $this->potensi_pome_oil = 0;
        $this->pome_oil_dikutip = 0;
        $this->pome_oil_terkutip_diolah_kembali = 0;
        $this->pome_oil_terkutip_dikirim_pks_lain = 0;
        $this->pome_oil_terkutip_dijual = 0;
        $this->volume_keperluan_lain = 0;
        $this->keterangan_keperluan_lain = '';
        $this->keterangan_do_pending = '';
        $this->harga_jual_rata_rata = 0;
        $this->diterima_dari_pks_lain = 0;

        $this->photo = null;
        $this->isAllowed = false;
    }

    #[On('confirm')]
    public function submit()
    {
        try {
            $this->digunakan_biogas_pks = str_replace('.', '', $this->digunakan_biogas_pks);
            $this->dikirim_kebun_u_land_aplikasi = str_replace('.', '', $this->dikirim_kebun_u_land_aplikasi);
            $this->dibuang_ke_aliran_sungai = str_replace('.', '', $this->dibuang_ke_aliran_sungai);
            $this->potensi_pome_oil = str_replace('.', '', $this->potensi_pome_oil);
            $this->pome_oil_dikutip = str_replace('.', '', $this->pome_oil_dikutip);
            $this->pome_oil_terkutip_diolah_kembali = str_replace('.', '', $this->pome_oil_terkutip_diolah_kembali);
            $this->pome_oil_terkutip_dikirim_pks_lain = str_replace('.', '', $this->pome_oil_terkutip_dikirim_pks_lain);
            $this->pome_oil_terkutip_dijual = str_replace('.', '', $this->pome_oil_terkutip_dijual);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);

            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            $this->validate([
                'digunakan_biogas_pks' => 'required|numeric',
                'dikirim_kebun_u_land_aplikasi' => 'required|numeric',
                'dibuang_ke_aliran_sungai' => 'required|numeric',
                'potensi_pome_oil' => 'required|numeric',
                'pome_oil_dikutip' => 'required|numeric',
                'pome_oil_terkutip_diolah_kembali' => 'required|numeric',
                'pome_oil_terkutip_dikirim_pks_lain' => 'required|numeric',
                'pome_oil_terkutip_dijual' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'keterangan_keperluan_lain' => 'nullable',
                'keterangan_do_pending' => 'nullable',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'photo' => 'required|image',
            ]);

            DB::transaction(function () {
                list($bulan, $tahun) = explode('/', $this->periode);
                $data = [
                    'uuid' => Str::uuid(),
                    'id_t_produksi' => $this->id_produksi,
                    'digunakan_biogas_pks' => $this->digunakan_biogas_pks,
                    'dikirim_kebun_u_land_aplikasi' => $this->dikirim_kebun_u_land_aplikasi,
                    'dibuang_ke_aliran_sungai' => $this->dibuang_ke_aliran_sungai,
                    'potensi_pome_oil' => $this->potensi_pome_oil,
                    'pome_oil_dikutip' => $this->pome_oil_dikutip,
                    'pome_oil_terkutip_diolah_kembali' => $this->pome_oil_terkutip_diolah_kembali,
                    'pome_oil_terkutip_dikirim_pks_lain' => $this->pome_oil_terkutip_dikirim_pks_lain,
                    'pome_oil_terkutip_dijual' => $this->pome_oil_terkutip_dijual,
                    'volume_keperluan_lain' => $this->volume_keperluan_lain,
                    'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                    'keterangan_do_pending' => $this->keterangan_do_pending,
                    'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                    'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                    'tanggal' => Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('Y-m-d'),
                ];
                TransaksiPome::create($data);
                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $data['uuid'],
                    'nama_file' => $this->photo->store('pomeOil', 'public'),
                    'kategori' => 'pomeOil',
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
        $data = TransaksiPome::where('uuid', $this->id_data_pome_oil)->first();
        try {
            $this->digunakan_biogas_pks = str_replace('.', '', $this->digunakan_biogas_pks);
            $this->dikirim_kebun_u_land_aplikasi = str_replace('.', '', $this->dikirim_kebun_u_land_aplikasi);
            $this->dibuang_ke_aliran_sungai = str_replace('.', '', $this->dibuang_ke_aliran_sungai);
            $this->potensi_pome_oil = str_replace('.', '', $this->potensi_pome_oil);
            $this->pome_oil_dikutip = str_replace('.', '', $this->pome_oil_dikutip);
            $this->pome_oil_terkutip_diolah_kembali = str_replace('.', '', $this->pome_oil_terkutip_diolah_kembali);
            $this->pome_oil_terkutip_dikirim_pks_lain = str_replace('.', '', $this->pome_oil_terkutip_dikirim_pks_lain);
            $this->pome_oil_terkutip_dijual = str_replace('.', '', $this->pome_oil_terkutip_dijual);
            $this->volume_keperluan_lain = str_replace('.', '', $this->volume_keperluan_lain);
            $this->harga_jual_rata_rata = str_replace(['.', ','], ['', '.'], $this->harga_jual_rata_rata);

            $this->diterima_dari_pks_lain = str_replace('.', '', $this->diterima_dari_pks_lain);
            if ($this->harga_jual_rata_rata == 0) {
                $this->harga_jual_rata_rata = 0;
            }
            $this->validate([
                'digunakan_biogas_pks' => 'required|numeric',
                'dikirim_kebun_u_land_aplikasi' => 'required|numeric',
                'dibuang_ke_aliran_sungai' => 'required|numeric',
                'potensi_pome_oil' => 'required|numeric',
                'pome_oil_dikutip' => 'required|numeric',
                'pome_oil_terkutip_diolah_kembali' => 'required|numeric',
                'pome_oil_terkutip_dikirim_pks_lain' => 'required|numeric',
                'pome_oil_terkutip_dijual' => 'required|numeric',
                'volume_keperluan_lain' => 'required|numeric',
                'keterangan_keperluan_lain' => 'nullable',
                'keterangan_do_pending' => 'nullable',
                'harga_jual_rata_rata' => 'required|numeric',
                'diterima_dari_pks_lain' => 'required|numeric',
                'photo' => 'nullable|image',
            ]);

            $input = [
                'digunakan_biogas_pks' => $this->digunakan_biogas_pks,
                'dikirim_kebun_u_land_aplikasi' => $this->dikirim_kebun_u_land_aplikasi,
                'dibuang_ke_aliran_sungai' => $this->dibuang_ke_aliran_sungai,
                'potensi_pome_oil' => $this->potensi_pome_oil,
                'pome_oil_dikutip' => $this->pome_oil_dikutip,
                'pome_oil_terkutip_diolah_kembali' => $this->pome_oil_terkutip_diolah_kembali,
                'pome_oil_terkutip_dikirim_pks_lain' => $this->pome_oil_terkutip_dikirim_pks_lain,
                'pome_oil_terkutip_dijual' => $this->pome_oil_terkutip_dijual,
                'volume_keperluan_lain' => $this->volume_keperluan_lain,
                'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                'keterangan_do_pending' => $this->keterangan_do_pending,
                'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
            ];
            $dbData = $data->only(array_keys($input));
            $changed = array_diff_assoc($input, $dbData);

            DB::transaction(function () use ($data, $dbData, $changed, $keterangan, $input) {
                if (!empty($changed)) {
                    $data->update([
                        'digunakan_biogas_pks' => $this->digunakan_biogas_pks,
                        'dikirim_kebun_u_land_aplikasi' => $this->dikirim_kebun_u_land_aplikasi,
                        'dibuang_ke_aliran_sungai' => $this->dibuang_ke_aliran_sungai,
                        'potensi_pome_oil' => $this->potensi_pome_oil,
                        'pome_oil_dikutip' => $this->pome_oil_dikutip,
                        'pome_oil_terkutip_diolah_kembali' => $this->pome_oil_terkutip_diolah_kembali,
                        'pome_oil_terkutip_dikirim_pks_lain' => $this->pome_oil_terkutip_dikirim_pks_lain,
                        'pome_oil_terkutip_dijual' => $this->pome_oil_terkutip_dijual,
                        'volume_keperluan_lain' => $this->volume_keperluan_lain,
                        'keterangan_keperluan_lain' => $this->keterangan_keperluan_lain,
                        'keterangan_do_pending' => $this->keterangan_do_pending,
                        'harga_jual_rata_rata' => $this->harga_jual_rata_rata,
                        'diterima_dari_pks_lain' => $this->diterima_dari_pks_lain,
                    ]);
                    foreach ($changed as $key => $change) {
                        LogTransaksi::create([
                            'uuid' => Str::uuid(),
                            'id_transaksi' => $data->uuid,
                            'kategori_transaksi' => $key,
                            'jenis_transaksi' => 'pomeOil',
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
                        'nama_file' => $this->photo->store('pomeOil', 'public'),
                        'kategori' => 'pomeOil',
                        'upload_by' => auth()->user()->nik_sap
                    ]);
                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'pomeOil',
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
