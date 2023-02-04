<div class="card">
    <div class="card-header p-2 bg-danger">
        <h5 class="mr-2">
            <i class="fas fa-notes-medical mr-2 ml-2"></i>Resume Medis
        </h5>
    </div><!-- /.card-header -->
    <div class="card-body scroll">
        @if (count($assdok) > 0)
        <div class="card">
            <div class="card-header bg-info">Hasil Pemeriksaan</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td class="text-bold">Tanggal & Jam Kunjungan</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['tgl_kunjungan'] }}</td>
                        <td class="text-bold">Tanggal & Jam Pemeriksaan</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['tgl_pemeriksaan'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Keluhan Utama Pasien</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['keluhan_pasien'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Sumber Data</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['sumber_data'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Tekanan Darah</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['tekanan_darah'] }}</td>
                        <td class="text-bold">Frekuensi Nadi</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['frekuensi_nadi'] }} x / menit</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Frekuensi Nafas</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['frekuensi_nafas'] }} x / menit</td>
                        <td class="text-bold">Suhu Tubuh</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['suhu_tubuh'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Riwayat Alergi</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['riwayat_alergi'] }}</td>
                        <td class="text-bold">Keterangan Alergi</td>
                        <td class="font-italic text-bold text-md">{{ $assdok[0]['keterangan_alergi'] }}</td>
                    </tr>
                </table>

                <table class="table table-sm mt-3">
                    <tr>
                        <td class="text-bold">Riwayat Kehamilan (bagi pasien wanita)</td>
                        <td>{{ $assdok[0]->riwayat_kehamilan_pasien_wanita}}</td>
                        <td class="text-bold">Riwayat Kelahiran (bagi pasien anak) </td>
                        <td colspan="3">{{ $assdok[0]->riwayat_kehamilan_pasien_wanita}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Riwayat Penyakit Sekarang</td>
                        <td colspan="5">{{ $assdok[0]->riwyat_penyakit_sekarang}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">hipertensi</td>
                        <td class="text-bold">kencingmanis</td>
                        <td class="text-bold">jantung</td>
                        <td colspan="4" class="text-bold">stroke</td>
                    </tr>
                    <tr>
                        <td>{{ $assdok[0]->hipertensi }}</td>
                        <td>{{ $assdok[0]->kencingmanis }}</td>
                        <td>{{ $assdok[0]->jantung }}</td>
                        <td colspan="4">{{ $assdok[0]->stroke }}</td>
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
                        <td>{{ $assdok[0]->hepatitis }}</td>
                        <td>{{ $assdok[0]->asthma }}</td>
                        <td>{{ $assdok[0]->ginjal }}</td>
                        <td  colspan="4">{{ $assdok[0]->tbparu }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Riwayat Penyakit Lain</td>
                        <td colspan="5">{{ $assdok[0]->riwayatlain }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Status Generalis</td>
                        <td colspan="5">{{ $assdok[0]->statusgeneralis }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Keadaan Umum</td>
                        <td colspan="5">{{ $assdok[0]->keadaanumum }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Kesadaran</td>
                        <td colspan="5">{{ $assdok[0]->kesadaran }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Diagnosa Kerja</td>
                        <td colspan="5">{{ $assdok[0]->diagnosakerja }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Diagnosa Banding</td>
                        <td colspan="5">{{ $assdok[0]->diagnosabanding }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Rencana Kerja</td>
                        <td colspan="5">{{ $assdok[0]->rencanakerja }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-bold text-center bg-danger">PEMERIKSAAN KHUSUS</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-bold text-center bg-secondary">Visus Dasar</td>
                    </tr>
                    <tr>
                        <td>OD</td>
                        <td>{{ $assdok[0]->vd_od }}</td>
                        <td>PINHOLE</td>
                        <td  colspan="4">{{ $assdok[0]->vd_od_pinhole }}</td>
                    </tr>
                    <tr>
                        <td>OS</td>
                        <td>{{ $assdok[0]->vd_os }}</td>
                        <td>PINHOLE</td>
                        <td  colspan="4">{{ $assdok[0]->vd_os_pinhole }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-bold text-center bg-secondary">Refraktometer / streak</td>
                    </tr>
                    <tr>
                        <td >OD:Sph</td>
                        <td>{{ $assdok[0]->refraktometer_od_sph }}</td>
                        <td>Cyl</td>
                        <td>{{ $assdok[0]->refraktometer_od_cyl }}</td>
                        <td>X</td>
                        <td>{{ $assdok[0]->refraktometer_od_x }}</td>
                    </tr>
                    <tr>
                        <td>OS:Sph</td>
                        <td>{{ $assdok[0]->refraktometer_os_sph }}</td>
                        <td>Cyl</td>
                        <td>{{ $assdok[0]->refraktometer_os_cyl }}</td>
                        <td>X</td>
                        <td>{{ $assdok[0]->refraktometer_os_x }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-bold text-center bg-secondary">Lensometer</td>
                    </tr>
                    <tr>
                        <td>OD:Sph</td>
                        <td>{{ $assdok[0]->Lensometer_od_sph }}</td>
                        <td>Cyl</td>
                        <td>{{ $assdok[0]->Lensometer_od_cyl }}</td>
                        <td>X</td>
                        <td>{{ $assdok[0]->Lensometer_od_x }}</td>
                    </tr>
                    <tr>
                        <td>OS:Sph</td>
                        <td>{{ $assdok[0]->Lensometer_os_sph }}</td>
                        <td>Cyl</td>
                        <td>{{ $assdok[0]->Lensometer_os_cyl }}</td>
                        <td>X</td>
                        <td>{{ $assdok[0]->Lensometer_os_x }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-bold text-center bg-secondary">Koreksi penglihatan jauh</td>
                    </tr>
                    <tr>
                        <td>VOD:Sph</td>
                        <td>{{ $assdok[0]->koreksipenglihatan_vod_sph }}</td>
                        <td>Cyl</td>
                        <td>{{ $assdok[0]->koreksipenglihatan_vod_cyl }}</td>
                        <td>X</td>
                        <td>{{ $assdok[0]->koreksipenglihatan_vod_x }}</td>
                    </tr>
                    <tr>
                        <td>VOS:Sph</td>
                        <td>{{ $assdok[0]->koreksipenglihatan_vos_sph }}</td>
                        <td>Cyl</td>
                        <td>{{ $assdok[0]->koreksipenglihatan_vos_cyl }}</td>
                        <td>X</td>
                        <td>{{ $assdok[0]->koreksipenglihatan_vos_x }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Tajam penglihatan dekat</td>
                        <td >{{ $assdok[0]->tajampenglihatandekat }}</td>
                        <td class="text-bold">Tekanan Intra Okular</td>
                        <td  colspan="4">{{ $assdok[0]->tekananintraokular }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Catatan Pemeriksaan Lainnya</td>
                        <td>{{ $assdok[0]->catatanpemeriksaanlain }}</td>
                        <td class="text-bold">Palpebra</td>
                        <td colspan="4">{{ $assdok[0]->palpebra }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Konjungtiva</td>
                        <td>{{ $assdok[0]->konjungtiva }}</td>
                        <td class="text-bold">Kornea</td>
                        <td colspan="4">{{ $assdok[0]->kornea }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Bilik Mata Depan</td>
                        <td>{{ $assdok[0]->bilikmatadepan }}</td>
                        <td class="text-bold">Pupil</td>
                        <td colspan="4">{{ $assdok[0]->pupil }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Iris</td>
                        <td>{{ $assdok[0]->iris }}</td>
                        <td class="text-bold">Lensa</td>
                        <td colspan="4">{{ $assdok[0]->lensa }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Funduskopi</td>
                        <td>{{ $assdok[0]->funduskopi }}</td>
                        <td class="text-bold">Status Oftalmologis Khusus</td>
                        <td colspan="4">{{ $assdok[0]->status_oftamologis_khusus }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Masalah Medis</td>
                        <td>{{ $assdok[0]->masalahmedis }}</td>
                        <td class="text-bold">Prognosis</td>
                        <td colspan="4">{{ $assdok[0]->prognosis }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-bold text-center bg-warning">PENANDAAN GAMBAR</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <img src="{{ $assdok[0]->gambar1 }}" alt="">
                        </td>
                        <td colspan="3">
                            <img src="{{ $assdok[0]->gambar2 }}" alt="">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-info">Riwayat Tindakan</div>
            <div class="card-body">
                <table id="tabelriwayattindakan" class="table table-sm table-hover">
                    <thead>
                        <th>Kode Header</th>
                        <th>Kode Detail</th>
                        <th>Nama Tindakan</th>
                        <th>Tarif</th>
                        <th>Jlh Tindakan</th>
                        <th>Discount</th>
                    </thead>
                    <tbody>
                        @if(count($detail_tindakan) > 0)
                        @foreach ($detail_tindakan as $dt)
                        @if($dt->keterangan != 'Order Farmasi')
                            <tr>
                                <td>{{ $dt->kode_layanan_header }}</td>
                                <td>{{ $dt->id_layanan_detail }}</td>
                                <td>{{ $dt->nama_tarif }}</td>
                                <td>{{ money($dt->tarif, 'IDR')}}</td>
                                <td class="text-center">{{ $dt->jumlah_layanan }}</td>
                                <td class="text-center">{{ $dt->diskon_layanan }}</td>
                            </tr>
                            @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-info">Order Farmasi</div>
            <div class="card-body">
                <table id="tabelriwayattindakan" class="table table-sm table-hover">
                    <thead>
                        <th>Kode Header</th>
                        <th>Kode Detail</th>
                        <th>Nama Obat / Barang</th>
                        <th>Tarif</th>
                        <th>Jlh</th>
                        <th>signa</th>
                        <th>satuan</th>
                        <th>Mata Kanan</th>
                        <th>Mata Kiri</th>
                        <th>Discount</th>
                    </thead>
                    <tbody>
                        @if(count($detail_tindakan) > 0)
                        @foreach ($detail_tindakan as $dt)
                        @if($dt->keterangan == 'Order Farmasi')
                            <tr>
                                <td>{{ $dt->kode_layanan_header }}</td>
                                <td>{{ $dt->id_layanan_detail }}</td>
                                <td>{{ $dt->nama_tarif }}</td>
                                <td>{{ money($dt->tarif, 'IDR')}}</td>
                                <td class="text-center">{{ $dt->jumlah_layanan }}</td>
                                <td class="text-center">{{ $dt->signa }}</td>
                                <td class="text-center">{{ $dt->satuan }}</td>
                                <td class="text-center">{{ $dt->matakanan }}</td>
                                <td class="text-center">{{ $dt->matakiri }}</td>
                                <td class="text-center">{{ $dt->diskon_layanan }}</td>
                            </tr>
                            @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
         <table class="table mt-4">
                    <thead>
                        <th>Nama Dokter</th>
                        <th>Tanda Tangan</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-bold text-md">{{ auth()->user()->name }}</td>
                            <td>
                                @if($assdok[0]->signature == '')
                                <div id="signature-pad">
                                    <div
                                        style="border:solid 1px teal; width:360px;height:110px;padding:3px;position:relative;">
                                        <div id="note" onmouseover="my_function();">tulis tanda tangan didalam box ...
                                        </div>
                                        <canvas id="the_canvas" width="350px" height="100px"></canvas>
                                    </div>
                                    <div style="margin:10px;">
                                        <input hidden type="" id="signature" name="signature">
                                        <button type="button" id="clear_btn" class="btn btn-danger"
                                            data-action="clear"><span class="glyphicon glyphicon-remove"></span>
                                            Clear</button>
                                    </div>
                                </div>
                                @else
                                    <img src="{{ $assdok[0]->signature }}" alt="">
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
        @if($assdok[0]->signature == '')
        <button class="btn btn-success float-right" onclick="simpantandatangan()">Simpan</button>
        @endif
    @else
        <h5 class="text-danger">Hasil Pemeriksaan Belum diisi !</h5>
    @endif
    </div><!-- /.card-body -->
</div>
<script type="text/javascript" src="{{ asset('vendor/signature/js/signature.js') }}"></script>
<script>
    var wrapper = document.getElementById("signature-pad");
    var clearButton = wrapper.querySelector("[data-action=clear]");
    var canvas = wrapper.querySelector("canvas");
    var el_note = document.getElementById("note");
    var signaturePad;
    signaturePad = new SignaturePad(canvas);
    clearButton.addEventListener("click", function(event) {
        document.getElementById("note").innerHTML = "The signature should be inside box";
        signaturePad.clear();
    });

    function simpantandatangan() {
        var canvas = document.getElementById("the_canvas");
        var dataUrl = canvas.toDataURL();
        if (dataUrl ==
            'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAV4AAABkCAYAAADOvVhlAAADOklEQVR4Xu3UwQkAAAgDMbv/0m5xr7hAIcjtHAECBAikAkvXjBEgQIDACa8nIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECDweoABlt2MJjgAAAABJRU5ErkJggg=='
        ) {
            dataUrl = ''
        }
        document.getElementById("signature").value = dataUrl;
        signature = $('#signature').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                idkunjungan: $('#idkunjungan').val(),
                signature
            },
            url: '<?= route('simpanttddokter') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: 'Klinikmatalosari2023'
                })
                spinner.hide();
            },
            success: function(data) {
                spinner.hide();
                if (data.kode == '502') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops',
                        text: data.message,
                        footer: 'Klinikmatalosari2023'
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: 'Klinikmatalosari2023'
                    })
                    formcatatanmedis($('#idpasien').val())
                }
            }
        });
    }

    function my_function() {
        document.getElementById("note").innerHTML = "";
    }
</script>
