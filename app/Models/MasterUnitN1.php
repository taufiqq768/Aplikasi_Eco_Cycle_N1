<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterUnitN1 extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'm_unit_n1';
    protected $primaryKey = 'kode';

    public function transaksiStokN1()
    {
        return $this->hasMany(TransaksiStokN1::class, 'kode_unit');
    }


    // PTPN 1
    public function scopeWithProduksiN1($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.*',
            't_evidence.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.is_bunch_press as is_bunch_press',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_evidence', 't_produksi_n1.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithTeawaste($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_teawaste',
            't_tea_waste.uuid as id_teawaste',
            't_tea_waste.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_tea_waste', 't_produksi_n1.uuid', '=', 't_tea_waste.id_t_produksi')
            ->leftJoin('t_evidence', 't_tea_waste.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithAbuhe($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_abuhe',
            't_abu_he.uuid as id_abuhe',
            't_abu_he.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_abu_he', 't_produksi_n1.uuid', '=', 't_abu_he.id_t_produksi')
            ->leftJoin('t_evidence', 't_abu_he.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithLimbahserum($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_limbahserum',
            't_limbah_serum.uuid as id_limbahserum',
            't_limbah_serum.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_limbah_serum', 't_produksi_n1.uuid', '=', 't_limbah_serum.id_t_produksi')
            ->leftJoin('t_evidence', 't_limbah_serum.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithTunggulkaret($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_tunggulkaret',
            't_tunggul_karet.uuid as id_tunggulkaret',
            't_tunggul_karet.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_tunggul_karet', 't_produksi_n1.uuid', '=', 't_tunggul_karet.id_t_produksi')
            ->leftJoin('t_evidence', 't_tunggul_karet.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithRanting($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_ranting',
            't_ranting.uuid as id_ranting',
            't_ranting.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_ranting', 't_produksi_n1.uuid', '=', 't_ranting.id_t_produksi')
            ->leftJoin('t_evidence', 't_ranting.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithAbu($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_abu',
            't_abu.uuid as id_abu',
            't_abu.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_abu', 't_produksi_n1.uuid', '=', 't_abu.id_t_produksi')
            ->leftJoin('t_evidence', 't_abu.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithBatangKayu($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_batangkayu',
            't_batang_kayu.uuid as id_batangkayu',
            't_batang_kayu.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_batang_kayu', 't_produksi_n1.uuid', '=', 't_batang_kayu.id_t_produksi')
            ->leftJoin('t_evidence', 't_batang_kayu.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithRubebrTrap($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_rubbertrap',
            't_rubber_trap.uuid as id_rubbertrap',
            't_rubber_trap.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_rubber_trap', 't_produksi_n1.uuid', '=', 't_rubber_trap.id_t_produksi')
            ->leftJoin('t_evidence', 't_rubber_trap.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }

    public function scopeUnitWithKulitBuah($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_kulitbuah',
            't_kulit_buah.uuid as id_kulitbuah',
            't_kulit_buah.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_kulit_buah', 't_produksi_n1.uuid', '=', 't_kulit_buah.id_t_produksi')
            ->leftJoin('t_evidence', 't_kulit_buah.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }
    
    public function scopeUnitWithHuskSkin($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_huskskin',
            't_husk_skin.uuid as id_huskskin',
            't_husk_skin.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_husk_skin', 't_produksi_n1.uuid', '=', 't_husk_skin.id_t_produksi')
            ->leftJoin('t_evidence', 't_husk_skin.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }    

    public function scopeUnitWithMucilage($query, $kodeUnit, $tahun, $bulan)
    {
        $query->select(
            'm_unit_n1.*',
            't_produksi_n1.uuid as id_produksi',
            't_produksi_n1.tbs_olah',
            't_produksi_n1.produksi_mucilage',
            't_mucilage.uuid as id_mucilage',
            't_mucilage.*',
            't_evidence.*',
        )
            ->where('m_unit_n1.kode', $kodeUnit)
            ->whereYear('t_produksi_n1.tanggal', $tahun)
            ->whereMonth('t_produksi_n1.tanggal', $bulan)
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_mucilage', 't_produksi_n1.uuid', '=', 't_mucilage.id_t_produksi')
            ->leftJoin('t_evidence', 't_mucilage.uuid', '=', 't_evidence.id_transaksi');
        return $query;
    }    

    public function scopeWithDetailItemN1($query, $bulan, $tahun, $bi = false, $tipe)
    {
        $query->select(
            'm_unit_n1.nama_unit',
            'm_unit_n1.kode as kode_unit',
            't_stok.stok_'.$tipe,
            't_produksi_n1.uuid as id_produksi',
            'm_region.nama as region',
            'm_region.urutan',
            DB::raw('(SELECT keterangan_keperluan_lain FROM t_'.$tipe.' WHERE t_'.$tipe.'.id_t_produksi = t_produksi_n1.uuid LIMIT 1) as keterangan_keperluan_lain'),
            DB::raw('CASE WHEN EXISTS (
                        SELECT 1 
                        FROM t_log_transaksi 
                        WHERE 
                            kode_unit = m_unit_n1.kode 
                            AND YEAR(tanggal) = '.$tahun.' AND MONTH(tanggal) <= '.$bulan.'
                    ) THEN true ELSE false END as has_log'),
            DB::raw('SUM(t_produksi_n1.produksi_'.$tipe.') as produksi_'.$tipe),
            DB::raw('SUM(t_produksi_n1.tbs_olah) as tbs_olah'),
            DB::raw('SUM(t_'.$tipe.'.digunakan) as digunakan'),
            DB::raw('SUM(t_'.$tipe.'.dikirim) as dikirim'),
            DB::raw('SUM(t_'.$tipe.'.volume_keperluan_lain) as volume_keperluan_lain'),
            DB::raw('SUM(t_'.$tipe.'.dijual) as dijual'),
            DB::raw('SUM(t_'.$tipe.'.harga_jual_rata_rata) as harga_jual_rata_rata'),
            // DB::raw('SUM(t_'.$tipe.'.diterima) as diterima'),
            // --------------------------------
            DB::raw('SUM(t_'.$tipe.'.dijual * t_'.$tipe.'.harga_jual_rata_rata) as pendapatan'),
            DB::raw(
                'SUM((t_produksi_n1.produksi_'.$tipe.'
                    - COALESCE(t_'.$tipe.'.digunakan, 0) - COALESCE(t_'.$tipe.'.dikirim, 0)
                    - COALESCE(t_'.$tipe.'.volume_keperluan_lain, 0) - COALESCE(t_'.$tipe.'.dijual, 0))
                    + (t_stok.stok_'.$tipe.' 
                    )) as sisa_stok_akhir'
            ),
            DB::raw('SUM(COALESCE((t_produksi_n1.produksi_'.$tipe.' - COALESCE(t_'.$tipe.'.digunakan, 0)) / NULLIF(t_produksi_n1.produksi_'.$tipe.', 0) * 100, 0)) as persen_ekses_'.$tipe),
            DB::raw('SUM(COALESCE((t_produksi_n1.produksi_'.$tipe.' - COALESCE(t_'.$tipe.'.digunakan, 0)) / NULLIF(t_produksi_n1.tbs_olah, 0) * 100, 0)) as material_balance'),

        )
            ->leftJoin('t_stok', 'm_unit_n1.kode', '=', 't_stok.kode_unit')
            ->leftJoin('t_produksi_n1', 'm_unit_n1.kode', '=', 't_produksi_n1.kode_unit')
            ->leftJoin('t_'.$tipe, 't_produksi_n1.uuid', '=', 't_'.$tipe.'.id_t_produksi')
            ->leftJoin('m_region', 'm_unit_n1.kode_region', '=', 'm_region.kode')
            ->where('m_unit_n1.jenis_unit', 'TEH')
            ->orwhere('m_unit_n1.jenis_unit', 'KARET')
            ->orwhere('m_unit_n1.jenis_unit', 'KOPI')
            ->whereNotNull('t_'.$tipe.'.id_t_produksi');

        if ($bi) {
            $query->whereYear('t_produksi_n1.tanggal', '=', $tahun)
                ->whereMonth('t_produksi_n1.tanggal', '=', $bulan);
        } else {
            $query->whereYear('t_produksi_n1.tanggal', '>=', $tahun)
                ->whereMonth('t_produksi_n1.tanggal', '<=', $bulan);
        }

        $query->groupBy(
            'm_unit_n1.nama_unit',
            'm_unit_n1.kode',
            'm_region.nama',
            't_stok.stok_'.$tipe,
            't_produksi_n1.uuid',
            'keterangan_keperluan_lain',
            'm_region.urutan'
        )->orderBy('m_region.urutan', 'asc');

        return $query;
    }


}

