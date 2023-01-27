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
        Schema::create('layanan_headers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kode_layanan_header')->nullable();
            $table->dateTime('tgl_entry')->nullable();
            $table->string('id_kunjungan')->nullable();
            $table->string('kode_kunjungan')->nullable();
            $table->string('kode_tipe_transaksi')->nullable();
            $table->string('pic')->nullable();
            $table->string('status_layanan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('total_layanan')->nullable();
            $table->string('status_retur')->nullable();
            $table->string('kode_penjamin')->nullable();
            $table->string('tagihan_pribadi')->nullable();
            $table->string('tagihan_penjamin')->nullable();
            $table->string('diskon_global')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->string('id_dokter')->nullable();
            $table->string('diagnosa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanan_headers');
    }
};
