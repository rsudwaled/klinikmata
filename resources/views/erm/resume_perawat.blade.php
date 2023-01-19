<div class="card">
    <div class="card-header p-2 bg-success">
        <h5 class="mr-2">
            <i class="fas fa-notes-medical mr-2 ml-2"></i> Resume Medis
        </h5>
    </div><!-- /.card-header -->
    <div class="card-body">
        @if (count($asskep) > 0)
            <table class="table table-sm">
                <tr>
                    <td class="text-bold">Tanggal & Jam Kunjungan</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['tgl_kunjungan'] }}</td>
                    <td class="text-bold">Tanggal & Jam Pemeriksaan</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['tgl_pemeriksaan'] }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Keluhan Utama Pasien</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['keluhan_pasien'] }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Sumber Data</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['sumber_data'] }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Tekanan Darah</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['tekanan_darah'] }}</td>
                    <td class="text-bold">Frekuensi Nadi</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['frekuensi_nadi'] }} x / menit</td>
                </tr>
                <tr>
                    <td class="text-bold">Frekuensi Nafas</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['frekuensi_nafas'] }} x / menit</td>
                    <td class="text-bold">Suhu Tubuh</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['suhu_tubuh'] }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Riwayat Alergi</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['riwayat_alergi'] }}</td>
                    <td class="text-bold">Keterangan Alergi</td>
                    <td class="font-italic text-bold text-md">{{ $asskep[0]['keterangan_alergi'] }}</td>
                </tr>
            </table>
            <table class="table mt-4">
                <thead>
                    <th>Nama Perawat</th>
                    <th>Tanda Tangan</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold text-md">{{ auth()->user()->name }}</td>
                        <td>
                            @if($asskep[0]->signature == '')
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
                                <img src="{{ $asskep[0]->signature }}" alt="">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            @if($asskep[0]->signature == '')
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
            url: '<?= route('simpanttdperawat') ?>',
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
                    formcatatanmedis()
                }
            }
        });
    }

    function my_function() {
        document.getElementById("note").innerHTML = "";
    }
</script>
