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
            $table->string('kode')->unique();
            $table->string('kode_jkn')->nullable()->unique();
            $table->string('kode_ihs')->nullable()->unique();
            $table->string('nik')->nullable()->unique();

            $table->string('nama');
            $table->string('suffix')->nullable();
            $table->string('preffix')->nullable();
            $table->string('sip')->nullable();
            $table->string('poliklinik')->nullable();
            $table->string('subspesialis')->nullable();

            $table->string('nohp');
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
        Schema::dropIfExists('dokters');
    }
};
