<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterUnit extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'm_unit';
    protected $primaryKey = 'kode';

    public function transaksiStok()
    {
        return $this->hasMany(TransaksiStok::class, 'kode_unit');
    }

    public function scopeWithCangkangSum($query)
    {
        $query->select(
            'm_unit.nama_unit',
            't_stok.stok_cangkang',
            't_produksi.produksi_cangkang',
            'm_region.nama as region',
            DB::raw('SUM(t_cangkang.digunakan_u_bahan_bakar) as digunakan_u_bahan_bakar'),
            DB::raw('SUM(t_cangkang.dikirim_ke_pabrik_teh) as dikirim_ke_pabrik_teh'),
            DB::raw('SUM(t_cangkang.dikirim_ke_pabrik_karet) as dikirim_ke_pabrik_karet'),
            DB::raw('SUM(t_cangkang.dikirim_ke_pabrik_gula) as dikirim_ke_pabrik_gula'),
            DB::raw('SUM(t_cangkang.dikirim_ke_bibitan_kelapa_sawit) as dikirim_ke_bibitan_kelapa_sawit'),
            DB::raw('SUM(t_cangkang.dikirim_ke_pks_lain) as dikirim_ke_pks_lain'),
            DB::raw('SUM(t_cangkang.volume_keperluan_lain) as volume_keperluan_lain'),
            DB::raw('SUM(t_cangkang.dijual) as dijual'),
            DB::raw('SUM(t_cangkang.diterima_dari_pks_lain) as diterima_dari_pks_lain'),
        )
            ->where('m_unit.jenis_unit', 'PKS')
            ->where('t_stok.tahun', date('Y'))
            ->leftJoin('t_stok', 'm_unit.kode', '=', 't_stok.kode_unit')
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_cangkang', 't_produksi.uuid', '=', 't_cangkang.id_t_produksi')
            ->leftJoin('m_region', 'm_unit.kode_region', '=', 'm_region.kode')
            ->groupBy(
                'm_unit.kode',
                'm_unit.nama_unit',
                't_stok.stok_cangkang',
                't_produksi.produksi_cangkang',
                'm_region.nama'
            );
        return $query;
    }

    public function scopeWithCangkang($query, $bulan, $tahun, $bi = false)
    {
        $query->select(
            'm_unit.nama_unit',
            'm_unit.kode as kode_unit',
            't_stok.stok_cangkang',
            't_produksi.uuid as id_produksi',
            'm_region.nama as region',
            'm_region.urutan',
            DB::raw('(SELECT keterangan_keperluan_lain FROM t_cangkang WHERE t_cangkang.id_t_produksi = t_produksi.uuid LIMIT 1) as keterangan_keperluan_lain'),
            DB::raw('CASE WHEN EXISTS (
                        SELECT 1 
                        FROM t_log_transaksi 
                        WHERE 
                            kode_unit = m_unit.kode 
                            AND YEAR(tanggal) = '.$tahun.' AND MONTH(tanggal) <= '.$bulan.'
                    ) THEN true ELSE false END as has_log'),
            DB::raw('SUM(t_produksi.produksi_cangkang) as produksi_cangkang'),
            DB::raw('SUM(t_produksi.tbs_olah) as tbs_olah'),
            DB::raw('SUM(t_cangkang.digunakan_u_bahan_bakar) as digunakan_u_bahan_bakar'),
            DB::raw('SUM(t_cangkang.dikirim_ke_pabrik_teh) as dikirim_ke_pabrik_teh'),
            DB::raw('SUM(t_cangkang.dikirim_ke_pabrik_karet) as dikirim_ke_pabrik_karet'),
            DB::raw('SUM(t_cangkang.dikirim_ke_pabrik_gula) as dikirim_ke_pabrik_gula'),
            DB::raw('SUM(t_cangkang.dikirim_ke_bibitan_kelapa_sawit) as dikirim_ke_bibitan_kelapa_sawit'),
            DB::raw('SUM(t_cangkang.dikirim_ke_pks_lain) as dikirim_ke_pks_lain'),
            DB::raw('SUM(t_cangkang.volume_keperluan_lain) as volume_keperluan_lain'),
            DB::raw('SUM(t_cangkang.dijual) as dijual'),
            DB::raw('SUM(t_cangkang.harga_jual_rata_rata) as harga_jual_rata_rata'),
            DB::raw('SUM(t_cangkang.diterima_dari_pks_lain) as diterima_dari_pks_lain'),
            // --------------------------------
            DB::raw('SUM(t_cangkang.dijual * t_cangkang.harga_jual_rata_rata) as pendapatan'),
            DB::raw(
                'SUM((t_produksi.produksi_cangkang - COALESCE(t_cangkang.digunakan_u_bahan_bakar, 0) - COALESCE(t_cangkang.dikirim_ke_pabrik_teh, 0)
                    - COALESCE(t_cangkang.dikirim_ke_pabrik_karet, 0) - COALESCE(t_cangkang.dikirim_ke_pabrik_gula, 0) - COALESCE(t_cangkang.dikirim_ke_bibitan_kelapa_sawit, 0)
                    - COALESCE(t_cangkang.dikirim_ke_pks_lain, 0) - COALESCE(t_cangkang.volume_keperluan_lain, 0) - COALESCE(t_cangkang.dijual, 0))
                    + (t_stok.stok_cangkang + COALESCE(t_cangkang.diterima_dari_pks_lain, 0)) 
                    ) as sisa_stok_akhir'
            ),
            DB::raw('SUM(COALESCE((t_produksi.produksi_cangkang - COALESCE(t_cangkang.digunakan_u_bahan_bakar, 0)) / NULLIF(t_produksi.produksi_cangkang, 0) * 100, 0)) as persen_ekses_cangkang'),
            DB::raw('SUM(COALESCE((t_produksi.produksi_cangkang - COALESCE(t_cangkang.digunakan_u_bahan_bakar, 0)) / NULLIF(t_produksi.tbs_olah, 0) * 100, 0)) as material_balance'),

        )
            ->leftJoin('t_stok', 'm_unit.kode', '=', 't_stok.kode_unit')
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_cangkang', 't_produksi.uuid', '=', 't_cangkang.id_t_produksi')
            ->leftJoin('m_region', 'm_unit.kode_region', '=', 'm_region.kode')
            ->where('m_unit.jenis_unit', 'PKS')
            ->whereNotNull('t_cangkang.id_t_produksi');

        if ($bi) {
            $query->whereYear('t_produksi.tanggal', '=', $tahun)
                ->whereMonth('t_produksi.tanggal', '=', $bulan);
        } else {
            $query->whereYear('t_produksi.tanggal', '>=', $tahun)
                ->whereMonth('t_produksi.tanggal', '<=', $bulan);
        }

        $query->groupBy(
            'm_unit.nama_unit',
            'm_unit.kode',
            'm_region.nama',
            't_stok.stok_cangkang',
            't_produksi.uuid',
            'keterangan_keperluan_lain',
            'm_region.urutan'
        )->orderBy('m_region.urutan', 'asc');

        return $query;
    }

    public function scopeWithFiber($query)
    {
        $query->select(
            'm_unit.nama_unit',
            't_stok.stok_cangkang',
            't_produksi.*',
            't_fiber.*',
        )
            ->where('m_unit.jenis_unit', 'PKS')
            ->where('t_stok.tahun', date('Y'))
            ->leftJoin('t_stok', 'm_unit.kode', '=', 't_stok.kode_unit')
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_fiber', 't_produksi.uuid', '=', 't_fiber.id_t_produksi');

        return $query;
    }

    public function scopeWithProduksi($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit.*',
            't_produksi.*',
            't_evidence.*',
            't_produksi.uuid as id_produksi',
            't_produksi.is_bunch_press as is_bunch_press',
        )
            ->where('m_unit.kode', $kodeUnit)
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_evidence', 't_produksi.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithCangkang($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit.*',
            't_produksi.uuid as id_produksi',
            't_produksi.tbs_olah',
            't_produksi.produksi_cangkang',
            't_cangkang.*',
            't_evidence.*',
            't_cangkang.uuid as id_cangkang',
        )
            ->where('m_unit.kode', $kodeUnit)
            ->whereYear('t_produksi.tanggal', $tahun)
            ->whereMonth('t_produksi.tanggal', $bulan)
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_cangkang', 't_produksi.uuid', '=', 't_cangkang.id_t_produksi')
            ->leftJoin('t_evidence', 't_cangkang.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithFiber($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit.*',
            't_produksi.uuid as id_produksi',
            't_produksi.tbs_olah',
            't_produksi.produksi_fiber',
            't_fiber.uuid as id_fiber',
            't_fiber.*',
            't_evidence.*',
        )
            ->where('m_unit.kode', $kodeUnit)
            ->whereYear('t_produksi.tanggal', $tahun)
            ->whereMonth('t_produksi.tanggal', $bulan)
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_fiber', 't_produksi.uuid', '=', 't_fiber.id_t_produksi')
            ->leftJoin('t_evidence', 't_fiber.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithTankos($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit.*',
            't_produksi.uuid as id_produksi',
            't_produksi.tbs_olah',
            't_produksi.produksi_tankos',
            't_tankos.uuid as id_tankos',
            't_tankos.*',
            't_evidence.*',
        )
            ->where('m_unit.kode', $kodeUnit)
            ->whereYear('t_produksi.tanggal', $tahun)
            ->whereMonth('t_produksi.tanggal', $bulan)
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_tankos', 't_produksi.uuid', '=', 't_tankos.id_t_produksi')
            ->leftJoin('t_evidence', 't_tankos.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithAbuJanjang($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit.*',
            't_produksi.uuid as id_produksi',
            't_produksi.tbs_olah',
            't_produksi.produksi_abu_janjang',
            't_abu_janjang.uuid as id_abu_janjang',
            't_abu_janjang.*',
            't_evidence.*',
        )
            ->where('m_unit.kode', $kodeUnit)
            ->whereYear('t_produksi.tanggal', $tahun)
            ->whereMonth('t_produksi.tanggal', $bulan)
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_abu_janjang', 't_produksi.uuid', '=', 't_abu_janjang.id_t_produksi')
            ->leftJoin('t_evidence', 't_abu_janjang.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithSolid($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit.*',
            't_produksi.uuid as id_produksi',
            't_produksi.tbs_olah',
            't_produksi.produksi_solid',
            't_solid.uuid as id_solid',
            't_solid.*',
            't_evidence.*',
        )
            ->where('m_unit.kode', $kodeUnit)
            ->whereYear('t_produksi.tanggal', $tahun)
            ->whereMonth('t_produksi.tanggal', $bulan)
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_solid', 't_produksi.uuid', '=', 't_solid.id_t_produksi')
            ->leftJoin('t_evidence', 't_solid.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithPomeOil($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit.*',
            't_produksi.uuid as id_produksi',
            't_produksi.tbs_olah',
            't_produksi.produksi_pome_oil',
            't_pome.uuid as id_pome',
            't_pome.*',
            't_evidence.*',
        )
            ->where('m_unit.kode', $kodeUnit)
            ->whereYear('t_produksi.tanggal', $tahun)
            ->whereMonth('t_produksi.tanggal', $bulan)
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_pome', 't_produksi.uuid', '=', 't_pome.id_t_produksi')
            ->leftJoin('t_evidence', 't_pome.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithPkm($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit.*',
            't_produksi.uuid as id_produksi',
            't_produksi.tbs_olah',
            't_produksi.produksi_pkm',
            't_pkm.uuid as id_pkm',
            't_pkm.*',
            't_evidence.*',
        )
            ->where('m_unit.kode', $kodeUnit)
            ->where('m_unit.jenis_unit', 'PPIS')
            ->whereYear('t_produksi.tanggal', $tahun)
            ->whereMonth('t_produksi.tanggal', $bulan)
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_pkm', 't_produksi.uuid', '=', 't_pkm.id_t_produksi')
            ->leftJoin('t_evidence', 't_pkm.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeMonitoringDetail($query, $id, $tipe)
    {
        return $query->select(
            'm_unit.kode as kode_unit',
            'm_unit.nama_unit as unit',
            $tipe.'.*'
        )
            ->where($tipe.'.uuid', $id)
            ->leftJoin($tipe, 'm_unit.kode', '=', $tipe.'.kode_unit');
    }

    public function scopeWithDetailItem($query, $bulan, $tahun, $bi = false, $tipe)
    {
        $query->select(
            'm_unit.nama_unit',
            'm_unit.kode as kode_unit',
            't_stok.stok_'.$tipe,
            't_produksi.uuid as id_produksi',
            'm_region.nama as region',
            'm_region.urutan',
            DB::raw('(SELECT keterangan_keperluan_lain FROM t_'.$tipe.' WHERE t_'.$tipe.'.id_t_produksi = t_produksi.uuid LIMIT 1) as keterangan_keperluan_lain'),
            DB::raw('CASE WHEN EXISTS (
                        SELECT 1 
                        FROM t_log_transaksi 
                        WHERE 
                            kode_unit = m_unit.kode 
                            AND YEAR(tanggal) = '.$tahun.' AND MONTH(tanggal) <= '.$bulan.'
                    ) THEN true ELSE false END as has_log'),
            DB::raw('SUM(t_produksi.produksi_'.$tipe.') as produksi_'.$tipe),
            DB::raw('SUM(t_produksi.tbs_olah) as tbs_olah'),
            DB::raw('SUM(t_'.$tipe.'.digunakan_u_bahan_bakar) as digunakan_u_bahan_bakar'),
            DB::raw('SUM(t_'.$tipe.'.digunakan) as digunakan'),
            DB::raw('SUM(t_'.$tipe.'.dikirim) as dikirim'),
            DB::raw('SUM(t_'.$tipe.'.dikirim_ke_pabrik_teh) as dikirim_ke_pabrik_teh'),
            DB::raw('SUM(t_'.$tipe.'.dikirim_ke_pabrik_karet) as dikirim_ke_pabrik_karet'),
            DB::raw('SUM(t_'.$tipe.'.dikirim_ke_pabrik_gula) as dikirim_ke_pabrik_gula'),
            DB::raw('SUM(t_'.$tipe.'.dikirim_ke_bibitan_kelapa_sawit) as dikirim_ke_bibitan_kelapa_sawit'),
            DB::raw('SUM(t_'.$tipe.'.dikirim_ke_pks_lain) as dikirim_ke_pks_lain'),
            DB::raw('SUM(t_'.$tipe.'.volume_keperluan_lain) as volume_keperluan_lain'),
            DB::raw('SUM(t_'.$tipe.'.dijual) as dijual'),
            DB::raw('SUM(t_'.$tipe.'.harga_jual_rata_rata) as harga_jual_rata_rata'),
            DB::raw('SUM(t_'.$tipe.'.diterima_dari_pks_lain) as diterima_dari_pks_lain'),
            // --------------------------------
            DB::raw('SUM(t_'.$tipe.'.dijual * t_'.$tipe.'.harga_jual_rata_rata) as pendapatan'),
            DB::raw(
                'SUM((t_produksi.produksi_'.$tipe.' - COALESCE(t_'.$tipe.'.digunakan_u_bahan_bakar, 0) - COALESCE(t_'.$tipe.'.dikirim_ke_pabrik_teh, 0)
                    - COALESCE(t_'.$tipe.'.digunakan, 0) - COALESCE(t_'.$tipe.'.dikirim, 0)
                    - COALESCE(t_'.$tipe.'.dikirim_ke_pabrik_karet, 0) - COALESCE(t_'.$tipe.'.dikirim_ke_pabrik_gula, 0) - COALESCE(t_'.$tipe.'.dikirim_ke_bibitan_kelapa_sawit, 0)
                    - COALESCE(t_'.$tipe.'.dikirim_ke_pks_lain, 0) - COALESCE(t_'.$tipe.'.volume_keperluan_lain, 0) - COALESCE(t_'.$tipe.'.dijual, 0))
                    + (t_stok.stok_'.$tipe.' + COALESCE(t_'.$tipe.'.diterima_dari_pks_lain, 0)) 
                    ) as sisa_stok_akhir'
            ),
            DB::raw('SUM(COALESCE((t_produksi.produksi_'.$tipe.' - COALESCE(t_'.$tipe.'.digunakan_u_bahan_bakar, 0)) / NULLIF(t_produksi.produksi_'.$tipe.', 0) * 100, 0)) as persen_ekses_'.$tipe),
            DB::raw('SUM(COALESCE((t_produksi.produksi_'.$tipe.' - COALESCE(t_'.$tipe.'.digunakan_u_bahan_bakar, 0)) / NULLIF(t_produksi.tbs_olah, 0) * 100, 0)) as material_balance'),

        )
            ->leftJoin('t_stok', 'm_unit.kode', '=', 't_stok.kode_unit')
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_'.$tipe, 't_produksi.uuid', '=', 't_'.$tipe.'.id_t_produksi')
            ->leftJoin('m_region', 'm_unit.kode_region', '=', 'm_region.kode')
            ->where('m_unit.jenis_unit', 'PKS')
            ->whereNotNull('t_'.$tipe.'.id_t_produksi');

        if ($bi) {
            $query->whereYear('t_produksi.tanggal', '=', $tahun)
                ->whereMonth('t_produksi.tanggal', '=', $bulan);
        } else {
            $query->whereYear('t_produksi.tanggal', '>=', $tahun)
                ->whereMonth('t_produksi.tanggal', '<=', $bulan);
        }

        $query->groupBy(
            'm_unit.nama_unit',
            'm_unit.kode',
            'm_region.nama',
            't_stok.stok_'.$tipe,
            't_produksi.uuid',
            'keterangan_keperluan_lain',
            'm_region.urutan'
        )->orderBy('m_region.urutan', 'asc');

        return $query;
    }

    public function scopeUnitWithAbuBoiler($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit.*',
            't_produksi.uuid as id_produksi',
            't_produksi.tbs_olah',
            't_produksi.produksi_abu_boiler',
            't_abu_boiler.uuid as id_abu_boiler',
            't_abu_boiler.*',
            't_evidence.*',
        )
            ->where('m_unit.kode', $kodeUnit)
            ->whereYear('t_produksi.tanggal', $tahun)
            ->whereMonth('t_produksi.tanggal', $bulan)
            ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
            ->leftJoin('t_abu_boiler', 't_produksi.uuid', '=', 't_abu_boiler.id_t_produksi')
            ->leftJoin('t_evidence', 't_abu_boiler.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    // // PTPN 1
    // public function scopeUnitWithTeawaste($query, $kodeUnit, $tahun, $bulan)
    // {
    //     $query->select(
    //         'm_unit.*',
    //         't_produksi.uuid as id_produksi',
    //         't_produksi.tbs_olah',
    //         't_produksi.produksi_teawaste',
    //         't_tea_waste.uuid as id_teawaste',
    //         't_tea_waste.*',
    //         't_evidence.*',
    //     )
    //         ->where('m_unit.kode', $kodeUnit)
    //         ->whereYear('t_produksi.tanggal', $tahun)
    //         ->whereMonth('t_produksi.tanggal', $bulan)
    //         ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
    //         ->leftJoin('t_tea_waste', 't_produksi.uuid', '=', 't_tea_waste.id_t_produksi')
    //         ->leftJoin('t_evidence', 't_tea_waste.uuid', '=', 't_evidence.id_transaksi');
    //     return $query;
    // }

    // public function scopeUnitWithLimbahserum($query, $kodeUnit, $tahun, $bulan)
    // {
    //     $query->select(
    //         'm_unit.*',
    //         't_produksi.uuid as id_produksi',
    //         't_produksi.tbs_olah',
    //         't_produksi.produksi_limbahserum',
    //         't_limbah_serum.uuid as id_limbahserum',
    //         't_limbah_serum.*',
    //         't_evidence.*',
    //     )
    //         ->where('m_unit.kode', $kodeUnit)
    //         ->whereYear('t_produksi.tanggal', $tahun)
    //         ->whereMonth('t_produksi.tanggal', $bulan)
    //         ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
    //         ->leftJoin('t_limbah_serum', 't_produksi.uuid', '=', 't_limbah_serum.id_t_produksi')
    //         ->leftJoin('t_evidence', 't_limbah_serum.uuid', '=', 't_evidence.id_transaksi');
    //     return $query;
    // }

    // public function scopeUnitWithTunggulkaret($query, $kodeUnit, $tahun, $bulan)
    // {
    //     $query->select(
    //         'm_unit_n1.*',
    //         't_produksi.uuid as id_produksi',
    //         't_produksi.tbs_olah',
    //         't_produksi.produksi_tunggulkaret',
    //         't_tunggul_karet.uuid as id_tunggulkaret',
    //         't_tunggul_karet.*',
    //         't_evidence.*',
    //     )
    //         ->where('m_unit_n1.kode', $kodeUnit)
    //         ->whereYear('t_produksi.tanggal', $tahun)
    //         ->whereMonth('t_produksi.tanggal', $bulan)
    //         ->leftJoin('t_produksi', 'm_unit_n1.kode', '=', 't_produksi.kode_unit')
    //         ->leftJoin('t_tunggul_karet', 't_produksi.uuid', '=', 't_tunggul_karet.id_t_produksi')
    //         ->leftJoin('t_evidence', 't_tunggul_karet.uuid', '=', 't_evidence.id_transaksi');
    //     return $query;
    // }

    // public function scopeUnitWithRanting($query, $kodeUnit, $tahun, $bulan)
    // {
    //     $query->select(
    //         'm_unit.*',
    //         't_produksi.uuid as id_produksi',
    //         't_produksi.tbs_olah',
    //         't_produksi.produksi_ranting',
    //         't_ranting.uuid as id_ranting',
    //         't_ranting.*',
    //         't_evidence.*',
    //     )
    //         ->where('m_unit.kode', $kodeUnit)
    //         ->whereYear('t_produksi.tanggal', $tahun)
    //         ->whereMonth('t_produksi.tanggal', $bulan)
    //         ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
    //         ->leftJoin('t_ranting', 't_produksi.uuid', '=', 't_ranting.id_t_produksi')
    //         ->leftJoin('t_evidence', 't_ranting.uuid', '=', 't_evidence.id_transaksi');
    //     return $query;
    // }

    // public function scopeUnitWithAbu($query, $kodeUnit, $tahun, $bulan)
    // {
    //     $query->select(
    //         'm_unit.*',
    //         't_produksi.uuid as id_produksi',
    //         't_produksi.tbs_olah',
    //         't_produksi.produksi_abu',
    //         't_abu.uuid as id_abu',
    //         't_abu.*',
    //         't_evidence.*',
    //     )
    //         ->where('m_unit.kode', $kodeUnit)
    //         ->whereYear('t_produksi.tanggal', $tahun)
    //         ->whereMonth('t_produksi.tanggal', $bulan)
    //         ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
    //         ->leftJoin('t_abu', 't_produksi.uuid', '=', 't_abu.id_t_produksi')
    //         ->leftJoin('t_evidence', 't_abu.uuid', '=', 't_evidence.id_transaksi');
    //     return $query;
    // }

    // public function scopeUnitWithKulitBuah($query, $kodeUnit, $tahun, $bulan)
    // {
    //     $query->select(
    //         'm_unit.*',
    //         't_produksi.uuid as id_produksi',
    //         't_produksi.tbs_olah',
    //         't_produksi.produksi_kulitbuah',
    //         't_kulit_buah.uuid as id_kulitbuah',
    //         't_kulit_buah.*',
    //         't_evidence.*',
    //     )
    //         ->where('m_unit.kode', $kodeUnit)
    //         ->whereYear('t_produksi.tanggal', $tahun)
    //         ->whereMonth('t_produksi.tanggal', $bulan)
    //         ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
    //         ->leftJoin('t_kulit_buah', 't_produksi.uuid', '=', 't_kulit_buah.id_t_produksi')
    //         ->leftJoin('t_evidence', 't_abu.uuid', '=', 't_evidence.id_transaksi');
    //     return $query;
    // }
    
    // public function scopeUnitWithHuskSkin($query, $kodeUnit, $tahun, $bulan)
    // {
    //     $query->select(
    //         'm_unit.*',
    //         't_produksi.uuid as id_produksi',
    //         't_produksi.tbs_olah',
    //         't_produksi.produksi_huskskin',
    //         't_husk_skin.uuid as id_huskskin',
    //         't_husk_skin.*',
    //         't_evidence.*',
    //     )
    //         ->where('m_unit.kode', $kodeUnit)
    //         ->whereYear('t_produksi.tanggal', $tahun)
    //         ->whereMonth('t_produksi.tanggal', $bulan)
    //         ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
    //         ->leftJoin('t_husk_skin', 't_produksi.uuid', '=', 't_husk_skin.id_t_produksi')
    //         ->leftJoin('t_evidence', 't_abu.uuid', '=', 't_evidence.id_transaksi');
    //     return $query;
    // }    

    // public function scopeUnitWithMucilage($query, $kodeUnit, $tahun, $bulan)
    // {
    //     $query->select(
    //         'm_unit.*',
    //         't_produksi.uuid as id_produksi',
    //         't_produksi.tbs_olah',
    //         't_produksi.produksi_mucilage',
    //         't_mucilage.uuid as id_mucilage',
    //         't_mucilage.*',
    //         't_evidence.*',
    //     )
    //         ->where('m_unit.kode', $kodeUnit)
    //         ->whereYear('t_produksi.tanggal', $tahun)
    //         ->whereMonth('t_produksi.tanggal', $bulan)
    //         ->leftJoin('t_produksi', 'm_unit.kode', '=', 't_produksi.kode_unit')
    //         ->leftJoin('t_mucilage', 't_produksi.uuid', '=', 't_mucilage.id_t_produksi')
    //         ->leftJoin('t_evidence', 't_abu.uuid', '=', 't_evidence.id_transaksi');
    //     return $query;
    // }    


}

