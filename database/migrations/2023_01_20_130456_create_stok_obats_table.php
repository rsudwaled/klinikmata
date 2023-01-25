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
        Schema::create('stok_obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('transaksi_id')->nullable();
            $table->string('invoice');
            $table->string('supplier_id')->nullable();

            $table->string('obat_id')->nullable();
            $table->string('tgl_expire')->nullable();
            $table->string('stok_in')->nullable();
            $table->string('stok_out')->nullable();

            $table->string('harga_beli')->nullable();
            $table->string('harga_jual')->nullable();
            $table->string('ppn')->nullable();
            $table->string('pph')->nullable();
            $table->string('diskon')->nullable();
            $table->string('margin_jual')->nullable();

            $table->string('pic')->nullable();
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
        Schema::dropIfExists('stok_obats');
    }
};
