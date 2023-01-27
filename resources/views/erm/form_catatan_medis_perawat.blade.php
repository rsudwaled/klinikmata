<div class="card">
    <div class="card-header p-2 bg-primary">
        <h5 class="mr-2">
            <i class="fas fa-notes-medical mr-2 ml-2"></i> Catatan Medis
        </h5>
    </div><!-- /.card-header -->
    <div class="card-body">
        @foreach ($riwayat as $r)
            <div class="row">
                <div class="col-12" id="accordion">
                    <div class="card card-danger card-outline">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseNine{{ $r->id }}">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    {{ $r->tgl_masuk }}
                                </h4>
                            </div>
                        </a>
                        <div id="collapseNine{{ $r->id }}" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header bg-warning">Hasil Pemeriksaan Perawat</div>
                                    <div class="card-body">
                                        @if($r->id_perawat != (NULL))
                                        <table class="table table-sm">
                                            <tr>
                                                <td class="text-bold">Tanggal & Jam Kunjungan</td>
                                                <td class="font-italic text-bold text-md">{{ $r->tgl_kunjungan }}</td>
                                                <td class="text-bold">Tanggal & Jam Pemeriksaan</td>
                                                <td class="font-italic text-bold text-md">{{ $r->tgl_pemeriksaan }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Keluhan Utama Pasien</td>
                                                <td class="font-italic text-bold text-md">{{ $r->keluhan_pasien }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Sumber Data</td>
                                                <td class="font-italic text-bold text-md">{{ $r->sumber_data }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Tekanan Darah</td>
                                                <td class="font-italic text-bold text-md">{{ $r->tekanan_darah }}</td>
                                                <td class="text-bold">Frekuensi Nadi</td>
                                                <td class="font-italic text-bold text-md">{{ $r->frekuensi_nadi }} x /
                                                    menit</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Frekuensi Nafas</td>
                                                <td class="font-italic text-bold text-md">{{ $r->frekuensi_nafas }} x /
                                                    menit</td>
                                                <td class="text-bold">Suhu Tubuh</td>
                                                <td class="font-italic text-bold text-md">{{ $r->suhu_tubuh }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Riwayat Alergi</td>
                                                <td class="font-italic text-bold text-md">{{ $r->riwayat_alergi }}</td>
                                                <td class="text-bold">Keterangan Alergi</td>
                                                <td class="font-italic text-bold text-md">{{ $r->keterangan_alergi }}
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table mt-4">
                                            <thead>
                                                <th>Nama Perawat</th>
                                                <th>Tanda Tangan</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold text-md"></td>
                                                    <td>
                                                        <img src="{{ $r->ttdperawat }}" alt="">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @else
                                            <h4 class="text-danger">Data tidak ditemukan !</h4>
                                        @endif
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-danger">Hasil Pemeriksaan Dokter</div>
                                    <div class="card-body">
                                        @if($r->id_dokter != (NULL))
                                        <table class="table table-sm">
                                            <tr>
                                                <td class="text-bold">Tanggal & Jam Kunjungan</td>
                                                <td class="font-italic text-bold text-md">{{ $r->tgl_kunjungan }}</td>
                                                <td class="text-bold">Tanggal & Jam Pemeriksaan</td>
                                                <td class="font-italic text-bold text-md">{{ $r->tgl_pemeriksaan }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Keluhan Utama Pasien</td>
                                                <td class="font-italic text-bold text-md">{{ $r->keluhan_pasien }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Sumber Data</td>
                                                <td class="font-italic text-bold text-md">{{ $r->sumber_data }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Tekanan Darah</td>
                                                <td class="font-italic text-bold text-md">{{ $r->tekanan_darah }}</td>
                                                <td class="text-bold">Frekuensi Nadi</td>
                                                <td class="font-italic text-bold text-md">{{ $r->frekuensi_nadi }} x / menit</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Frekuensi Nafas</td>
                                                <td class="font-italic text-bold text-md">{{ $r->frekuensi_nafas }} x / menit</td>
                                                <td class="text-bold">Suhu Tubuh</td>
                                                <td class="font-italic text-bold text-md">{{ $r->suhu_tubuh }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Riwayat Alergi</td>
                                                <td class="font-italic text-bold text-md">{{ $r->riwayat_alergi }}</td>
                                                <td class="text-bold">Keterangan Alergi</td>
                                                <td class="font-italic text-bold text-md">{{ $r->keterangan_alergi }}</td>
                                            </tr>
                                        </table>

                                        <table class="table table-sm mt-3">
                                            <tr>
                                                <td class="text-bold">Riwayat Kehamilan (bagi pasien wanita)</td>
                                                <td>{{ $r->riwayat_kehamilan_pasien_wanita}}</td>
                                                <td class="text-bold">Riwayat Kelahiran (bagi pasien anak) </td>
                                                <td colspan="3">{{ $r->riwayat_kehamilan_pasien_wanita}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Riwayat Penyakit Sekarang</td>
                                                <td colspan="5">{{ $r->riwyat_penyakit_sekarang}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">hipertensi</td>
                                                <td class="text-bold">kencingmanis</td>
                                                <td class="text-bold">jantung</td>
                                                <td colspan="4" class="text-bold">stroke</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $r->hipertensi }}</td>
                                                <td>{{ $r->kencingmanis }}</td>
                                                <td>{{ $r->jantung }}</td>
                                                <td colspan="4">{{ $r->stroke }}</td>
                                            </tr>
                                            <tr>
                                                {{-- riwayatlain --}}
                                                <td class="text-bold">hepatitis</td>
                                                <td class="text-bold">asthma</td>
                                                <td class="text-bold">ginjal</td>
                                                <td  colspan="4" class="text-bold">tbparu</td>
                                            </tr>
                                            <tr>
                                                {{-- riwayatlain --}}
                                                <td>{{ $r->hepatitis }}</td>
                                                <td>{{ $r->asthma }}</td>
                                                <td>{{ $r->ginjal }}</td>
                                                <td  colspan="4">{{ $r->tbparu }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Riwayat Penyakit Lain</td>
                                                <td colspan="5">{{ $r->riwayatlain }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Status Generalis</td>
                                                <td colspan="5">{{ $r->statusgeneralis }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Keadaan Umum</td>
                                                <td colspan="5">{{ $r->keadaanumum }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Kesadaran</td>
                                                <td colspan="5">{{ $r->kesadaran }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Diagnosa Kerja</td>
                                                <td colspan="5">{{ $r->diagnosakerja }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Diagnosa Banding</td>
                                                <td colspan="5">{{ $r->diagnosabanding }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Rencana Kerja</td>
                                                <td colspan="5">{{ $r->rencanakerja }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-bold text-center bg-danger">PEMERIKSAAN KHUSUS</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-bold text-center bg-secondary">Visus Dasar</td>
                                            </tr>
                                            <tr>
                                                <td>OD</td>
                                                <td>{{ $r->vd_od }}</td>
                                                <td>PINHOLE</td>
                                                <td  colspan="4">{{ $r->vd_od_pinhole }}</td>
                                            </tr>
                                            <tr>
                                                <td>OS</td>
                                                <td>{{ $r->vd_os }}</td>
                                                <td>PINHOLE</td>
                                                <td  colspan="4">{{ $r->vd_os_pinhole }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-bold text-center bg-secondary">Refraktometer / streak</td>
                                            </tr>
                                            <tr>
                                                <td >OD:Sph</td>
                                                <td>{{ $r->refraktometer_od_sph }}</td>
                                                <td>Cyl</td>
                                                <td>{{ $r->refraktometer_od_cyl }}</td>
                                                <td>X</td>
                                                <td>{{ $r->refraktometer_od_x }}</td>
                                            </tr>
                                            <tr>
                                                <td>OS:Sph</td>
                                                <td>{{ $r->refraktometer_os_sph }}</td>
                                                <td>Cyl</td>
                                                <td>{{ $r->refraktometer_os_cyl }}</td>
                                                <td>X</td>
                                                <td>{{ $r->refraktometer_os_x }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-bold text-center bg-secondary">Lensometer</td>
                                            </tr>
                                            <tr>
                                                <td>OD:Sph</td>
                                                <td>{{ $r->Lensometer_od_sph }}</td>
                                                <td>Cyl</td>
                                                <td>{{ $r->Lensometer_od_cyl }}</td>
                                                <td>X</td>
                                                <td>{{ $r->Lensometer_od_x }}</td>
                                            </tr>
                                            <tr>
                                                <td>OS:Sph</td>
                                                <td>{{ $r->Lensometer_os_sph }}</td>
                                                <td>Cyl</td>
                                                <td>{{ $r->Lensometer_os_cyl }}</td>
                                                <td>X</td>
                                                <td>{{ $r->Lensometer_os_x }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-bold text-center bg-secondary">Koreksi penglihatan jauh</td>
                                            </tr>
                                            <tr>
                                                <td>VOD:Sph</td>
                                                <td>{{ $r->koreksipenglihatan_vod_sph }}</td>
                                                <td>Cyl</td>
                                                <td>{{ $r->koreksipenglihatan_vod_cyl }}</td>
                                                <td>X</td>
                                                <td>{{ $r->koreksipenglihatan_vod_x }}</td>
                                            </tr>
                                            <tr>
                                                <td>VOS:Sph</td>
                                                <td>{{ $r->koreksipenglihatan_vos_sph }}</td>
                                                <td>Cyl</td>
                                                <td>{{ $r->koreksipenglihatan_vos_cyl }}</td>
                                                <td>X</td>
                                                <td>{{ $r->koreksipenglihatan_vos_x }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Tajam penglihatan dekat</td>
                                                <td >{{ $r->tajampenglihatandekat }}</td>
                                                <td class="text-bold">Tekanan Intra Okular</td>
                                                <td  colspan="4">{{ $r->tekananintraokular }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Catatan Pemeriksaan Lainnya</td>
                                                <td>{{ $r->catatanpemeriksaanlain }}</td>
                                                <td class="text-bold">Palpebra</td>
                                                <td colspan="4">{{ $r->palpebra }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Konjungtiva</td>
                                                <td>{{ $r->konjungtiva }}</td>
                                                <td class="text-bold">Kornea</td>
                                                <td colspan="4">{{ $r->kornea }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Bilik Mata Depan</td>
                                                <td>{{ $r->bilikmatadepan }}</td>
                                                <td class="text-bold">Pupil</td>
                                                <td colspan="4">{{ $r->pupil }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Iris</td>
                                                <td>{{ $r->iris }}</td>
                                                <td class="text-bold">Lensa</td>
                                                <td colspan="4">{{ $r->lensa }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Funduskopi</td>
                                                <td>{{ $r->funduskopi }}</td>
                                                <td class="text-bold">Status Oftalmologis Khusus</td>
                                                <td colspan="4">{{ $r->status_oftamologis_khusus }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">Masalah Medis</td>
                                                <td>{{ $r->masalahmedis }}</td>
                                                <td class="text-bold">Prognosis</td>
                                                <td colspan="4">{{ $r->prognosis }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-bold text-center bg-warning">PENANDAAN GAMBAR</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <img src="{{ $r->gambar1 }}" alt="">
                                                </td>
                                                <td colspan="3">
                                                    <img src="{{ $r->gambar2 }}" alt="">
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table mt-4">
                                            <thead>
                                                <th>Nama Dokter</th>
                                                <th>Tanda Tangan</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold text-md"></td>
                                                    <td>
                                                        <img src="{{ $r->ttddokter }}" alt="">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @else
                                        <h4 class="text-danger">Data tidak ditemukan !</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div><!-- /.card-body -->
</div>
