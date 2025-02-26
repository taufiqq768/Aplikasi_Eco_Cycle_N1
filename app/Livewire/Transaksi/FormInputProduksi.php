<?php

namespace App\Livewire\Transaksi;

use App\Models\LogTransaksi;
use App\Models\MasterPeriode;
use App\Models\MasterUnit;
use App\Models\TransaksiEvidence;
use App\Models\TransaksiProduksi;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class FormInputProduksi extends Component
{
    use WithFileUploads;
    public $periode;
    public $dataProduksi;
    public $bulan;
    public $tahun;
    public $unit;
    public $tbs = 0;
    public $cangkang = 0;
    public $fiber = 0;
    public $tankos = 0;
    public $abu_janjang = 0;
    public $abu_boiler = 0;
    public $solid = 0;
    public $pome_oil = 0;
    public $pkm = 0;
    public $tea_waste = 0;
    public $limbah_serum = 0; 
    public $tunggul_karet = 0; 
    public $abu = 0; 
    public $ranting = 0; 
    public $kulit_buah = 0; 
    public $husk_skin = 0;
    public $mucilage = 0;              
    public $photo;
    public $existPhoto;
    public $idDataProduksi;
    public $is_bunch = false;

    public function mount($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;

        list($bulan, $tahun) = explode('/', $periode);
        $dataProduksi = MasterUnit::query()
            ->withProduksi($unit, $tahun, $bulan)
            ->first();
        if ($dataProduksi) {
            $this->idDataProduksi = $dataProduksi->id_produksi;
            $this->tbs = $dataProduksi->tbs_olah;
            $this->cangkang = $dataProduksi->produksi_cangkang;
            $this->fiber = $dataProduksi->produksi_fiber;
            $this->tankos = $dataProduksi->produksi_tankos;
            $this->abu_janjang = $dataProduksi->produksi_abu_janjang;
            $this->abu_boiler = $dataProduksi->produksi_abu_boiler;
            $this->solid = $dataProduksi->produksi_solid;
            $this->pome_oil = $dataProduksi->produksi_pome_oil;
            $this->pkm = $dataProduksi->produksi_pkm;
            $this->tea_waste = $dataProduksi->produksi_teawaste;
            $this->tunggul_karet = $dataProduksi->produksi_tunggulkaret;
            $this->limbah_serum = $dataProduksi->produksi_limbahserum;
            $this->abu = $dataProduksi->produksi_abu;
            $this->ranting = $dataProduksi->produksi_ranting;
            $this->kulit_buah = $dataProduksi->produksi_kulitbuah;
            $this->husk_skin = $dataProduksi->produksi_huskskin;
            $this->mucilage = $dataProduksi->produksi_mucilage;
            $this->is_bunch = $dataProduksi->is_bunch_press ? true : false;
        }
        $this->dataProduksi = $dataProduksi;
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
        return view('livewire.transaksi.form-input-produksi', compact('isPeriodeOpen'));
    }

    #[On('setDataProduksi')]
    public function setData($tanggal, $unit)
    {
        $this->cleanData();
        $this->periode = $tanggal;
        $this->unit = $unit;

        list($bulan, $tahun) = explode('/', $this->periode);
        $dataProduksi = MasterUnit::query()
            ->withProduksi($unit, $tahun, $bulan)
            ->first();
        if ($dataProduksi) {
            $this->idDataProduksi = $dataProduksi->id_produksi;
            $this->tbs = $dataProduksi->tbs_olah;
            $this->cangkang = $dataProduksi->produksi_cangkang;
            $this->fiber = $dataProduksi->produksi_fiber;
            $this->tankos = $dataProduksi->produksi_tankos;
            $this->abu_janjang = $dataProduksi->produksi_abu_janjang;
            $this->abu_boiler = $dataProduksi->produksi_abu_boiler;
            $this->solid = $dataProduksi->produksi_solid;
            $this->pome_oil = $dataProduksi->produksi_pome_oil;
            $this->pkm = $dataProduksi->produksi_pkm;
            $this->tea_waste = $dataProduksi->produksi_teawaste;
            $this->tunggul_karet = $dataProduksi->produksi_tunggulkaret;
            $this->limbah_serum = $dataProduksi->produksi_limbahserum;
            $this->abu = $dataProduksi->produksi_abu;
            $this->ranting = $dataProduksi->produksi_ranting;
            $this->kulit_buah = $dataProduksi->produksi_kulitbuah;
            $this->husk_skin = $dataProduksi->produksi_huskskin;
            $this->mucilage = $dataProduksi->produksi_mucilage;
            $this->is_bunch = $dataProduksi->is_bunch_press ? true : false;
        }
        $this->dataProduksi = $dataProduksi;
        $this->render();
    }

    public function cleanData()
    {
        $this->tbs = 0;
        $this->cangkang = 0;
        $this->fiber = 0;
        $this->tankos = 0;
        $this->abu_janjang = 0;
        $this->abu_boiler = 0;
        $this->solid = 0;
        $this->pome_oil = 0;
        $this->pkm = 0;
        $this->tea_waste = 0;
        $this->limbah_serum = 0; 
        $this->tunggul_karet = 0; 
        $this->abu = 0; 
        $this->ranting = 0; 
        $this->kulit_buah = 0; 
        $this->husk_skin = 0;
        $this->mucilage = 0;              
        $this->photo = null;
        $this->idDataProduksi = null;
        $this->is_bunch = false;
    }

    public function submit()
    {
        try {
            $this->tbs = str_replace('.', '', $this->tbs);
            $this->cangkang = str_replace('.', '', $this->cangkang);
            $this->fiber = str_replace('.', '', $this->fiber);
            $this->tankos = str_replace('.', '', $this->tankos);
            $this->abu_janjang = str_replace('.', '', $this->abu_janjang);
            $this->abu_boiler = str_replace('.', '', $this->abu_janjang);
            $this->solid = str_replace('.', '', $this->solid);
            $this->pome_oil = str_replace('.', '', $this->pome_oil);
            $this->pkm = str_replace('.', '', $this->pkm);
            $this->tea_waste = str_replace('.', '', $this->tea_waste);
            $this->limbah_serum = str_replace('.', '', $this->limbah_serum);
            $this->tunggul_karet = str_replace('.', '', $this->tunggul_karet);
            $this->abu = str_replace('.', '', $this->abu);
            $this->ranting = str_replace('.', '', $this->ranting);
            $this->kulit_buah = str_replace('.', '', $this->kulit_buah);
            $this->husk_skin = str_replace('.', '', $this->husk_skin);
            $this->mucilage = str_replace('.', '', $this->mucilage);

            $this->validate([
                'tbs' => 'required|numeric',
                'cangkang' => 'required|numeric',
                'fiber' => 'required|numeric',
                'tankos' => 'required|numeric',
                'abu_janjang' => 'required|numeric',
                'abu_boiler' => 'required|numeric',
                'solid' => 'required|numeric',
                'pome_oil' => 'required|numeric',
                'pkm' => 'required|numeric',
                'tea_waste' => 'required|numeric',
                'tunggul_karet' => 'required|numeric',
                'limbah_serum' => 'required|numeric',
                'abu' => 'required|numeric',
                'ranting' => 'required|numeric',
                'kulit_buah' => 'required|numeric',
                'husk_skin' => 'required|numeric',
                'mucilage' => 'required|numeric',                                                                
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'is_bunch' => 'required|boolean',
            ]);

            DB::transaction(function () {
                list($bulan, $tahun) = explode('/', $this->periode);
                $produksi = TransaksiProduksi::updateOrCreate(
                    [
                        'kode_unit' => $this->unit,
                        'tanggal' => Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('Y-m-d'),
                    ],
                    [
                        'uuid' => Str::uuid(),
                        'tbs_olah' => $this->tbs,
                        'produksi_cangkang' => $this->cangkang,
                        'produksi_fiber' => $this->fiber,
                        'produksi_tankos' => $this->tankos,
                        'produksi_abu_janjang' => $this->abu_janjang,
                        'produksi_abu_boiler' => $this->abu_boiler,
                        'produksi_solid' => $this->solid,
                        'produksi_pome_oil' => $this->pome_oil,
                        'produksi_pkm' => $this->pkm,
                        'produksi_teawaste' => $this->tea_waste,
                        'produksi_limbahserum' => $this->limbah_serum,
                        'produksi_tunggulkaret' => $this->tunggul_karet,                        
                        'produksi_abu' => $this->abu,                        
                        'produksi_ranting' => $this->ranting,
                        'produksi_kulitbuah' => $this->kulit_buah,
                        'produksi_huskskin' => $this->husk_skin,
                        'produksi_mucilage' => $this->mucilage,
                        'is_bunch_press' => $this->is_bunch,
                        'created_by' => auth()->user()->nik_sap,
                        'status_approval' => 0,
                    ]
                );

                TransaksiEvidence::create([
                    'uuid' => Str::uuid(),
                    'kode_unit' => $this->unit,
                    'id_transaksi' => $produksi->uuid,
                    'nama_file' => $this->photo->store('produksi', 'public'),
                    'kategori' => 'produksi',
                    'upload_by' => auth()->user()->nik_sap,
                ]);

                // $this->photo->storeAs('public/produksi', $this->dataProduksi->uuid.'.jpg');
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

    #[On('confirm')]
    public function confirm()
    {
        $this->submit();
    }

    #[On('saveEdit')]
    public function saveEdit($keterangan)
    {
        list($bulan, $tahun) = explode('/', $this->periode);
        $data = TransaksiProduksi::where('uuid', $this->idDataProduksi)->first();

        try {
            $this->tbs = str_replace('.', '', $this->tbs);
            $this->cangkang = str_replace('.', '', $this->cangkang);
            $this->fiber = str_replace('.', '', $this->fiber);
            $this->tankos = str_replace('.', '', $this->tankos);
            $this->abu_janjang = str_replace('.', '', $this->abu_janjang);
            $this->abu_boiler = str_replace('.', '', $this->abu_boiler);
            $this->solid = str_replace('.', '', $this->solid);
            $this->pome_oil = str_replace('.', '', $this->pome_oil);
            $this->pkm = str_replace('.', '', $this->pkm);
            $this->tea_waste = str_replace('.', '', $this->tea_waste);
            $this->limbah_serum = str_replace('.', '', $this->limbah_serum);
            $this->tunggul_karet = str_replace('.', '', $this->tunggul_karet);
            $this->abu = str_replace('.', '', $this->abu);
            $this->ranting = str_replace('.', '', $this->ranting);
            $this->kulit_buah = str_replace('.', '', $this->kulit_buah);
            $this->husk_skin = str_replace('.', '', $this->husk_skin);
            $this->mucilage = str_replace('.', '', $this->mucilage);

            $this->validate([
                'tbs' => 'required|numeric',
                'cangkang' => 'required|numeric',
                'fiber' => 'required|numeric',
                'tankos' => 'required|numeric',
                'abu_janjang' => 'required|numeric',
                'abu_boiler' => 'required|numeric',
                'solid' => 'required|numeric',
                'pome_oil' => 'required|numeric',
                'pkm' => 'required|numeric',
                'tea_waste' => 'required|numeric',
                'tunggul_karet' => 'required|numeric',
                'limbah_serum' => 'required|numeric',
                'abu' => 'required|numeric',
                'ranting' => 'required|numeric',
                'kulit_buah' => 'required|numeric',
                'husk_skin' => 'required|numeric',
                'mucilage' => 'required|numeric',                                                                
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'is_bunch' => 'required|boolean',
            ]);

            $input = [
                'tbs_olah' => $this->tbs,
                'produksi_cangkang' => $this->cangkang,
                'produksi_fiber' => $this->fiber,
                'produksi_tankos' => $this->tankos,
                'produksi_abu_janjang' => $this->abu_janjang,
                'produksi_abu_boiler' => $this->abu_boiler,
                'produksi_solid' => $this->solid,
                'produksi_pome_oil' => $this->pome_oil,
                'produksi_pkm' => $this->pkm,
                'produksi_teawaste' => $this->tea_waste,
                'produksi_limbahserum' => $this->limbah_serum,
                'produksi_tunggulkaret' => $this->tunggul_karet,                        
                'produksi_abu' => $this->abu,                        
                'produksi_ranting' => $this->ranting,
                'produksi_kulitbuah' => $this->kulit_buah,
                'produksi_huskskin' => $this->husk_skin,
                'produksi_mucilage' => $this->mucilage,
                'is_bunch_press' => $this->is_bunch,
            ];

            $dbData = $data->only(['tbs_olah', 'produksi_cangkang', 'produksi_fiber', 'produksi_tankos', 'produksi_abu_janjang', 'produksi_abu_boiler', 'produksi_solid', 'produksi_pome_oil', 'produksi_pkm', 'produksi_teawaste', 'produksi_limbahserum', 'produksi_tunggulkaret', 'produksi_abu', 'produksi_ranting', 'produksi_kulitbuah', 'produksi_huskskin', 'produksi_mucilage', 'is_bunch_press']);

            $changed = array_diff($input, $dbData);

            DB::transaction(function () use ($data, $changed, $input, $dbData, $keterangan) {
                if (!empty($changed)) {
                    $data->update([
                        'tbs_olah' => $this->tbs,
                        'produksi_cangkang' => $this->cangkang,
                        'produksi_fiber' => $this->fiber,
                        'produksi_tankos' => $this->tankos,
                        'produksi_abu_janjang' => $this->abu_janjang,
                        'produksi_abu_boiler' => $this->abu_boiler,
                        'produksi_solid' => $this->solid,
                        'produksi_pome_oil' => $this->pome_oil,
                        'produksi_pkm' => $this->pkm,
                        'produksi_teawaste' => $this->tea_waste,
                        'produksi_limbahserum' => $this->limbah_serum,
                        'produksi_tunggulkaret' => $this->tunggul_karet,                        
                        'produksi_abu' => $this->abu,                        
                        'produksi_ranting' => $this->ranting,
                        'produksi_kulitbuah' => $this->kulit_buah,
                        'produksi_huskskin' => $this->husk_skin,
                        'produksi_mucilage' => $this->mucilage,
                        'is_bunch_press' => $this->is_bunch,
                    ]);

                    foreach ($changed as $key => $change) {
                        LogTransaksi::create([
                            'uuid' => Str::uuid(),
                            'id_transaksi' => $data->uuid,
                            'kategori_transaksi' => $key,
                            'jenis_transaksi' => 'produksi',
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
                        'nama_file' => $this->photo->store('produksi', 'public'),
                        'kategori' => 'produksi',
                        'upload_by' => auth()->user()->nik_sap,
                    ]);

                    LogTransaksi::create([
                        'uuid' => Str::uuid(),
                        'id_transaksi' => $data->uuid,
                        'kategori_transaksi' => 'photo',
                        'jenis_transaksi' => 'produksi',
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
