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
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('barang_id');
            $table->string('nomor_faktur');
            $table->date('tanggal_faktur');
            $table->bigInteger('jumlah');

            $table->string('supplier_id')->nullable();
            $table->string('pasien_id')->nullable();

            $table->double('harga_satuan')->nullable();
            $table->double('harga_jual')->nullable();
            $table->double('harga_beli')->nullable();

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
        Schema::dropIfExists('stoks');
    }
};
