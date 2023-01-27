<div class="card">
    <div class="card-header p-2 bg-success">
        <h5 class="mr-2">
            <i class="fas fa-notes-medical mr-2 ml-2"></i> Hasil Pemeriksaan
        </h5>
    </div><!-- /.card-header -->
    <div class="card-body scroll">
        <form action="" class="formpemeriksaan">
            <input type="text" hidden name="idaskep"  id="idaskep" value="{{ $asskep[0]->id }}">
            <table class="table table-sm">
                <tr>
                    <td>Tanggal & Jam Kunjungan</td>
                    <td><input readonly type="text" class="form-control" value="{{$kunjungan[0]->tgl_masuk }}" name="tgljamkunjungan"></td>
                    <td>Tanggal & Jam Pemeriksaan</td>
                    <td><input type="text" class="form-control" value="{{ $now }}" id="tgljampemeriksaan" name="tgljampemeriksaan"></td>
                </tr>
                <tr>
                    <td>Sumber Data</td>
                    <td colspan="2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-2 mr-3" type="radio" name="sumberdataperiksa"
                                id="sumberdataperiksa" value="Pasien Sendiri " checked>
                            <label class="form-check-label" for="inlineRadio1">Pasien Sendiri / Autoanamase </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input mr-3" type="radio" name="sumberdataperiksa"
                                id="sumberdataperiksa" value="Keluarga">
                            <label class="form-check-label" for="inlineRadio2">Keluarga / Alloanamnesa</label>
                        </div>
                    </td>
                </tr>
                <tr class="bg-secondary">
                    <td colspan="4">ANAMNESA</td>
                </tr>
                <tr>
                    <td colspan="4" class="bg-secondary">Tanda - Tanda Vital</td>
                </tr>
                <tr>
                    <td>Tekanan Darah</td>
                    <td>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control form-control-md" name="tekanandarah"
                                id="tekanandarah" value="{{ $asskep[0]->tekanan_darah }}"/>
                            <div class="input-group-append">
                                <div class="input-group-text text-md">mmHg</div>
                            </div>
                        </div>
                    </td>
                    <td>Frekuensi Nadi</td>
                    <td>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control form-control-md" name="frekuensinadi"
                                id="frekuensinadi" value="{{ $asskep[0]->frekuensi_nadi }}" />
                            <div class="input-group-append">
                                <div class="input-group-text text-md">X / Menit</div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Frekuensi Napas</td>
                    <td>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control form-control-md" name="frekuensinapas"
                                id="frekuensinapas" value="{{ $asskep[0]->frekuensi_nafas }}"/>
                            <div class="input-group-append">
                                <div class="input-group-text text-md">X / Menit</div>
                            </div>
                        </div>
                    </td>
                    <td>Suhu</td>
                    <td>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control form-control-md" name="suhutubuh"
                                id="suhutubuh" value="{{ $asskep[0]->suhu_tubuh }}" />
                            <div class="input-group-append">
                                <div class="input-group-text text-md">°C</div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Keluhan Utama</td>
                    <td colspan="3">
                        <textarea cols="10" rows="4" class="form-control" name="keluhanutama" id="keluhanutama">{{ $kunjungan[0]->keluhan}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="bg-secondary">Riwayat Kesehatan</td>
                </tr>
                <tr>
                    <td>Riwayat Kehamilan (bagi pasien wanita) </td>
                    <td colspan="3">
                        <textarea name="riwayatkehamilan" cols="10" rows="4" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Riwayat Kelahiran (bagi pasien anak) </td>
                    <td colspan="3">
                        <textarea name="riwayatkelahiran" cols="10" rows="4" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Riwayat Penyakit Sekarang</td>
                    <td colspan="3">
                        <textarea name="riwayatpenyakitsekarang" cols="10" rows="4" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Riwayat Penyakit Dahulu</td>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="hipertensi"
                                        name="hipertensi" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Hipertensi</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="kencingmanis"
                                        name="kencingmanis" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Kencing Manis</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="jantung" name="jantung"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Jantung</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="stroke" name="stroke"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Stroke</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="hepatitis" name="hepatitis"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Hepatitis</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="asthma" name="asthma"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Asthma</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="ginjal" name="ginjal"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Ginjal</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="tb" name="tb"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">TB Paru</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="riwayatlain"
                                        name="riwayatlain" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Lain-lain</label>
                                </div>
                            </div>
                            <textarea name="ketriwayatlain" id="ketriwayatlain" class="form-control" placeholder="keterangan lain - lain"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Riwayat Alergi</td>
                    <td colspan="3">
                        <div class="row">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-2 mr-3" type="radio" name="alergi"
                                    id="alergi" value="Tidak Ada" checked>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input mr-3" type="radio" name="alergi" id="alergi"
                                    value="Ada">
                                <label class="form-check-label" for="inlineRadio2">Ada</label>
                                <div class="form-group form-check">
                                    <input class="form-control" id="ketalergi" name="ketalergi"
                                        placeholder="keterangan alergi ...">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Status Generalis</td>
                    <td>
                        <input type="text" class="form-control" name="statusgeneralis" id="statusgeneralis">
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="bg-secondary">Pemeriksaan Umum</td>
                </tr>
                <tr>
                    <td>Keadaan Umum</td>
                    <td colspan="3">
                        <textarea class="form-control" name="keadaanumum"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Kesadaran</td>
                    <td colspan="3">
                        <textarea class="form-control" name="kesadaran"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Diagnosa Kerja</td>
                    <td colspan="3">
                        <textarea class="form-control" name="diagnosakerja"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Diagnosa banding</td>
                    <td colspan="2">
                        <textarea name="diagnosabanding" class="form-control"></textarea>
                    </td>
                    <td><button type="button" class="btn btn-warning showmodalicd" data-toggle="modal"
                            data-target="#modalicd">ICD 10</button>
                        <button type="button" class="btn btn-danger showmodalicd9" data-toggle="modal"
                            data-target="#modalicd9">ICD 9</button>
                    </td>
                </tr>
                <tr>
                    <td>Rencana Kerja</td>
                    <td colspan="3">
                        <textarea class="form-control" name="rencanakerja"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="bg-secondary">Pemeriksaan Khusus</td>
                </tr>
                <tr>
                    <td rowspan="2">Visus Dasar</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">OD</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"
                                id="od_visus_dasar" name="od_visus_dasar" value="">
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">PINHOLE</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"
                                name="od_pinhole_visus_dasar" id="od_pinhole_visus_dasar" value="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">OS</span>
                            </div>
                            <input name="os_visus_dasar" id="os_visus_dasar" value="" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">PINHOLE</span>
                            </div>
                            <input name="os_pinhole_visus_dasar" id="os_pinhole_visus_dasar" type="text"
                                class="form-control" value="" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Refraktometer / streak</td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">OD : Sph</span>
                            </div>
                            <input name="od_sph_refraktometer" value="" id="od_sph_refraktometer"
                                type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cyl</span>
                            </div>
                            <input type="text" value="" id="od_cyl_refraktometer"
                                name="od_cyl_refraktometer" class="form-control"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">X</span>
                            </div>
                            <input id="od_x_refraktometer" value="" name="od_x_refraktometer" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">OS : Sph</span>
                            </div>
                            <input id="os_sph_refraktometer" value="" name="os_sph_refraktometer"
                                type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cyl</span>
                            </div>
                            <input id="os_cyl_refraktometer" value="" name="os_cyl_refraktometer"
                                type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">X</span>
                            </div>
                            <input id="os_x_refraktometer" value="" name="os_x_refraktometer" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Lensometer</td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">OD : Sph</span>
                            </div>
                            <input id="od_sph_Lensometer" value="" name="od_sph_Lensometer" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cyl</span>
                            </div>
                            <input id="od_cyl_Lensometer" value="" name="od_cyl_Lensometer" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">X</span>
                            </div>
                            <input id="od_x_Lensometer" value="" name="od_x_Lensometer" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">OS : Sph</span>
                            </div>
                            <input id="os_sph_Lensometer" value="" name="os_sph_Lensometer" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cyl</span>
                            </div>
                            <input id="os_cyl_Lensometer" value="" name="os_cyl_Lensometer" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">X</span>
                            </div>
                            <input id="os_x_Lensometer" value="" name="os_x_Lensometer" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Koreksi penglihatan jauh</td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">VOD : Sph</span>
                            </div>
                            <input id="vod_sph_kpj" value="" name="vod_sph_kpj" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cyl</span>
                            </div>
                            <input id="vod_cyl_kpj" value="" name="vod_cyl_kpj" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">X</span>
                            </div>
                            <input id="vod_x_kpj" value="" name="vod_x_kpj" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">VOS : Sph</span>
                            </div>
                            <input type="text" id="vos_sph_kpj" value="" name="vos_sph_kpj"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cyl</span>
                            </div>
                            <input id="vos_cyl_kpj" value="" name="vos_cyl_kpj" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">X</span>
                            </div>
                            <input id="vos_x_kpj" value="" name="vos_x_kpj" type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Tajam penglihatan dekat</td>
                    <td colspan="3">
                        <textarea class="form-control" value="" id="penglihatan_dekat" name="penglihatan_dekat"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Tekanan Intra Okular</td>
                    <td colspan="3">
                        <textarea class="form-control" value="" id="tekanan_intra_okular" name="tekanan_intra_okular"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Catatan Pemeriksaan Lainnya</td>
                    <td colspan="3">
                        <textarea class="form-control" value="" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Palpebra</td>
                    <td colspan="3"><input class="form-control" value="" id="palpebra"
                            name="palpebra"></input></td>
                </tr>
                <tr>
                    <td>Konjungtiva</td>
                    <td colspan="3"><input class="form-control" value="" id="konjungtiva"
                            name="konjungtiva"></input></td>
                </tr>
                <tr>
                    <td>Kornea</td>
                    <td colspan="3"><input class="form-control" value="" name="kornea"
                            id="kornea"></input></td>
                </tr>
                <tr>
                    <td>Bilik Mata Depan</td>
                    <td colspan="3"><input class="form-control" value="" name="bilik_mata_depan"
                            id="bilik_mata_depan"></input></td>
                </tr>
                <tr>
                    <td>Pupil</td>
                    <td colspan="3"><input class="form-control" value="" id="pupil"
                            name="pupil"></input></td>
                </tr>
                <tr>
                    <td>Iris</td>
                    <td colspan="3"><input class="form-control" value="" name="iris"
                            id="iris"></input></td>
                </tr>
                <tr>
                    <td>Lensa</td>
                    <td colspan="3"><input class="form-control" value="" name="lensa"
                            id="lensa"></input></td>
                </tr>
                <tr>
                    <td>Funduskopi</td>
                    <td colspan="3"><input class="form-control" value="" name="funduskopi"
                            id="funduskopi"></input></td>
                </tr>
                <tr>
                    <td>Status Oftalmologis Khusus</td>
                    <td colspan="3">
                        <textarea class="form-control" value="" name="oftamologis" id="oftamologis"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Masalah Medis</td>
                    <td colspan="3">
                        <textarea class="form-control" value="" name="masalahmedis" id="masalahmedis"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Prognosis</td>
                    <td colspan="3">
                        <textarea class="form-control" value="" name="prognosis" id="prognosis"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Penandaan Gambar</td>
                    <td colspan="3">
                        <div class="gambar1">

                        </div>
                        <div class="gambar2">

                        </div>
                    </td>
                </tr>
            </table>
            <table hidden class="table text-bold table-md text-md mt-4">
                <thead class="bg-info">
                    <!-- <th class="text-center">Tanggal Assesmen Dokter</th> -->
                    <th class="text-center">Nama Dokter</th>
                    <!-- <th>Tanda Tangan Dokter</th> -->
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>
                            <input readonly type="text" class="form-control text-center"
                                value="{{ strtoupper(auth()->user()->name) }}" name="namapemeriksa">
                            <input hidden type="text" class="form-control"
                                value="{{ strtoupper(auth()->user()->id) }}" id="idpemeriksa" name="idpemeriksa">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="col-md-12 justify-content-end mb-2">
                <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success float-right mr-2 simpanhasildokter mb-3"
                    onclick="simpanhasil()">Simpan</button>
            </div>
        </form>
    </div><!-- /.card-body -->
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    $(function() {
        $('input[name="tgljampemeriksaan"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            timePicker24Hour: true,
            timePickerSeconds: true,
            minYear: 2023,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss',
                locale: 'id'
            }
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
        });
    });
    $(document).ready(function() {
        ambilgambar1()
        ambilgambar2()

        function ambilgambar1() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('gambarmata1') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    spinner.hide()
                    $('.gambar1').html(response)
                }
            });
        }

        function ambilgambar2() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('gambarmata2') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    spinner.hide()
                    $('.gambar2').html(response)
                }
            });
        }

    });

    function simpanhasil() {
        var canvas = document.getElementById("myCanvas1");
        var ctx = canvas.getContext("2d");
        var img = document.getElementById("gambarnya1");
        ctx.drawImage(img, 10, 10);
        var canvas = document.getElementById("myCanvas1");
        var dataUrl = canvas.toDataURL();
        $('#gambarmata1').val(dataUrl)
        gambar1 = $('#gambarmata1').val()

        var canvas = document.getElementById("myCanvas2");
        var ctx = canvas.getContext("2d");
        var img = document.getElementById("gambarnya2");
        ctx.drawImage(img, 10, 10);
        var canvas = document.getElementById("myCanvas2");
        var dataUrl = canvas.toDataURL();
        $('#gambarmata2').val(dataUrl)
        gambar2 = $('#gambarmata2').val()
        var data = $('.formpemeriksaan').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                idkunjungan  : $('#idkunjungan').val(),
                kodekunjungan : $('#kodekunjungan').val(),
                idpasien : $('#idpasien').val(),
                idpasien : $('#idpasien').val(),
                idaskep : $('#idaskep').val(),
                gambar1,
                gambar2
            },
            url: '<?= route('simpanpemeriksaandokter') ?>',
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
                }
            }
        });
    }
</script>
