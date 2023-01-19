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
        Schema::create('jadwal_dokters', function (Blueprint $table) {
            $table->id();
            $table->string('kodepoli')->nullable();
            $table->string('namapoli')->nullable();
            $table->string('kodesubspesialis')->nullable();
            $table->string('namasubspesialis')->nullable();
            $table->string('kodedokter')->nullable();
            $table->string('kodedokter_jkn')->nullable();
            $table->string('namadokter')->nullable();
            $table->string('hari')->nullable();
            $table->string('namahari')->nullable();
            $table->string('jampraktek')->nullable();
            $table->string('kapasitaspasien')->nullable();
            $table->string('pic');
            $table->boolean('libur')->default(0);
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
        Schema::dropIfExists('jadwal_dokters');
    }
};
