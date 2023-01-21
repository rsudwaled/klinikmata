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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();

            $table->string('kode')->nullable();
            $table->string('kode_ihs')->nullable();

            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_keluar')->nullable();

            $table->string('pasien_id')->nullable();
            $table->string('dokter_id')->nullable();
            $table->string('penjamin_id')->nullable();
            $table->string('status')->default(1);
            $table->string('pic');

            $table->string('poliklinik')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('keluhan')->nullable();

            $table->string('no_rujukan')->nullable();
            $table->string('no_kontrol')->nullable();
            $table->string('no_sep')->nullable();

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
        Schema::dropIfExists('kunjungans');
    }
};
