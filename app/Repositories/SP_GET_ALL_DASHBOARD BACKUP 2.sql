CREATE DEFINER=`admin_programmer`@`%` PROCEDURE `eco_cycle`.`SP_GET_ALL_DASHBOARD`(IN tahun INT, IN bulan INT)
BEGIN
    SELECT
        m_region.nama,
        m_region.urutan,
        
        -- Stok awal tahun
        IFNULL(SUM(t_stok.stok_cangkang), 0) AS stok_cangkang_awal_tahun,
        IFNULL(SUM(t_stok.stok_fiber), 0) AS stok_fiber_awal_tahun,
        IFNULL(SUM(t_stok.stok_tankos), 0) AS stok_tankos_awal_tahun,
        IFNULL(SUM(t_stok.stok_abu_janjang), 0) AS stok_abu_janjang_awal_tahun,
        IFNULL(SUM(t_stok.stok_solid), 0) AS stok_solid_awal_tahun,
        IFNULL(SUM(t_stok.stok_pome_oil), 0) AS stok_pome_oil_awal_tahun,
        IFNULL(SUM(t_stok.stok_pkm), 0) AS stok_pkm_awal_tahun,

        -- Produksi
        IFNULL(SUM(t_produksi.produksi_cangkang), 0) AS produksi_cangkang,
        IFNULL(SUM(t_produksi.produksi_fiber), 0) AS produksi_fiber,
        IFNULL(SUM(t_produksi.produksi_tankos), 0) AS produksi_tankos,
        IFNULL(SUM(t_produksi.produksi_abu_janjang), 0) AS produksi_abu_janjang,
        IFNULL(SUM(t_produksi.produksi_solid), 0) AS produksi_solid,
        IFNULL(SUM(t_produksi.produksi_pome_oil), 0) AS produksi_pome_oil,
        IFNULL(SUM(t_produksi.produksi_pkm), 0) AS produksi_pkm,
        
        -- Penjualan
        IFNULL(SUM(t_cangkang.dijual), 0) AS penjualan_cangkang,
        IFNULL(SUM(t_fiber.dijual), 0) AS penjualan_fiber,
        IFNULL(SUM(t_tankos.dijual), 0) AS penjualan_tankos,
        IFNULL(SUM(t_abu_janjang.dijual), 0) AS penjualan_abu_janjang,
        IFNULL(SUM(t_solid.dijual), 0) AS penjualan_solid,
        IFNULL(SUM(t_pome.pome_oil_terkutip_dijual), 0) AS penjualan_pome_oil,
        IFNULL(SUM(t_pkm.dijual), 0) AS penjualan_pkm,
        
        -- Pendapatan
        IFNULL(SUM(t_cangkang.pendapatan), 0) AS pendapatan_cangkang,
        IFNULL(SUM(t_fiber.pendapatan), 0) AS pendapatan_fiber,
        IFNULL(SUM(t_tankos.pendapatan), 0) AS pendapatan_tankos,
        IFNULL(SUM(t_abu_janjang.pendapatan), 0) AS pendapatan_abu_janjang,
        IFNULL(SUM(t_solid.pendapatan), 0) AS pendapatan_solid,
        IFNULL(SUM(t_pome.pendapatan), 0) AS pendapatan_pome_oil,
        IFNULL(SUM(t_pkm.pendapatan), 0) AS pendapatan_pkm,
        
       -- Sisa stok
		IFNULL(SUM(
		    COALESCE(t_cangkang.diterima_dari_pks_lain, 0)
		    + COALESCE(t_produksi.produksi_cangkang, 0)
		    - COALESCE(t_cangkang.digunakan_u_bahan_bakar, 0)
		    - COALESCE(t_cangkang.dikirim_ke_pabrik_teh, 0) - COALESCE(t_cangkang.dikirim_ke_pabrik_karet, 0)
		    - COALESCE(t_cangkang.dikirim_ke_pabrik_gula, 0) - COALESCE(t_cangkang.dikirim_ke_bibitan_kelapa_sawit, 0)
		    - COALESCE(t_cangkang.dikirim_ke_pks_lain, 0) - COALESCE(t_cangkang.volume_keperluan_lain, 0)
		    - COALESCE(t_cangkang.dijual, 0)
		) + t_stok.stok_cangkang , 0) AS sisa_cangkang,

        IFNULL(SUM(
		    
		    COALESCE(t_fiber.diterima_dari_pks_lain, 0)
		    + COALESCE(t_produksi.produksi_fiber, 0)
		    - COALESCE(t_fiber.digunakan_u_bahan_bakar, 0) - COALESCE(t_fiber.dikirim_ke_pabrik_teh, 0)
		    - COALESCE(t_fiber.dikirim_ke_pabrik_karet, 0) - COALESCE(t_fiber.dikirim_ke_pabrik_gula, 0)
		    - COALESCE(t_fiber.dikirim_ke_bibitan_kelapa_sawit, 0) - COALESCE(t_fiber.dikirim_ke_pks_lain, 0)
		    - COALESCE(t_fiber.volume_keperluan_lain, 0) - COALESCE(t_fiber.dijual, 0)
		) + t_stok.stok_fiber , 0) AS sisa_fiber,
		
		IFNULL(SUM(
		    
		    COALESCE(t_produksi.produksi_tankos, 0)
		    - COALESCE(t_tankos.digunakan_sbg_pupuk_organik, 0)
		    - COALESCE(t_tankos.dikembalikan_ke_pemasok, 0) - COALESCE(t_tankos.dibakar_di_tungku_bakar, 0)
		    - COALESCE(t_tankos.volume_keperluan_lain, 0) - COALESCE(t_tankos.dijual, 0)
		), 0) + t_stok.stok_tankos  AS sisa_tankos,
		
		IFNULL(SUM(
		    
		    COALESCE(t_produksi.produksi_abu_janjang, 0)
		    - COALESCE(t_abu_janjang.digunakan_sbg_pupuk_organik, 0)
		    - COALESCE(t_abu_janjang.volume_keperluan_lain, 0) - COALESCE(t_abu_janjang.dijual, 0)
		), 0) + t_stok.stok_abu_janjang AS sisa_abu_janjang,
		
		IFNULL(SUM(
		    t_stok.stok_solid 
		    + COALESCE(t_produksi.produksi_solid, 0)
		    - COALESCE(t_solid.digunakan_sbg_pupuk_organik, 0)
		    - COALESCE(t_solid.volume_keperluan_lain, 0) - COALESCE(t_solid.dijual, 0)
		), 0) AS sisa_solid,
		
		IFNULL(SUM(
		    t_stok.stok_pome_oil 
		    + COALESCE(t_pome.diterima_dari_pks_lain, 0)
		    + COALESCE(t_pome.pome_oil_dikutip, 0)
		    - COALESCE(t_pome.pome_oil_terkutip_diolah_kembali, 0)
		    - COALESCE(t_pome.pome_oil_terkutip_dikirim_pks_lain, 0) - COALESCE(t_pome.pome_oil_terkutip_dijual, 0)
		), 0) AS sisa_pome_oil,
		
		IFNULL(SUM(
		    t_stok.stok_pkm 
		    + COALESCE(t_produksi.produksi_pkm, 0)
		    - COALESCE(t_pkm.dijual, 0) - COALESCE(t_pkm.volume_keperluan_lain, 0)
		), 0) AS sisa_pkm,

        -- Data diterima dari PKS lain
        IFNULL(SUM(t_cangkang.diterima_dari_pks_lain), 0) AS cangkang_diterima_dari_pks_lain,
        IFNULL(SUM(t_abu_janjang.diterima_dari_pks_lain), 0) AS abu_janjang_diterima_dari_pks_lain,
        IFNULL(SUM(t_solid.diterima_dari_pks_lain), 0) AS solid_diterima_dari_pks_lain,
        IFNULL(SUM(t_fiber.diterima_dari_pks_lain), 0) AS fiber_diterima_dari_pks_lain,
        IFNULL(SUM(t_tankos.diterima_dari_pks_lain), 0) AS tankos_diterima_dari_pks_lain,
        IFNULL(SUM(t_pome.diterima_dari_pks_lain), 0) AS pome_diterima_dari_pks_lain,
        IFNULL(SUM(t_pkm.diterima_dari_pks_lain), 0) AS pkm_diterima_dari_pks_lain,

        -- Penggunaan
        IFNULL(SUM(COALESCE(t_cangkang.digunakan_u_bahan_bakar, 0) + COALESCE(t_cangkang.dikirim_ke_pabrik_teh, 0)
        + COALESCE(t_cangkang.dikirim_ke_pabrik_karet, 0) + COALESCE(t_cangkang.dikirim_ke_pabrik_gula, 0)
        + COALESCE(t_cangkang.dikirim_ke_bibitan_kelapa_sawit, 0) + COALESCE(t_cangkang.dikirim_ke_pks_lain, 0)
        + COALESCE(t_cangkang.volume_keperluan_lain, 0)), 0) AS cangkang_digunakan,

        IFNULL(SUM(COALESCE(t_fiber.digunakan_u_bahan_bakar, 0) + COALESCE(t_fiber.dikirim_ke_pabrik_teh, 0)
        + COALESCE(t_fiber.dikirim_ke_pabrik_karet, 0) + COALESCE(t_fiber.dikirim_ke_pabrik_gula, 0)
        + COALESCE(t_fiber.dikirim_ke_bibitan_kelapa_sawit, 0) + COALESCE(t_fiber.dikirim_ke_pks_lain, 0)
        + COALESCE(t_fiber.volume_keperluan_lain, 0)), 0) AS fiber_digunakan,

        IFNULL(SUM(COALESCE(t_tankos.digunakan_sbg_pupuk_organik, 0) + COALESCE(t_tankos.dikembalikan_ke_pemasok, 0)
        + COALESCE(t_tankos.dibakar_di_tungku_bakar, 0) + COALESCE(t_tankos.volume_keperluan_lain, 0)), 0) AS tankos_digunakan,

        IFNULL(SUM(COALESCE(t_abu_janjang.digunakan_sbg_pupuk_organik, 0) + COALESCE(t_abu_janjang.volume_keperluan_lain, 0)), 0) AS abu_janjang_digunakan,

        IFNULL(SUM(COALESCE(t_solid.digunakan_sbg_pupuk_organik, 0) + COALESCE(t_solid.volume_keperluan_lain, 0)), 0) AS solid_digunakan,

        IFNULL(SUM(COALESCE(t_pome.pome_oil_terkutip_diolah_kembali, 0) + COALESCE(t_pome.pome_oil_terkutip_dikirim_pks_lain, 0)), 0) AS pome_digunakan,

        IFNULL(COALESCE(t_pkm.volume_keperluan_lain, 0), 0) AS pkm_digunakan

    FROM
        m_region
    LEFT JOIN m_unit ON m_region.kode = m_unit.kode_region
    LEFT JOIN t_stok ON m_unit.kode = t_stok.kode_unit
    LEFT JOIN t_produksi ON m_unit.kode = t_produksi.kode_unit 
                          AND YEAR(t_produksi.tanggal) = tahun
                          AND MONTH(t_produksi.tanggal) <= bulan
    LEFT JOIN t_cangkang ON t_produksi.uuid = t_cangkang.id_t_produksi
    LEFT JOIN t_fiber ON t_produksi.uuid = t_fiber.id_t_produksi
    LEFT JOIN t_tankos ON t_produksi.uuid = t_tankos.id_t_produksi
    LEFT JOIN t_abu_janjang ON t_produksi.uuid = t_abu_janjang.id_t_produksi
    LEFT JOIN t_solid ON t_produksi.uuid = t_solid.id_t_produksi
    LEFT JOIN t_pome ON t_produksi.uuid = t_pome.id_t_produksi
    LEFT JOIN t_pkm ON t_produksi.uuid = t_pkm.id_t_produksi
    where
    	m_unit.jenis_unit = 'PKS' or
    	m_unit.jenis_unit = 'PPIS'
    GROUP BY m_region.nama, m_region.urutan
    ORDER BY m_region.urutan ASC;
END