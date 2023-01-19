<div class="card">
    <div class="card-header p-2 bg-success">
        <h5 class="mr-2">
            <i class="fas fa-notes-medical mr-2 ml-2"></i> Hasil Pemeriksaan
        </h5>
    </div><!-- /.card-header -->
    <div class="card-body scroll">
        <form action="" class="formpemeriksaanperawat">
            <table class="table table-sm">
                <tr>
                    <td>Tanggal & Jam Kunjungan</td>
                    <td><input readonly type="text" class="form-control" value="{{ $kunjungan[0]->tgl_masuk }}"
                            name="tgljamkunjungan"></td>
                    <td>Tanggal & Jam Pemeriksaan</td>
                    <td>
                        <input type="text" name="tanggalperiksa" class="form-control"
                            value="{{ $asskep[0]->tgl_pemeriksaan}}" />
                    </td>
                </tr>
                <tr>
                    <td>Sumber Data</td>
                    <td colspan="3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-2 mr-3" type="radio" name="sumberdataperiksa"
                                id="sumberdataperiksa" value="Pasien Sendiri" @if($asskep[0]->sumber_data == 'Pasien Sendiri') checked @endif>
                            <label class="form-check-label" for="inlineRadio1">Pasien Sendiri / Autoanamase </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input mr-3" type="radio" name="sumberdataperiksa"
                                id="sumberdataperiksa" value="Keluarga" @if($asskep[0]->sumber_data == 'Keluarga') checked @endif>
                            <label class="form-check-label" for="inlineRadio2">Keluarga / Alloanamnesa</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Keluhan Pasien</td>
                    <td colspan="3">
                        <textarea class="form-control" name="keluhanutama" id="">{{ $asskep[0]->keluhan_pasien }} </textarea>
                    </td>
                </tr>
                <tr class="bg-secondary">
                    <td colspan="4">ANAMNESA</td>
                </tr>
                <tr>
                    <td>Tekanan Darah</td>
                    <td>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control form-control-md" name="tekanandarah"
                                id="tekanandarah" value="{{ $asskep[0]->tekanan_darah }}" />
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
                                id="frekuensinapas" value="{{ $asskep[0]->frekuensi_nafas }}" />
                            <div class="input-group-append">
                                <div class="input-group-text text-md">X / Menit</div>
                            </div>
                        </div>
                    </td>
                    <td>Suhu</td>
                    <td>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control form-control-md" name="suhutubuh"
                                id="suhutubuh" value="{{ $asskep[0]->suhu_tubuh }}"/>
                            <div class="input-group-append">
                                <div class="input-group-text text-md">°C</div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Riwayat Alergi</td>
                    <td colspan="3">
                        <div class="row">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-2 mr-3" type="radio" name="alergi" id="alergi"
                                    value="Tidak Ada" @if($asskep[0]->riwayat_alergi == 'Tidak Ada') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input mr-3" type="radio" name="alergi" id="alergi"
                                    value="Ada"  @if($asskep[0]->riwayat_alergi == 'Ada') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Ada</label>
                                <div class="form-group form-check">
                                    <textarea class="form-control" id="ketalergi" name="ketalergi" placeholder="keterangan alergi ...">
                                       {{ trim($asskep[0]->keterangan_alergi) }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="col-md-12 justify-content-end mb-2">
                <button type="button" class="btn btn-success float-right mr-2 simpanhasilperawat mb-3"
                    onclick="simpanhasilperawat()">Simpan</button>
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
        $('input[name="tanggalperiksa"]').daterangepicker({
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

    function simpanhasilperawat() {
        var data = $('.formpemeriksaanperawat').serializeArray();
        spinner = $('#loader2');
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                idkunjungan  : $('#idkunjungan').val(),
                kodekunjungan : $('#kodekunjungan').val(),
                idpasien : $('#idpasien').val()
            },
            url: '<?= route('simpanpemeriksaanperawat') ?>',
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
