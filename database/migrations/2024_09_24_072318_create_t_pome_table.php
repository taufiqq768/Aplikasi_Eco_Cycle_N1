<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_pome', function (Blueprint $table) {
            $table->uuid();
            $table->string('id_t_produksi');
            $table->date('tanggal');
            $table->double('digunakan_biogas_pks');
            $table->double('dikirim_kebun_u_land_aplikasi');
            $table->double('dibuang_ke_aliran_sungai');
            $table->double('potensi_pome');
            $table->double('pome_oil_dikutip');
            $table->double('pome_oil_terkutip_dikirim_pks_lain');
            $table->double('volume_keperluan_lain');
            $table->double('keterangan_keperluan_lain');
            $table->double('dijual');
            $table->double('harga_jual_rata_rata');
            $table->double('diterima_dari_pks_lain');
            $table->double('sisa_stok_akhir');
            $table->double('pendapatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pome');
    }
};
