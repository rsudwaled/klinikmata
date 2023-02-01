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
        Schema::create('assesmen_perawats', function (Blueprint $table) {
            $table->id();
            $table->string('id_kunjungan');
            $table->string('id_pasien');
            $table->string('pic');
            $table->string('nama_perawat');
            $table->timestamp('tgl_entry')->nullable();
            $table->timestamp('tgl_kunjungan')->nullable();
            $table->timestamp('tgl_pemeriksaan')->nullable();
            $table->text('sumber_data');
            $table->text('tekanan_darah');
            $table->text('frekuensi_nadi');
            $table->text('frekuensi_nafas');
            $table->text('suhu_tubuh');
            $table->text('riwayat_alergi');
            $table->text('keterangan_alergi');
            $table->text('keluhan_pasien');
            $table->text('signature')->nullable();
            $table->string('status')->default('0');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assesmen_perawats');
    }
};
