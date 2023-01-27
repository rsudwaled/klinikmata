<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_layanan_detail')->nullable();
            $table->string('kode_layanan_header')->nullable();
            $table->string('nama_tarif')->nullable();
            $table->string('kode_tarif')->nullable();
            $table->string('tarif')->nullable();
            $table->string('jumlah_layanan')->nullable();
            $table->string('jumlah_retur')->nullable();
            $table->string('total_layanan')->nullable();
            $table->string('diskon_layanan')->nullable();
            $table->string('grand_total_tarif')->nullable();
            $table->string('dokter')->nullable();
            $table->string('pic')->nullable();
            $table->string('status_layanan_detail')->nullable();
            $table->string('tagihan_pribadi')->nullable();
            $table->string('tagihan_penjamin')->nullable();
            $table->string('tgl_layanan_detail')->nullable();
            $table->string('id_header')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanan_details');
    }
};
