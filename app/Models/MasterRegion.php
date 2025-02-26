<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRegion extends Model
{
    use HasFactory;
    protected $table = 'm_region';

    public function scopeWithAll($query)
    {
        return $query->select(
            'm_region.nama',
            DB::raw('SUM(t_stok.stok_cangkang) as stok_cangkang_awal_tahun'),
            DB::raw('SUM(t_stok.stok_fiber) as stok_fiber_awal_tahun'),
            DB::raw('SUM(t_stok.stok_tankos) as stok_tankos_awal_tahun'),
            DB::raw('SUM(t_stok.stok_abu_janjang) as stok_abu_janjang_awal_tahun'),
            DB::raw('SUM(t_stok.stok_solid) as stok_solid_awal_tahun'),
            DB::raw('SUM(t_stok.stok_pome_oil) as stok_pome_oil_awal_tahun'),
            DB::raw('SUM(t_stok.stok_pkm) as stok_pkm_awal_tahun'),
            //--------------------------------
            DB::raw('SUM(t_produksi.produksi_cangkang) as produksi_cangkang'),
            DB::raw('SUM(t_produksi.produksi_fiber) as produksi_fiber'),
            DB::raw('SUM(t_produksi.produksi_tankos) as produksi_tankos'),
            DB::raw('SUM(t_produksi.produksi_abu_janjang) as produksi_abu_janjang'),
            DB::raw('SUM(t_produksi.produksi_solid) as produksi_solid'),
            DB::raw('SUM(t_produksi.produksi_pome_oil) as produksi_pome_oil'),
            DB::raw('SUM(t_produksi.produksi_pkm) as produksi_pkm'),
            //--------------------------------
            DB::raw('SUM(t_cangkang.pendapatan) as pendapatan_cangkang'),
            DB::raw('SUM(t_fiber.pendapatan) as pendapatan_fiber'),
            DB::raw('SUM(t_tankos.pendapatan) as pendapatan_tankos'),
            DB::raw('SUM(t_abu_janjang.pendapatan) as pendapatan_abu_janjang'),
            DB::raw('SUM(t_solid.pendapatan) as pendapatan_solid'),
            DB::raw('SUM(t_pome.pendapatan) as pendapatan_pome_oil'),
            DB::raw('SUM(t_pkm.pendapatan) as pendapatan_pkm'),
            //--------------------------------
            DB::raw(
                'SUM((t_produksi.produksi_cangkang - COALESCE(t_cangkang.digunakan_u_bahan_bakar, 0) - COALESCE(t_cangkang.dikirim_ke_pabrik_teh, 0)
                    - COALESCE(t_cangkang.dikirim_ke_pabrik_karet, 0) - COALESCE(t_cangkang.dikirim_ke_pabrik_gula, 0) - COALESCE(t_cangkang.dikirim_ke_bibitan_kelapa_sawit, 0)
                    - COALESCE(t_cangkang.dikirim_ke_pks_lain, 0) - COALESCE(t_cangkang.volume_keperluan_lain, 0) - COALESCE(t_cangkang.dijual, 0))
                    + (t_stok.stok_cangkang + COALESCE(t_cangkang.diterima_dari_pks_lain, 0)) 
                    ) as sisa_cangkang'
            ),
            DB::raw(
                'SUM((t_produksi.produksi_fiber - COALESCE(t_fiber.digunakan_u_bahan_bakar, 0) - COALESCE(t_fiber.dikirim_ke_pabrik_teh, 0) - COALESCE(t_fiber.dikirim_ke_pabrik_karet, 0)
                    - COALESCE(t_fiber.dikirim_ke_pabrik_gula, 0) - COALESCE(t_fiber.dikirim_ke_bibitan_kelapa_sawit, 0) - COALESCE(t_fiber.dikirim_ke_pks_lain, 0)
                    - COALESCE(t_fiber.volume_keperluan_lain, 0) - COALESCE(t_fiber.dijual, 0)) + (t_stok.stok_fiber + COALESCE(t_fiber.diterima_dari_pks_lain, 0))) as sisa_fiber'
            ),
            DB::raw(
                'SUM((t_produksi.produksi_tankos + t_stok.stok_tankos - COALESCE(t_tankos.digunakan_sbg_pupuk_organik, 0) - COALESCE(t_tankos.dikembalikan_ke_pemasok, 0) 
                    - COALESCE(t_tankos.dibakar_di_tungku_bakar, 0) - COALESCE(t_tankos.volume_keperluan_lain, 0) - COALESCE(t_tankos.dijual, 0))) as sisa_tankos'
            ),
            DB::raw(
                'SUM((t_produksi.produksi_abu_janjang - COALESCE(t_abu_janjang.digunakan_sbg_pupuk_organik, 0) - COALESCE(t_abu_janjang.volume_keperluan_lain, 0) 
                    - COALESCE(t_abu_janjang.dijual, 0)) + (t_stok.stok_abu_janjang)) as sisa_abu_janjang'
            ),
            DB::raw(
                'SUM((t_produksi.produksi_solid + t_stok.stok_solid - COALESCE(t_solid.digunakan_sbg_pupuk_organik, 0) - COALESCE(t_solid.volume_keperluan_lain, 0) 
                    - COALESCE(t_solid.dijual, 0))) as sisa_solid'
            ),
            DB::raw(
                'SUM((t_pome.pome_oil_dikutip - COALESCE(t_pome.pome_oil_terkutip_diolah_kembali, 0) - COALESCE(t_pome.pome_oil_terkutip_dikirim_pks_lain, 0) 
                    - COALESCE(t_pome.pome_oil_terkutip_dijual, 0)) + (COALESCE(t_pome.diterima_dari_pks_lain, 0) + t_stok.stok_pome_oil)) as sisa_pome_oil'
            ),
            DB::raw(
                'SUM((t_produksi.produksi_pkm + t_stok.stok_pkm - COALESCE(t_pkm.dijual, 0) - COALESCE(t_pkm.volume_keperluan_lain, 0))) as sisa_pkm'
            ),
            //--------------------------------
            DB::raw('SUM(t_cangkang.diterima_dari_pks_lain) as cangkang_diterima_dari_pks_lain'),
            DB::raw('SUM(t_abu_janjang.diterima_dari_pks_lain) as abu_janjang_diterima_dari_pks_lain'),
            DB::raw('SUM(t_solid.diterima_dari_pks_lain) as solid_diterima_dari_pks_lain'),
            DB::raw('SUM(t_fiber.diterima_dari_pks_lain) as fiber_diterima_dari_pks_lain'),
            DB::raw('SUM(t_tankos.diterima_dari_pks_lain) as tankos_diterima_dari_pks_lain'),
            DB::raw('SUM(t_pome.diterima_dari_pks_lain) as pome_diterima_dari_pks_lain'),
            DB::raw('SUM(t_pkm.diterima_dari_pks_lain) as pkm_diterima_dari_pks_lain'),
            //--------------------------------
            DB::raw(
                'SUM(COALESCE(t_cangkang.digunakan_u_bahan_bakar, 0) + COALESCE(t_cangkang.dikirim_ke_pabrik_teh, 0)
                + COALESCE(t_cangkang.dikirim_ke_pabrik_karet, 0) + COALESCE(t_cangkang.dikirim_ke_pabrik_gula, 0) + COALESCE(t_cangkang.dikirim_ke_bibitan_kelapa_sawit, 0)
                + COALESCE(t_cangkang.dikirim_ke_pks_lain, 0) + COALESCE(t_cangkang.volume_keperluan_lain, 0) + COALESCE(t_cangkang.dijual, 0)) as cangkang_digunakan'
            ),
            DB::raw(
                'SUM(COALESCE(t_fiber.digunakan_u_bahan_bakar, 0) + COALESCE(t_fiber.dikirim_ke_pabrik_teh, 0) + COALESCE(t_fiber.dikirim_ke_pabrik_karet, 0)
                + COALESCE(t_fiber.dikirim_ke_pabrik_gula, 0) + COALESCE(t_fiber.dikirim_ke_bibitan_kelapa_sawit, 0) + COALESCE(t_fiber.dikirim_ke_pks_lain, 0)
                + COALESCE(t_fiber.volume_keperluan_lain, 0) + COALESCE(t_fiber.dijual, 0)) as fiber_digunakan'
            ),
            DB::raw(
                'SUM(COALESCE(t_tankos.digunakan_sbg_pupuk_organik, 0) + COALESCE(t_tankos.dikembalikan_ke_pemasok, 0) + COALESCE(t_tankos.dibakar_di_tungku_bakar, 0) 
                + COALESCE(t_tankos.volume_keperluan_lain, 0) + COALESCE(t_tankos.dijual, 0)) as tankos_digunakan'
            ),
            DB::raw(
                'SUM(COALESCE(t_abu_janjang.digunakan_sbg_pupuk_organik, 0) + COALESCE(t_abu_janjang.volume_keperluan_lain, 0) + COALESCE(t_abu_janjang.dijual, 0)) as abu_janjang_digunakan'
            ),
            DB::raw(
                'SUM(COALESCE(t_solid.digunakan_sbg_pupuk_organik, 0) + COALESCE(t_solid.volume_keperluan_lain, 0) + COALESCE(t_solid.dijual, 0)) as solid_digunakan'
            ),
            DB::raw(
                'SUM(COALESCE(t_pome.pome_oil_terkutip_diolah_kembali, 0) + COALESCE(t_pome.pome_oil_terkutip_dikirim_pks_lain, 0) + COALESCE(t_pome.pome_oil_terkutip_dijual, 0)) as pome_digunakan'
            ),
            DB::raw(
                'SUM(COALESCE(t_pkm.dijual, 0) + COALESCE(t_pkm.volume_keperluan_lain, 0)) as pkm_digunakan'
            )

        )
            ->leftJoin('m_unit', 'm_region.kode', '=', 'm_unit.kode_region')
            ->leftJoin('t_stok', 'm_unit.kode', '=', 't_stok.kode_unit')
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_cangkang', 't_produksi.uuid', '=', 't_cangkang.id_t_produksi')
            ->leftJoin('t_fiber', 't_produksi.uuid', '=', 't_fiber.id_t_produksi')
            ->leftJoin('t_tankos', 't_produksi.uuid', '=', 't_tankos.id_t_produksi')
            ->leftJoin('t_abu_janjang', 't_produksi.uuid', '=', 't_abu_janjang.id_t_produksi')
            ->leftJoin('t_solid', 't_produksi.uuid', '=', 't_solid.id_t_produksi')
            ->leftJoin('t_pome', 't_produksi.uuid', '=', 't_pome.id_t_produksi')
            ->leftJoin('t_pkm', 't_produksi.uuid', '=', 't_pkm.id_t_produksi')
            ->where('t_stok.tahun', date('Y'))
            ->groupBy('m_region.nama')
            ->orderBy('m_region.urutan', 'asc');
    }

    public function scopeWithMonitoring($query, $bulan, $tahun)
    {
        return $query->select(
            'm_region.nama as region',
            'm_region.urutan as urutan',
            'm_region.kode as kode_region',
            'm_unit.kode as kode_unit',
            'm_unit.nama_unit as unit',
            'm_unit.jenis_unit as jenis_unit',
            't_produksi.uuid as id_produksi',
            't_cangkang.uuid as id_cangkang',
            't_fiber.uuid as id_fiber',
            't_tankos.uuid as id_tankos',
            't_abu_janjang.uuid as id_abu_janjang',
            't_solid.uuid as id_solid',
            't_pome.uuid as id_pome',
            't_pkm.uuid as id_pkm',
            't_abu_boiler.uuid as id_abu_boiler',
        )
            ->leftJoin('m_unit', 'm_region.kode', '=', 'm_unit.kode_region')
            ->leftJoin('t_produksi', function ($join) use ($tahun, $bulan) {
                $join->on('m_unit.kode', '=', 't_produksi.kode_unit')
                    ->whereYear('t_produksi.tanggal', '=', $tahun)
                    ->whereMonth('t_produksi.tanggal', '=', $bulan);
            })
            ->leftJoin('t_cangkang', 't_produksi.uuid', '=', 't_cangkang.id_t_produksi')
            ->leftJoin('t_fiber', 't_produksi.uuid', '=', 't_fiber.id_t_produksi')
            ->leftJoin('t_tankos', 't_produksi.uuid', '=', 't_tankos.id_t_produksi')
            ->leftJoin('t_abu_janjang', 't_produksi.uuid', '=', 't_abu_janjang.id_t_produksi')
            ->leftJoin('t_abu_boiler', 't_produksi.uuid', '=', 't_abu_boiler.id_t_produksi')
            ->leftJoin('t_solid', 't_produksi.uuid', '=', 't_solid.id_t_produksi')
            ->leftJoin('t_pome', 't_produksi.uuid', '=', 't_pome.id_t_produksi')
            ->leftJoin('t_pkm', 't_produksi.uuid', '=', 't_pkm.id_t_produksi')
            ->where(function ($query) {
                $query->where('m_unit.jenis_unit', 'PKS')
                    ->orWhere('m_unit.jenis_unit', 'PPIS');
            })
            ->where('m_unit.is_active', 1);
    }

    public function scopeWithN1($query)
    {
        return $query->select(
            'm_region.nama',
            DB::raw('SUM(t_stok.stok_tea_waste) as stok_tea_waste_awal_tahun'),
            DB::raw('SUM(t_stok.stok_limbah_serum) as stok_limbah_serum_awal_tahun'),
            DB::raw('SUM(t_stok.stok_tunggul_karet) as stok_tunggul_karet_awal_tahun'),
            DB::raw('SUM(t_stok.stok_abu) as stok_abu_awal_tahun'),
            DB::raw('SUM(t_stok.stok_ranting) as stok_ranting_awal_tahun'),
            DB::raw('SUM(t_stok.stok_batang_kayu) as stok_batang_kayu_awal_tahun'),
            DB::raw('SUM(t_stok.stok_kulit_buah) as stok_kulit_buah_awal_tahun'),
            DB::raw('SUM(t_stok.stok_husk_skin) as stok_husk_skin_awal_tahun'),
            DB::raw('SUM(t_stok.stok_mucilage) as stok_mucilage_awal_tahun'),
            //--------------------------------
            DB::raw('SUM(t_produksi_n1.produksi_teawaaste) as produksi_tea_waste'),
            DB::raw('SUM(t_produksi_n1.produksi_limbahserum) as produksi_limbah_serum'),
            DB::raw('SUM(t_produksi_n1.produksi_tunggulkaret) as produksi_tunggul_karet'),
            DB::raw('SUM(t_produksi_n1.produksi_abu) as produksi_abu_abu'),
            DB::raw('SUM(t_produksi_n1.produksi_ranting) as produksi_ranting'),
            DB::raw('SUM(t_produksi_n1.produksi_batangkayu) as produksi_batang_kayu'),            
            DB::raw('SUM(t_produksi_n1.produksi_kulitbuah) as produksi_kulit_buah'),
            DB::raw('SUM(t_produksi_n1.produksi_huskskin) as produksi_husk_skin'),
            DB::raw('SUM(t_produksi_n1.produksi_mucilage) as produksi_mucilage'),
            //--------------------------------
            DB::raw('SUM(t_tea_waste.pendapatan) as pendapatan_tea_waste'),
            DB::raw('SUM(t_limbah_serum.pendapatan) as pendapatan_limbah_serum'),
            DB::raw('SUM(t_tunggul_karet.pendapatan) as pendapatan_tunggul_karet'),
            DB::raw('SUM(t_abu.pendapatan) as pendapatan_abu'),
            DB::raw('SUM(t_ranting.pendapatan) as pendapatan_ranting'),
            DB::raw('SUM(t_batang_kayu.pendapatan) as pendapatan_batang_kayu'),            
            DB::raw('SUM(t_kulit_buah.pendapatan) as pendapatan_kulit_buah'),
            DB::raw('SUM(t_husk_skin.pendapatan) as pendapatan_husk_skin'),
            DB::raw('SUM(t_mucilage.pendapatan) as pendapatan_mucilage'),
            //--------------------------------
            DB::raw(
                'SUM((t_produksi_n1.produksi_teawaste 
                    - COALESCE(t_tea_waste.digunakan, 0) 
                    - COALESCE(t_tea_waste.dikirim, 0) 
                    - COALESCE(t_tea_waste.volume_keperluan_lain, 0) 
                    - COALESCE(t_tea_waste.dijual, 0))
                    + (t_stok.stok_teawaste) 
                    ) as sisa_tea_waste'
            ),

            DB::raw(
                'SUM((t_produksi_n1.produksi_limbahserum 
                    - COALESCE(t_limbah_serum.digunakan, 0) 
                    - COALESCE(t_limbah_serum.dikirim, 0) 
                    - COALESCE(t_limbah_serum.volume_keperluan_lain, 0) 
                    - COALESCE(t_limbah_serum.dijual, 0))
                    + (t_stok.stok_limbah_serum) 
                    ) as sisa_limbah_serum'
            ),

            DB::raw(
                'SUM((t_produksi_n1.produksi_tunggulkaret 
                    - COALESCE(t_tunggul_karet.digunakan, 0) 
                    - COALESCE(t_tunggul_karet.dikirim, 0) 
                    - COALESCE(t_tunggul_karet.volume_keperluan_lain, 0) 
                    - COALESCE(t_tunggul_karet.dijual, 0))
                    + (t_stok.stok_tunggul_karet) 
                    ) as sisa_tunggul_karet'
            ),

            DB::raw(
                'SUM((t_produksi_n1.produksi_abu 
                    - COALESCE(t_abu.digunakan, 0) 
                    - COALESCE(t_abu.dikirim, 0) 
                    - COALESCE(t_abu.volume_keperluan_lain, 0) 
                    - COALESCE(t_abu.dijual, 0))
                    + (t_stok.stok_abu) 
                    ) as sisa_abu'
            ),

            DB::raw(
                'SUM((t_produksi_n1.produksi_ranting 
                    - COALESCE(t_ranting.digunakan, 0) 
                    - COALESCE(t_ranting.dikirim, 0) 
                    - COALESCE(t_ranting.volume_keperluan_lain, 0) 
                    - COALESCE(t_ranting.dijual, 0))
                    + (t_stok.stok_ranting) 
                    ) as sisa_ranting'
            ),

            DB::raw(
                'SUM((t_produksi_n1.produksi_batangkayu 
                    - COALESCE(t_batang_kayu.digunakan, 0) 
                    - COALESCE(t_batang_kayu.dikirim, 0) 
                    - COALESCE(t_batang_kayu.volume_keperluan_lain, 0) 
                    - COALESCE(t_batang_kayu.dijual, 0))
                    + (t_stok.stok_batang_kayu) 
                    ) as sisa_batang_kayu'
            ),

            DB::raw(
                'SUM((t_produksi_n1.produksi_kulitbuah 
                    - COALESCE(t_kulit_buah.digunakan, 0) 
                    - COALESCE(t_kulit_buah.dikirim, 0) 
                    - COALESCE(t_kulit_buah.volume_keperluan_lain, 0) 
                    - COALESCE(t_kulit_buah.dijual, 0))
                    + (t_stok.stok_kulit_buah) 
                    ) as sisa_kulit_buah'
            ),

            DB::raw(
                'SUM((t_produksi_n1.produksi_huskskin 
                    - COALESCE(t_husk_skin.digunakan, 0) 
                    - COALESCE(t_husk_skin.dikirim, 0) 
                    - COALESCE(t_husk_skin.volume_keperluan_lain, 0) 
                    - COALESCE(t_husk_skin.dijual, 0))
                    + (t_stok.stok_husk_skin) 
                    ) as sisa_husk_skin'
            ),

            DB::raw(
                'SUM((t_produksi_n1.produksi_mucilage 
                    - COALESCE(t_mucilage.digunakan, 0) 
                    - COALESCE(t_mucilage.dikirim, 0) 
                    - COALESCE(t_mucilage.volume_keperluan_lain, 0) 
                    - COALESCE(t_mucilage.dijual, 0))
                    + (t_stok.stok_mucilage) 
                    ) as sisa_mucilage'
            ),

            //--------------------------------
            // DB::raw('SUM(t_cangkang.diterima_dari_pks_lain) as cangkang_diterima_dari_pks_lain'),
            // DB::raw('SUM(t_abu_janjang.diterima_dari_pks_lain) as abu_janjang_diterima_dari_pks_lain'),
            // DB::raw('SUM(t_solid.diterima_dari_pks_lain) as solid_diterima_dari_pks_lain'),
            // DB::raw('SUM(t_fiber.diterima_dari_pks_lain) as fiber_diterima_dari_pks_lain'),
            // DB::raw('SUM(t_tankos.diterima_dari_pks_lain) as tankos_diterima_dari_pks_lain'),
            // DB::raw('SUM(t_pome.diterima_dari_pks_lain) as pome_diterima_dari_pks_lain'),
            // DB::raw('SUM(t_pkm.diterima_dari_pks_lain) as pkm_diterima_dari_pks_lain'),
            //--------------------------------

            DB::raw(
                'SUM(COALESCE(t_tea_waste.digunakan, 0) 
                    + COALESCE(t_tea_waste.dikirim, 0) 
                    + COALESCE(t_tea_waste.volume_keperluan_lain, 0) 
                    + COALESCE(t_tea_waste.dijual, 0)
                    ) as tea_waste_digunakan'
            ),

            DB::raw(
                'SUM( COALESCE(t_limbah_serum.digunakan, 0) 
                    + COALESCE(t_limbah_serum.dikirim, 0) 
                    + COALESCE(t_limbah_serum.volume_keperluan_lain, 0) 
                    + COALESCE(t_limbah_serum.dijual, 0))
                    + (t_stok.stok_limbah_serum) 
                    ) as limbah_serum_digunakan'
            ),

            DB::raw(
                'SUM( COALESCE(t_tunggul_karet.digunakan, 0) 
                    + COALESCE(t_tunggul_karet.dikirim, 0) 
                    + COALESCE(t_tunggul_karet.volume_keperluan_lain, 0) 
                    + COALESCE(t_tunggul_karet.dijual, 0))
                    + (t_stok.stok_tunggul_karet) 
                    ) as tunggul_karet_digunakan'
            ),

            DB::raw(
                'SUM( COALESCE(t_abu.digunakan, 0) 
                    + COALESCE(t_abu.dikirim, 0) 
                    + COALESCE(t_abu.volume_keperluan_lain, 0) 
                    + COALESCE(t_abu.dijual, 0))
                    + (t_stok.stok_abu) 
                    ) as abu_digunakan'
            ),

            DB::raw(
                'SUM( COALESCE(t_ranting.digunakan, 0) 
                    + COALESCE(t_ranting.dikirim, 0) 
                    + COALESCE(t_ranting.volume_keperluan_lain, 0) 
                    + COALESCE(t_ranting.dijual, 0))
                    + (t_stok.stok_ranting) 
                    ) as ranting_digunakan'
            ),

            DB::raw(
                'SUM( COALESCE(t_batang_kayu.digunakan, 0) 
                    + COALESCE(t_batang_kayu.dikirim, 0) 
                    + COALESCE(t_batang_kayu.volume_keperluan_lain, 0) 
                    + COALESCE(t_batang_kayu.dijual, 0))
                    + (t_stok.stok_batang_kayu) 
                    ) as batang_kayu_digunakan'
            ),

            DB::raw(
                'SUM( COALESCE(t_kulit_buah.digunakan, 0) 
                    + COALESCE(t_kulit_buah.dikirim, 0) 
                    + COALESCE(t_kulit_buah.volume_keperluan_lain, 0) 
                    + COALESCE(t_kulit_buah.dijual, 0))
                    + (t_stok.stok_kulit_buah) 
                    ) as kulit_buah_digunakan'
            ),

            DB::raw(
                'SUM( COALESCE(t_husk_skin.digunakan, 0) 
                    + COALESCE(t_husk_skin.dikirim, 0) 
                    + COALESCE(t_husk_skin.volume_keperluan_lain, 0) 
                    + COALESCE(t_husk_skin.dijual, 0))
                    + (t_stok.stok_husk_skin) 
                    ) as husk_skin_digunakan'
            ),

            DB::raw(
                'SUM( COALESCE(t_mucilage.digunakan, 0) 
                    + COALESCE(t_mucilage.dikirim, 0) 
                    + COALESCE(t_mucilage.volume_keperluan_lain, 0) 
                    + COALESCE(t_mucilage.dijual, 0))
                    + (t_stok.stok_mucilage) 
                    ) as mucilage_digunakan'
            )
        )
            ->leftJoin('m_unit_n1', 'm_region.kode', '=', 'm_unit_n1.kode_region')
            ->leftJoin('t_stok', 'm_unit_n1.kode', '=', 't_stok.kode_unit')
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_tea_waste', 't_produksi_n1.uuid', '=', 't_tea_waste.id_t_produksi')
            ->leftJoin('t_limbah_serum', 't_produksi_n1.uuid', '=', 't_limbah_serum.id_t_produksi')
            ->leftJoin('t_tunggul_karet', 't_produksi_n1.uuid', '=', 't_tunggul_karet.id_t_produksi')
            ->leftJoin('t_abu', 't_produksi_n1.uuid', '=', 't_abu.id_t_produksi')
            ->leftJoin('t_ranting', 't_produksi_n1.uuid', '=', 't_ranting.id_t_produksi')
            ->leftJoin('t_batang_kayu', 't_produksi_n1.uuid', '=', 't_batang_kayu.id_t_produksi')
            ->leftJoin('t_kulit_buah', 't_produksi_n1.uuid', '=', 't_kulit_buah.id_t_produksi')
            ->leftJoin('t_husk_skin', 't_produksi_n1.uuid', '=', 't_husk_skin.id_t_produksi')
            ->leftJoin('t_mucilage', 't_produksi_n1.uuid', '=', 't_mucilage.id_t_produksi')            
            ->where('t_stok.tahun', date('Y'))
            ->groupBy('m_region.nama')
            ->orderBy('m_region.urutan', 'asc');
    }

    public function scopeWithMonitoringN1($query, $bulan, $tahun)
    {
        return $query->select(
            'm_region.nama as region',
            'm_region.urutan as urutan',
            'm_region.kode as kode_region',
            'm_unit_n1.kode as kode_unit',
            'm_unit_n1.nama_unit as unit',
            'm_unit_n1.jenis_unit as jenis_unit',
            't_produksi_n1.uuid as id_produksi_n1',
            't_tea_waste.uuid as id_tea_waste',
            't_limbah_serum.uuid as id_limbah_serum',
            't_tunggul_karet.uuid as id_tunggul_karet',
            't_abu.uuid as id_abu',
            't_ranting.uuid as id_ranting',
            't_batang_kayu.uuid as id_batang_kayu',
            't_kulit_buah.uuid as id_kulit_buah',
            't_husk_skin.uuid as id_husk_skin',
            't_mucilage.uuid as id_mucilage'
        )
            ->leftJoin('m_unit_n1', 'm_region.kode', '=', 'm_unit_n1.kode_region')
            ->leftJoin('t_produksi_n1', function ($join) use ($tahun, $bulan) {
                $join->on('m_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
                    ->whereYear('t_produksi_n1.tanggal', '=', $tahun)
                    ->whereMonth('t_produksi_n1.tanggal', '=', $bulan);
            })
            ->leftJoin('t_tea_waste', 't_produksi_n1.uuid', '=', 't_tea_waste.id_t_produksi')
            ->leftJoin('t_limbah_serum', 't_produksi_n1.uuid', '=', 't_limbah_serum.id_t_produksi')
            ->leftJoin('t_tunggul_karet', 't_produksi_n1.uuid', '=', 't_tunggul_karet.id_t_produksi')
            ->leftJoin('t_abu', 't_produksi_n1.uuid', '=', 't_abu.id_t_produksi')
            ->leftJoin('t_ranting', 't_produksi_n1.uuid', '=', 't_ranting.id_t_produksi')
            ->leftJoin('t_batang_kayu', 't_produksi_n1.uuid', '=', 't_batang_kayu.id_t_produksi')            
            ->leftJoin('t_kulit_buah', 't_produksi_n1.uuid', '=', 't_kulit_buah.id_t_produksi')
            ->leftJoin('t_husk_skin', 't_produksi_n1.uuid', '=', 't_husk_skin.id_t_produksi')
            ->leftJoin('t_mucilage', 't_produksi_n1.uuid', '=', 't_mucilage.id_t_produksi')            
            ->where(function ($query) {
                $query->where('m_unit_n1.jenis_unit', 'TEH')
                    ->orWhere('m_unit_n1.jenis_unit', 'KARET')
                    ->orWhere('m_unit_n1.jenis_unit', 'KOPI')
                    ;
            })
            ->where('m_unit_n1.is_active', 1);
    }


}
