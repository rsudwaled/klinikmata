@extends('adminlte::page')
@section('title', 'Barang')
@section('content_header')
    <h1 class="m-0 text-dark">Barang</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Barang" theme="secondary" collapsible>
                <div class="row">
                    <div class="col-md-8 mb-2">
                        <x-adminlte-button label="Tambah" class="btn-sm btnTambah" theme="success" title="Tambah Pasien"
                            icon="fas fa-plus" />
                        <x-adminlte-button label="Import" class="btn-sm btnImport" theme="warning" title="Import"
                            icon="fas fa-plus" />
                        <x-adminlte-button label="Refresh" class="btn-sm" theme="warning" title="Refresh Halaman"
                            icon="fas fa-sync" onclick="location.reload();" />
                    </div>
                </div>
                @php
                    $heads = ['No', 'Kode', 'Barcode', 'Nama Barang', 'Kategori', 'Jenis', 'Stok', 'Status', 'Updated at'];
                    $config['scrollY'] = '400px';
                    $config['paging'] = false;
                    $config['scrollCollapse'] = true;
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" :config="$config" hoverable bordered
                    compressed>
                    @foreach ($barangs as $item)
                        <tr class="btnEdit" data-id="{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->kode }}</td>
                            <td></td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->satuan ? $item->satuan->nama : '-' }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>
                                @if ($item->status)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Non-Aktif</span>
                                @endif
                            </td>
                            <td>{{ $item->updated_at }} ({{ $item->user_entry }})</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
    <x-adminlte-modal id="modalImport" title="Import Data Obat" theme="success" v-centered>
        <form id="formImport" method="POST" action="{{ route('barang.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="file" required="required">
            </div>
        </form>
        <x-slot name="footerSlot">
            <x-adminlte-button type="submit" class="mr-auto " form="formImport" theme="success" icon="fas fa-save"
                label="Import" />
            <x-adminlte-button theme="secondary" icon="fas fa-arrow-left" label="Kembali" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="modal" title="Data Barang" theme="success" v-centered>
        <form action="" id="form">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input id="id" type="hidden" name="id">
                    <x-adminlte-input name="kode" label="Kode" igroup-size="sm" enable-old-support required readonly />
                    <x-adminlte-input name="nama" label="Nama Barang" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="barcode" label="Barcode" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input-switch name="status" igroup-size="sm" label="Status Aktif" data-on-text="YES"
                        data-off-text="NO" data-on-color="primary" />
                </div>
                <div class="col-md-6">
                    {{-- <x-adminlte-select name="satuan_id" label="Satuan Obat" igroup-size="sm" enable-old-support required>
                        <option selected disabled>Pilih Satuan Obat</option>
                        @foreach ($satuan as $id => $nama)
                            <option value="{{ $id }}">{{ $nama }}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-select name="jenis" label="Jenis Obat" igroup-size="sm" enable-old-support required>
                        <option value="Oral">Oral</option>
                        <option value="Tetes">Tetes</option>
                        <option value="Oles">Oles</option>
                    </x-adminlte-select> --}}

                </div>
            </div>
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
                $.get("{{ route('barang.index') }}" + '/' + id, function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#kode').val(data.kode);
                    $('#barcode').val(data.barcode);
                    $('#nama').val(data.nama);
                    $('#satuan_id').val(data.satuan_id).trigger('change');
                    $('#jenis').val(data.jenis).trigger('change');
                    if (data.status == 1) {
                        $('#status').prop('checked', true).trigger('change');
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
                var url = "{{ route('barang.store') }}";
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
                var url = "{{ route('barang.index') }}/" + id;
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
            $('.btnImport').click(function() {
                $('#modalImport').modal('show');
            });
        });
    </script>
@endsection
