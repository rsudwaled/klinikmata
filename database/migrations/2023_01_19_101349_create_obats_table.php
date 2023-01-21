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
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('barcode')->nullable()->unique();
            $table->string('nama')->nullable();
            $table->string('satuan_id')->nullable();
            $table->string('jenis')->nullable();
            $table->string('kategori_id')->nullable();
            $table->boolean('status')->default(0);

            $table->boolean('harga_jual')->nullable();
            $table->boolean('margin_jual')->nullable();
            $table->boolean('pic')->default(0);
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
        Schema::dropIfExists('obats');
    }
};
