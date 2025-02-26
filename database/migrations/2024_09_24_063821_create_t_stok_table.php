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
        Schema::create('t_stok', function (Blueprint $table) {
            $table->uuid();
            $table->string('kode_unit', 10);
            $table->string('tahun', 4);
            $table->double('stok_cangkang');
            $table->double('stok_fiber');
            $table->double('stok_tankos');
            $table->double('stok_abu_janjang');
            $table->double('stok_solid');
            $table->double('stok_pome_oil');
            $table->double('stok_pkm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};
