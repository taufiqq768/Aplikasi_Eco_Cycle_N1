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
        Schema::create('t_solid', function (Blueprint $table) {
            $table->uuid();
            $table->string('id_t_produksi');
            $table->date('tanggal');
            $table->double('digunakan_pupuk_organik');
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
        Schema::dropIfExists('t_solid');
    }
};
