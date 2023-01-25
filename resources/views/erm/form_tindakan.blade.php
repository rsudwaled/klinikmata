<div class="card">
    <div class="card-header p-2 bg-warning">
        <h5 class="mr-2">
            <i class="fas fa-notes-medical mr-2 ml-2"></i> Input Tindakan
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <table id="tabeltarif" class="table table-sm table-bordered">
                    <thead>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($tarif as $t)
                            <tr>
                                <td>{{ $t->nama }}</td>
                                <td>{{ money($t->harga, 'IDR') }}</td>
                                <td><button kode="{{ $t->kode }}" tarif="{{ $t->harga }}"
                                        nama="{{ $t->nama }}"
                                        class="badge badge-danger pilihlayanan">Pilih</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <div class="container">
                    <div class="card mt-5">
                        <div class="card-header bg-success">Tindakan / Layanan Pasien</div>
                        <div class="card-body">
                            <form action="" method="post" class="formtindakan">
                                <div class="input_fields_wrap">
                                    <div>
                                    </div>
                                    <button type="button" class="btn btn-warning mb-2 simpanlayanan"
                                        id="simpanlayanan">Simpan Tindakan</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p>pilih layanan untuk pasien</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabeltarif").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
    $('#tabeltarif').on('click', '.pilihlayanan', function() {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var x = 1; //initlal text box count
        kode = $(this).attr('kode')
        namatindakan = $(this).attr('nama')
        tarif = $(this).attr('tarif')
        // e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                kode +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                tarif +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Cyto</label><input type="" class="form-control form-control-sm" id="" name="cyto" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger">X</i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
    $(".simpanlayanan").click(function() {
            var data = $('.formtindakan').serializeArray();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                    idkunjungan  : $('#idkunjungan').val(),
                    kodekunjungan : $('#kodekunjungan').val(),
                },
                url: '<?= route('simpantindakan') ?>',
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Sepertinya ada masalah ...',
                        footer: ''
                    })
                },
                success: function(data) {
                    if (data.kode == 502) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                            footer: ''
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'OK',
                            text: 'Data berhasil disimpan!',
                            footer: ''
                        })
                    }
                }
            });
        });
</script>
