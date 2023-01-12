<div class="card">
    <div class="card-header p-2">
        <h5 class="mr-2">
            Hasil Pemeriksaan
        </h5>
    </div><!-- /.card-header -->
    <div class="card-body scroll">
        <form action="" class="formpemeriksaan">
                    <table class="table table-sm">
                        <tr>
                            <td>Tanggal & Jam Kunjungan</td>
                            <td><input readonly type="text" class="form-control" value="" name="tgljamkunjungan"></td>
                            <td>Tanggal & Jam Pemeriksaan</td>
                            <td><input type="text" class="form-control" value="" name="tgljampemeriksaan"></td>
                        </tr>
                        <tr>
                            <td>Sumber Data</td>
                            <td colspan="2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input ml-2 mr-3" type="radio" name="sumberdataperiksa" id="sumberdataperiksa" value="Pasien Sendiri " checked>
                                    <label class="form-check-label" for="inlineRadio1">Pasien Sendiri / Autoanamase </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input mr-3" type="radio" name="sumberdataperiksa" id="sumberdataperiksa" value="Keluarga">
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
                                    <input type="text" class="form-control form-control-md" name="tekanandarah" id="tekanandarah"/>
                                    <div class="input-group-append">
                                        <div class="input-group-text text-md">mmHg</div>
                                    </div>
                                </div>
                            </td>
                            <td>Frekuensi Nadi</td>
                            <td>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-md" name="frekuensinadi" id="frekuensinadi" />
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
                                    <input type="text" class="form-control form-control-md" name="frekuensinapas" id="frekuensinapas"/>
                                    <div class="input-group-append">
                                        <div class="input-group-text text-md">X / Menit</div>
                                    </div>
                                </div>
                            </td>
                            <td>Suhu</td>
                            <td>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-md" name="suhutubuh" id="suhutubuh" />
                                    <div class="input-group-append">
                                        <div class="input-group-text text-md">°C</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Keluhan Utama</td>
                            <td colspan="3"><textarea cols="10" rows="4" class="form-control" name="keluhanutama" id="keluhanutama"></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="bg-secondary">Riwayat Kesehatan</td>
                        </tr>
                        <tr>
                            <td>Riwayat Kehamilan (bagi pasien wanita) </td>
                            <td colspan="3"><textarea name="riwayatkehamilan" cols="10" rows="4" class="form-control"></textarea></td>
                        </tr>
                        <tr>
                            <td>Riwayat Kelahiran (bagi pasien anak) </td>
                            <td colspan="3"><textarea name="riwayatkelahiran" cols="10" rows="4" class="form-control"></textarea></td>
                        </tr>
                        <tr>
                            <td>Riwayat Penyakit Sekarang</td>
                            <td colspan="3"><textarea name="riwayatpenyakitsekarang" cols="10" rows="4" class="form-control"></textarea></td>
                        </tr>
                        <tr>
                            <td>Riwayat Penyakit Dahulu</td>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="hipertensi" name="hipertensi" value="1">
                                            <label class="form-check-label" for="exampleCheck1">Hipertensi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="kencingmanis" name="kencingmanis" value="1">
                                            <label class="form-check-label" for="exampleCheck1">Kencing Manis</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="jantung" name="jantung" value="1">
                                            <label class="form-check-label" for="exampleCheck1">Jantung</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="stroke" name="stroke" value="1">
                                            <label class="form-check-label" for="exampleCheck1">Stroke</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="hepatitis" name="hepatitis" value="1">
                                            <label class="form-check-label" for="exampleCheck1">Hepatitis</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="asthma" name="asthma" value="1">
                                            <label class="form-check-label" for="exampleCheck1">Asthma</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="ginjal" name="ginjal" value="1">
                                            <label class="form-check-label" for="exampleCheck1">Ginjal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="tb" name="tb" value="1">
                                            <label class="form-check-label" for="exampleCheck1">TB Paru</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="riwayatlain" name="riwayatlain" value="1">
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
                                        <input class="form-check-input ml-2 mr-3" type="radio" name="alergi" id="alergi" value="Tidak Ada" checked>
                                        <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mr-3" type="radio" name="alergi" id="alergi" value="Ada">
                                        <label class="form-check-label" for="inlineRadio2">Ada</label>
                                        <div class="form-group form-check">
                                            <input class="form-control" id="ketalergi" name="ketalergi" placeholder="keterangan alergi ...">
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
                                <textarea class="form-control" id="diagnosapembanding" name="diagnosapembanding"></textarea>
                            </td>
                            <td><button type="button" class="btn btn-info showmodalicd" data-toggle="modal" data-target="#modalicd">ICD 10</button></td>
                        </tr>
                        <tr>
                            <td>Rencana Kerja</td>
                            <td colspan="3">
                                <textarea class="form-control" name="rencanakerja"></textarea>
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
                                    <input readonly type="text" class="form-control text-center" value="{{ strtoupper(auth()->user()->name) }}" name="namapemeriksa">
                                    <input hidden type="text" class="form-control" value="{{ strtoupper(auth()->user()->id) }}" id="idpemeriksa" name="idpemeriksa">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-12 justify-content-end mb-2">
                        <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success float-right mr-2 simpanhasildokter mb-3">Simpan</button>
                    </div>
        </form>
    </div><!-- /.card-body -->
</div>
