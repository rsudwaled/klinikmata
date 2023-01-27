@extends('adminlte::page')
@section('title', 'Ruangan')
@section('content_header')
    <h1 class="m-0 text-dark">Ruangan</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Data Ruangan" theme="secondary" collapsible>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <x-adminlte-button label="Tambah" class="btn-sm btnTambah" theme="success" title="Tambah Pasien"
                            icon="fas fa-plus" />
                        <a href="{{ route('pasien.index') }}" class="btn btn-sm btn-warning"><i
                                class="fas fa-sync"></i>Refresh</a>
                    </div>
                </div>
                @php
                    $heads = ['No', 'Nama', 'Deskripsi', 'Lokasi', 'Lantai', 'Status'];
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($ruangans as $poliklinik)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $poliklinik->nama }}</td>
                            <td>{{ $poliklinik->deskripsi }}</td>
                            <td>{{ $poliklinik->lokasi }}</td>
                            <td>{{ $poliklinik->lantai }}</td>
                            <td>{{ $poliklinik->status }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
    <x-adminlte-modal id="modal" title="Data Poliklinik" theme="success" v-centered>
        <form action="" id="form">
            @csrf
            <x-adminlte-input name="kode_poli" label="Kode Poliklinik" igroup-size="sm" enable-old-support />
            <x-adminlte-input name="nama_poli" label="Nama Poliklinik" igroup-size="sm" enable-old-support />
            <x-adminlte-input name="kode_subspesialis" label="Kode Subspesialis" igroup-size="sm" enable-old-support />
            <x-adminlte-input name="nama_subspesialis" label="Nama Subspesialis" igroup-size="sm" enable-old-support />
            <x-adminlte-input-switch name="status" igroup-size="sm" label="Status Aktif" data-on-text="YES"
                data-off-text="NO" data-on-color="primary" />
        </form>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto " id="btnStore" theme="success" icon="fas fa-save" label="Simpan" />
            <x-adminlte-button class="mr-auto" id="btnUpdate" theme="warning" icon="fas fa-edit" label="Update" />
            <x-adminlte-button id="btnDelete" theme="danger" icon="fas fa-trash-alt" label="Delete" />
            <x-adminlte-button theme="secondary" icon="fas fa-arrow-left" label="Kembali" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
@stop

@section('plugins.Datatables', true)
@section('plugins.BootstrapSwitch', true)
@section('js')
    <script>
        $(function() {
            $('.btnTambah').click(function() {
                $('#form').trigger("reset");
                $('#modal').modal('show');
                $('#btnUpdate').hide();
                $('#btnDelete').hide();
                $('#btnStore').show();
            });
            $('.btnEdit').click(function() {
                var jadwalid = $(this).data('id');
                $.LoadingOverlay("show");
                $.get("{{ route('pasien.index') }}" + '/' + jadwalid + '/edit', function(data) {
                    console.log(data);
                    $('#id').val(data.id);

                    $('#nik').val(data.nik);
                    $('#no_rm').val(data.no_rm);
                    $('#no_ihs').val(data.no_ihs);
                    $('#no_bpjs').val(data.no_bpjs);

                    $('#nama').val(data.nama);
                    $('#sex').val(data.sex).trigger('change');
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tgl_lahir').val(data.tgl_lahir);
                    $('#nohp').val(data.nohp);

                    $('#provinsi').val(data.provinsi).trigger('change');
                    $('#kabupaten').append(new Option(data.nama_kabupaten, data.kabupaten));
                    $('#kecamatan').append(new Option(data.nama_kecamatan, data.kecamatan));
                    $('#desa').append(new Option(data.nama_desa, data.desa));
                    $('#alamat').val(data.alamat);

                    $.LoadingOverlay("hide", true);
                    $('#btnUpdate').show();
                    $('#btnStore').hide();
                    $('#modal').modal('show');
                })

            });
            $('#btnStore').click(function(e) {
                $.LoadingOverlay("show");
                e.preventDefault();
                var url = "{{ route('pasien.store') }}";
                $.ajax({
                    data: $('#form').serialize(),
                    url: url,
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil disimpan',
                        }).then(okay => {
                            if (okay) {
                                $.LoadingOverlay("show");
                                location.reload();
                            }
                        });
                        $.LoadingOverlay("hide");
                    },
                    error: function(data) {
                        console.log(data);
                        swal.fire({
                            icon: 'error',
                            title: 'Error ' + data.statusText,
                            text: data.responseJSON.metadata.message,
                        });
                        $.LoadingOverlay("hide");
                    }
                });
            });
            $('#btnUpdate').click(function(e) {
                var id = $("#id").val()
                $.LoadingOverlay("show");
                e.preventDefault();
                var url = "{{ route('pasien.index') }}/" + id;
                $.LoadingOverlay("hide");
                $.ajax({
                    data: $('#form').serialize(),
                    url: url,
                    type: "PUT",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil disimpan',
                        }).then(okay => {
                            if (okay) {
                                $.LoadingOverlay("show");
                                location.reload();
                            }
                        });
                        $.LoadingOverlay("hide");
                    },
                    error: function(data) {
                        console.log(data);
                        swal.fire({
                            icon: 'error',
                            title: 'Error ' + data.status,
                            text: data.statusText,
                        });
                        $.LoadingOverlay("hide");
                    }
                });
            });
            $('#btnDelete').click(function(e) {
                Swal.fire({
                    title: 'Konfirmasi Hapus Data',
                    text: 'Apakah anda akan menghapus data ini ?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Ya,  Hapus',
                    denyButtonText: `Tidak`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Data berhasil dihapus', '', 'success')
                    } else if (result.isDenied) {
                        Swal.fire('Data tidak jadi dihapus', '', 'info')
                    }
                })
            });
        });
    </script>
    <script>
        $(function() {
            $("#provinsi").select2({
                theme: "bootstrap4",
                ajax: {
                    url: "{{ route('get_provinsi') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 100,
                    data: function(params) {
                        return {
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
            $("#kabupaten").select2({
                theme: "bootstrap4",
                ajax: {
                    url: "{{ route('get_kabupaten') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 100,
                    data: function(params) {
                        return {
                            code: $("#provinsi option:selected").val(),
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
            $("#kecamatan").select2({
                theme: "bootstrap4",
                ajax: {
                    url: "{{ route('get_kecamatan') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 100,
                    data: function(params) {
                        return {
                            code: $("#kabupaten option:selected").val(),
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
            $("#desa").select2({
                theme: "bootstrap4",
                ajax: {
                    url: "{{ route('get_desa') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 100,
                    data: function(params) {
                        return {
                            code: $("#kecamatan option:selected").val(),
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection
