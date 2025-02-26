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
        Schema::create('m_region', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 5);
            $table->string('nama', 100);
            $table->integer('urutan');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('m_unit', function (Blueprint $table) {
            $table->string('kode', 10)->primary();
            $table->string('kode_region', 5);
            $table->string('nama_unit', 100);
            $table->boolean('is_pln')->default(true);
            $table->boolean('is_bunch_press')->default(false);
            $table->double('daya_terpasang')->nullable();
            $table->double('flow_meter')->nullable();
            $table->string('jenis_unit', 50);
            $table->boolean('kapasitas_olah')->nullable();
            $table->string('tipe_pome', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_region');
        Schema::dropIfExists('m_unit');
    }
};
