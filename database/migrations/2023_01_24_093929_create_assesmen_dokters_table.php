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
        Schema::create('assesmen_dokters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_kunjungan');
            $table->string('id_pasien');
            $table->string('id_asskep');
            $table->string('pic');
            $table->timestamp('tgl_entry')->nullable();
            $table->timestamp('tgl_kunjungan')->nullable();
            $table->timestamp('tgl_pemeriksaan')->nullable();
            $table->string('sumber_data');
            $table->string('tekanan_darah');
            $table->string('frekuensi_nadi');
            $table->string('frekuensi_nafas');
            $table->string('suhu_tubuh');
            $table->string('riwayat_alergi');
            $table->string('keterangan_alergi');
            $table->string('riwayat_kehamilan_pasien_wanita');
            $table->string('riwyat_kelahiran_pasien_anak');
            $table->string('riwyat_penyakit_sekarang');
            $table->string('hipertensi');
            $table->string('kencingmanis');
            $table->string('jantung');
            $table->string('stroke');
            $table->string('hepatitis');
            $table->string('asthma');
            $table->string('ginjal');
            $table->string('tbparu');
            $table->text('riwayatlain');
            $table->text('statusgeneralis');
            $table->text('keadaanumum');
            $table->text('kesadaran');
            $table->text('diagnosakerja');
            $table->text('diagnosabanding');
            $table->text('rencanakerja');
            $table->string('vd_od');
            $table->string('vd_od_pinhole');
            $table->string('vd_os');
            $table->string('vd_os_pinhole');
            $table->string('refraktometer_od_sph');
            $table->string('refraktometer_od_cyl');
            $table->string('refraktometer_od_x');
            $table->string('refraktometer_os_sph');
            $table->string('refraktometer_os_cyl');
            $table->string('refraktometer_os_x');
            $table->string('Lensometer_od_sph');
            $table->string('Lensometer_od_cyl');
            $table->string('Lensometer_od_x');
            $table->string('Lensometer_os_sph');
            $table->string('Lensometer_os_cyl');
            $table->string('Lensometer_os_x');
            $table->string('koreksipenglihatan_vod_sph');
            $table->string('koreksipenglihatan_vod_cyl');
            $table->string('koreksipenglihatan_vod_x');
            $table->string('koreksipenglihatan_vos_sph');
            $table->string('koreksipenglihatan_vos_cyl');
            $table->string('koreksipenglihatan_vos_x');
            $table->text('tajampenglihatandekat');
            $table->text('tekananintraokular');
            $table->text('catatanpemeriksaanlain');
            $table->text('palpebra');
            $table->text('konjungtiva');
            $table->text('kornea');
            $table->text('bilikmatadepan');
            $table->text('pupil');
            $table->text('iris');
            $table->text('lensa');
            $table->text('funduskopi');
            $table->text('status_oftamologis_khusus');
            $table->text('masalahmedis');
            $table->text('prognosis');
            $table->text('gambar1')->nullable();
            $table->text('gambar2')->nullable();
            $table->string('keluhan_pasien');
            $table->text('signature')->nullable();
            $table->string('status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assesmen_dokters');
    }
};
