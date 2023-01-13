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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->string('no_rm')->nullable();
            $table->string('no_bpjs')->nullable();
            $table->string('no_ihs')->nullable();

            $table->string('nama')->nullable();
            $table->string('sex')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('nohp')->nullable();

            $table->string('alamat')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();

            $table->string('pic')->nullable();
            $table->string('status')->default(1);
            $table->string('tgl_kematian')->nullable();
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
        Schema::dropIfExists('pasiens');
    }
};
