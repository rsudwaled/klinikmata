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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('kode_jkn')->nullable();
            $table->string('kode_ihs')->nullable();
            $table->string('nik')->nullable();

            $table->string('nama')->nullable();
            $table->string('suffix')->nullable();
            $table->string('preffix')->nullable();
            $table->string('sip')->nullable();
            $table->string('poliklinik')->nullable();
            $table->string('subspesialis')->nullable();

            $table->string('nohp')->nullable();
            $table->string('pic')->nullable();
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
        Schema::dropIfExists('dokters');
    }
};
