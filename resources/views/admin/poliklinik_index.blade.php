@extends('adminlte::page')
@section('title', 'Poliklinik')
@section('content_header')
    <h1 class="m-0 text-dark">Poliklinik</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Data Poliklinik" theme="secondary" collapsible>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <x-adminlte-button label="Tambah" class="btn-sm btnTambah" theme="success" title="Tambah Pasien"
                            icon="fas fa-plus" />
                        <a href="{{ route('pasien.index') }}" class="btn btn-sm btn-warning"><i
                                class="fas fa-sync"></i>Refresh</a>
                    </div>
                </div>
                @php
                    $heads = ['No', 'Kode Poli', 'Nama Poli','Kode Subspesialis', 'Nama Subspesialis',  'Status'];
                    $config['searching'] = true;
                    $config['paging'] = true;
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" :config="$config" hoverable bordered
                    compressed>
                    @foreach ($polikliniks as $item)
                        <tr class="btnEdit" data-id="{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kodepoli }}</td>
                            <td>{{ $item->namapoli }}</td>
                            <td>{{ $item->kodesubspesialis }}</td>
                            <td>{{ $item->namasubspesialis }}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
    <x-adminlte-modal id="modal" title="Data Poliklinik" theme="success" v-centered>
        <form action="" id="form">
            @csrf
            <input type="hidden" id="id" name="id">
            <x-adminlte-input name="kodepoli" label="Kode Poliklinik" igroup-size="sm" enable-old-support />
            <x-adminlte-input name="namapoli" label="Nama Poliklinik" igroup-size="sm" enable-old-support />
            <x-adminlte-input name="kodesubspesialis" label="Kode Subspesialis" igroup-size="sm" enable-old-support />
            <x-adminlte-input name="namasubspesialis" label="Nama Subspesialis" igroup-size="sm" enable-old-support />
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
                var id = $(this).data('id');
                $.LoadingOverlay("show");
                $.get("{{ route('poliklinik.index') }}" + '/' + id, function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#kodepoli').val(data.kodepoli);
                    $('#namapoli').val(data.namapoli);
                    $('#kodesubspesialis').val(data.kodesubspesialis);
                    $('#namasubspesialis').val(data.namasubspesialis);
                    if (data.status == 1) {
                        $('#status').prop('checked', true).trigger('change');
                    } else {
                        $('#status').prop('checked', false).trigger('change');
                    }

                    $.LoadingOverlay("hide", true);
                    $('#btnUpdate').show();
                    $('#btnStore').hide();
                    $('#modal').modal('show');
                })

            });
            $('#btnStore').click(function(e) {
                $.LoadingOverlay("show");
                e.preventDefault();
                var url = "{{ route('poliklinik.store') }}";
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
                var url = "{{ route('poliklinik.index') }}/" + id;
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
@endsection
