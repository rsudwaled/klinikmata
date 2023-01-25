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
                                                    <img src="{{ $r->signature }}" alt="">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
