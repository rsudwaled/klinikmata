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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->string('nomorantrean');
            $table->string('angkaantrean');

            $table->string('nomorkartu');
            $table->string('nik');
            $table->string('pasien_id');
            $table->string('norm');
            $table->string('nohp');

            $table->string('kodepoli');
            $table->string('namapoli');
            $table->string('kodesubspesialis');
            $table->string('namasubspesialis');

            $table->date('tanggalperiksa');
            $table->string('keluhan');
            $table->string('keterangan');

            $table->string('status');
            $table->string('pic');
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
        Schema::dropIfExists('antrians');
    }
};
