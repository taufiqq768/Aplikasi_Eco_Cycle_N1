<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnit;
use App\Models\TransaksiCangkang;
use App\Models\TransaksiEvidence;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class FormInputCangkang extends Component
{
    use WithFileUploads;
    public $periode;
    public $unit;
    public $digunakan_u_bahan_bakar;
    public $dikirim_ke_pabrik_teh;
    public $dikirim_ke_pabrik_karet;
    public $dikirim_ke_pabrik_gula;
    public $dikirim_ke_bibitan_kelapa_sawit;
    public $dikirim_ke_pks_lain;
    public $volume_keperluan_lain;
    public $keterangan_keperluan_lain;
    public $dijual;
    public $harga_jual_rata_rata;
    public $diterima_dari_pks_lain;
    public $sisa_stok_akhir;
    public $pendapatan;
    public $persen_ekses_cangkang;
    public $material_balance;
    public $dataCangkang;
    public $photo;
    public $isAllowed = false;
    public $produksi_cangkang;
    public $tbs_olah;
    public $idProduksi;
    public $id_data_cangkang;
    public $keterangan_do_pending;
    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
        $this->setData($periode, $unit);
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
        return view('livewire.transaksi.form-input-cangkang', compact('isPeriodeOpen'));
    }

    #[On('setDataCangkang')]
    public function setData($periode, $unit)
    {
        $this->cleanData();
        $this->periode = $periode;
        $this->unit = $unit;
        list($bulan, $tahun) = explode('/', $periode);
        $dataCangkang = MasterUnit::query()
            ->unitWithCangkang($unit, $tahun, $bulan)
            ->first();

        if ($dataCangkang) {
            if ($dataCangkang->id_cangkang) {
                $this->digunakan_u_bahan_bakar = $dataCangkang->digunakan_u_bahan_bakar;
                $this->dikirim_ke_pabrik_teh = $dataCangkang->dikirim_ke_pabrik_teh;
                $this->dikirim_ke_pabrik_karet = $dataCangkang->dikirim_ke_pabrik_karet;
                $this->dikirim_ke_pabrik_gula = $dataCangkang->dikirim_ke_pabrik_gula;
                $this->dikirim_ke_bibitan_kelapa_sawit = $dataCangkang->dikirim_ke_bibitan_kelapa_sawit;
                $this->dikirim_ke_pks_lain = $dataCangkang->dikirim_ke_pks_lain;
                $this->volume_keperluan_lain = $dataCangkang->volume_keperluan_lain;
                $this->keterangan_keperluan_lain = $dataCangkang->keterangan_keperluan_lain;
                $this->keterangan_do_pending = $dataCangkang->keterangan_do_pending;
                $this->dijual = $dataCangkang->dijual;
                $this->harga_jual_rata_rata = number_format($dataCangkang->harga_jual_rata_rata, 2, ',', '.');
                $this->diterima_dari_pks_lain = $dataCangkang->diterima_dari_pks_lain;
                $this->sisa_stok_akhir = $dataCangkang->sisa_stok_akhir;
                $this->pendapatan = $dataCangkang->pendapatan;
                $this->persen_ekses_cangkang = $dataCangkang->persen_ekses_cangkang;
                $this->material_balance = $dataCangkang->material_balance;
                $this->id_data_cangkang = $dataCangkang->id_cangkang;
            } else {
                $this->cleanData();
            }
            $this->produksi_cangkang = $dataCangkang->produksi_cangkang;
            $this->tbs_olah = $dataCangkang->tbs_olah;
            $this->idProduksi = $dataCangkang->id_produksi;
            $this->isAllowed = true;
        } else {
            $this->cleanData();
        }
        $this->dataCangkang = $dataCangkang;
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
        $this->sisa_stok_akhir = 0;
        $this->pendapatan = 0;
        $this->persen_ekses_cangkang = 0;
        $this->material_balance = 0;
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
                // 'sisa_stok_akhir' => 'required|numeric',
                // 'pendapatan' => 'required|numeric',
                // 'persen_ekses_cangkang' => 'required|numeric',
                // 'material_balance' => 'required|numeric',
                'photo' => 'required|image',
            ]);

            DB::transaction(function () {
                list($bulan, $tahun) = explode('/', $this->periode);
                $stok = $this->produksi_cangkang + $this->diterima_dari_pks_lain;
                $digunakan = $this->digunakan_u_bahan_bakar + $this->dikirim_ke_pabrik_teh + $this->dikirim_ke_pabrik_karet + $this->dikirim_ke_pabrik_gula
                    + $this->dikirim_ke_bibitan_kelapa_sawit + $this->dikirim_ke_pks_lain + $this->volume_keperluan_lain + $this->dijual;
                $sisa = $this->produksi_cangkang - $this->digunakan_u_bahan_bakar;
                $ekses = 0;
                $material_balance = 0;
                if ($sisa != 0 && $this->produksi_cangkang != 0) {
                    $ekses = number_format($sisa / $this->produksi_cangkang * 100, 2, '.', '');
                }
                if ($sisa != 0 && $this->tbs_olah != 0) {
                    $material_balance = number_format($sisa / $this->tbs_olah * 100, 2, '.', '');
                }
                $cangkang = [
                    'uuid' => Str::uuid(),
                    'id_t_produksi' => $this->idProduksi,
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
                    'sisa_stok_akhir' => $stok - $digunakan,
                    'pendapatan' => $this->dijual * $this->harga_jual_rata_rata,
                    'persen_ekses_cangkang' => $ekses,
                    'material_balance' => $material_balance,
                    'tanggal' => Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('Y-m-d'),
                ];
                TransaksiCangkang::create($cangkang);
                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $cangkang['uuid'],
                    'nama_file' => $this->photo->store('cangkang', 'public'),
                    'kategori' => 'cangkang',
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
        $data = TransaksiCangkang::where('uuid', $this->id_data_cangkang)->first();
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
                            'jenis_transaksi' => 'cangkang',
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
                        'nama_file' => $this->photo->store('cangkang', 'public'),
                        'kategori' => 'cangkang',
                        'upload_by' => auth()->user()->nik_sap,
                    ]);

                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'cangkang',
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
