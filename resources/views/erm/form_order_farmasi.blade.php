<div class="card">
    <div class="card-header p-2 bg-danger">
        <h5 class="mr-2">
            <i class="fas fa-notes-medical mr-2 ml-2"></i> Order Farmasi
        </h5>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <table id="tabelbarang" class="table table-sm table-bordered">
                    <thead>
                        <th>Harga</th>
                        <th>Jenis</th>
                        <th>Nama</th>
                        <th>stok</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($barang as $b )
                        <tr>
                            <td>{{ $b->nama}}</td>
                            <td>{{ $b->jenis_id}}</td>
                            <td>{{ $b->harga_jual}}</td>
                            <td>{{ $b->stok}}</td>
                            <td><button class="badge badge-danger badge-sm pilihbarang" nama="{{ $b->nama}}" harga="{{ $b->harga_jual}}" kode="{{ $b->kode}}" satuan="{{ $b->statuan_id }}" id="{{ $b->id }}">Pilih</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <div class="container">
                    <div class="card mt-5">
                        <div class="card-header bg-success">Order Farmasi / Optic </div>
                        <div class="card-body">
                            <form action="" method="post" class="formorder">
                                <div class="input_fields_wrap">
                                    <div>
                                    </div>
                                    <button type="button" class="btn btn-warning mb-2 simpanorder"
                                        id="simpanlayanan">Simpan Order</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header bg-info">Order Hari Ini</div>
                        <div class="card-body">
                            <div class="riwayatorderhariini">

                            </div>
                        </div>
                        <div class="card-footer">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.card-body -->
</div>
<script>
      $(document).ready(function() {
        ambilriwayatorder()
      })
    function ambilriwayatorder()
    {
        $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    idkunjungan  : $('#idkunjungan').val(),
                    kodekunjungan : $('#kodekunjungan').val(),
                },
                url: '<?= route('ambilriwayatorder') ?>',
                error: function(data) {
                    alert('errror')
                },
                success: function(response) {
                    spinner.hide()
                    $('.riwayatorderhariini').html(response)
                }
            });
    }
    $(function() {
        $("#tabelbarang").DataTable({
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
    $('#tabelbarang').on('click', '.pilihbarang', function() {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var x = 1; //initlal text box count
        id = $(this).attr('id')
        kode = $(this).attr('kode')
        namatindakan = $(this).attr('nama')
        tarif = $(this).attr('harga')
        satuan = $(this).attr('satuan')
        // e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Obat</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                kode +
                '"></div><div hidden class="form-group col-md-2"><label for="inputPassword4">Harga</label><input  type="" class="form-control form-control-sm" id="" name="idlayanan" value="' +
                id +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Harga</label><input  type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                tarif +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Satuan</label><input type="" class="form-control form-control-sm" id="" name="satuan" value="'+ satuan +'"></div><div class="form-group col-md-2"><label for="inputPassword4">Mata Kanan</label><input type="" class="form-control form-control-sm" id="" name="matakanan" value="0"></div><div class="form-group col-md-2"><label for="inputPassword4">Mata Kiri</label><input type="" class="form-control form-control-sm" id="" name="matakiri" value="0"></div><div class="form-group col-md-2"><label for="inputPassword4">Signa</label><input type="" class="form-control form-control-sm" id="" name="signa" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger">X</i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
    $(".simpanorder").click(function() {
            var data = $('.formorder').serializeArray();
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
                },
                url: '<?= route('simpanorderfarmasi') ?>',
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
                            icon: 'warning',
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
                        ambilriwayatorder()
                    }
                }
            });
        });
</script>
