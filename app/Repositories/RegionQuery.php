<?php

namespace App\Repositories;

use App\Models\MasterRegion;
use DB;

class RegionQuery
{
    public function getRegionWithAllData()
    {
        $query = MasterRegion::query()
            ->select(
                'm_region.nama',
                'm_region.urutan',
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
                DB::raw('SUM(t_cangkang.dijual * t_cangkang.harga_jual_rata_rata) as pendapatan_cangkang'),
                DB::raw('SUM(t_fiber.dijual * t_fiber.harga_jual_rata_rata) as pendapatan_fiber'),
                DB::raw('SUM(t_tankos.dijual * t_tankos.harga_jual_rata_rata) as pendapatan_tankos'),
                DB::raw('SUM(t_abu_janjang.dijual * t_abu_janjang.harga_jual_rata_rata) as pendapatan_abu_janjang'),
                DB::raw('SUM(t_solid.dijual * t_solid.harga_jual_rata_rata) as pendapatan_solid'),
                DB::raw('SUM(t_pome.pome_oil_terkutip_dijual * t_pome.harga_jual_rata_rata) as pendapatan_pome_oil'),
                DB::raw('SUM(t_pkm.dijual * t_pkm.harga_jual_rata_rata) as pendapatan_pkm'),
                //--------------------------------
                DB::raw('SUM(t_cangkang.dijual) as penjualan_cangkang'),
                DB::raw('SUM(t_fiber.dijual) as penjualan_fiber'),
                DB::raw('SUM(t_tankos.dijual) as penjualan_tankos'),
                DB::raw('SUM(t_abu_janjang.dijual) as penjualan_abu_janjang'),
                DB::raw('SUM(t_solid.dijual) as penjualan_solid'),
                DB::raw('SUM(t_pome.pome_oil_terkutip_dijual) as penjualan_pome_oil'),
                DB::raw('SUM(t_pkm.dijual) as penjualan_pkm'),
                // -------------------------------
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
            ->groupBy(
                'm_region.nama',
                'm_region.urutan'
            )
            ->orderBy('m_region.urutan')
            ->get();

        return $query;
    }
}