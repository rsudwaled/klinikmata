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
            $table->string('nik')->nullable()->unique();
            $table->string('no_kk')->nullable()->unique();
            $table->string('no_rm')->unique();
            $table->string('no_bpjs')->nullable()->unique();
            $table->string('no_ihs')->nullable()->unique();

            $table->string('nama');
            $table->string('sex');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('nohp');

            $table->string('alamat')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();

            $table->string('menikah')->nullable();
            $table->string('agama')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();

            $table->string('tgl_kematian')->nullable();
            $table->string('pasien_baru')->nullable();
            $table->string('pic');
            $table->string('status')->default(1);
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
