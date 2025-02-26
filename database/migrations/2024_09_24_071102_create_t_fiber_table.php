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
        Schema::create('t_fiber', function (Blueprint $table) {
            $table->uuid();
            $table->string('id_t_produksi');
            $table->date('tanggal');
            $table->double('digunakan_u_bahan_bakar');
            $table->double('digunakan_pabrik_teh');
            $table->double('digunakan_u_bahan_karet');
            $table->double('digunakan_pabrik_gula');
            $table->double('digunakan_pabrik_sawit');
            $table->double('dikirim_pks_lain');
            $table->double('volume_keperluan_lain');
            $table->double('keterangan_keperluan_lain');
            $table->double('dijual');
            $table->double('harga_jual_rata_rata');
            $table->double('diterima_dari_pks_lain');
            $table->double('sisa_stok_akhir');
            $table->double('pendapatan');
            $table->double('persen_ekses_fiber');
            $table->double('material_balance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_fiber');
    }
};
