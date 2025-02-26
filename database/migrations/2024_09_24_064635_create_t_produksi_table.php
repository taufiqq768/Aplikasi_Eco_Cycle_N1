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
        Schema::create('t_produksi', function (Blueprint $table) {
            $table->uuid();
            $table->timestamps();
            $table->string('kode_unit', 10);
            $table->date('tanggal');
            $table->integer('tbs_olah');
            $table->double('produksi_cangkang');
            $table->double('produksi_fiber');
            $table->double('produksi_tankos');
            $table->double('produksi_abu_janjang');
            $table->double('produksi_solid');
            $table->double('produksi_pome_oil');
            $table->double('produksi_pkm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_produksi');
    }
};
