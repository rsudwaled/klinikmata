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
        Schema::create('nota_pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('barang_id');
            $table->string('supplier_id');
            $table->string('nomor_faktur');
            $table->date('tanggal_faktur');
            $table->bigInteger('jumlah');

            $table->string('tanggal_expire')->nullable();
            $table->double('harga_beli');
            $table->string('ppn')->nullable();
            $table->string('pph')->nullable();
            $table->string('diskon')->nullable();

            $table->string('pic');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('nota_pembelians');
    }
};
