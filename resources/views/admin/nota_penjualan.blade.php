@extends('adminlte::page')
@section('title', 'Nota Penjualan Barang')
@section('content_header')
    <h1 class="m-0 text-dark">Nota Penjualan Barang</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Riwayat Nota Penjualan Barang" theme="secondary" collapsible>
                <div class="row">
                    <div class="col-md-8">
                        <x-adminlte-button label="Tambah" class="btn-sm btnTambah" theme="success" title="Tambah Pasien"
                            icon="fas fa-plus" />
                        <x-adminlte-button label="Refresh" class="btn-sm" theme="warning" title="Refresh Halaman"
                            icon="fas fa-sync" onclick="location.reload();" />
                    </div>
                    {{-- <div class="col-md-4">
                        <form action="" method="get">
                            <x-adminlte-input name="search" placeholder="Pencarian NIK / Nama" igroup-size="sm"
                                value="{{ $request->search }}">
                                <x-slot name="appendSlot">
                                    <x-adminlte-button type="submit" theme="outline-primary" label="Cari" />
                                </x-slot>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text text-primary">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </form>
                    </div> --}}
                </div>
                @php
                    $heads = ['Kode', 'Tgl Faktur', 'Barang', 'Supplier', 'Qty', 'Harga Beli', 'Tgl Inpu'];
                    $config['scrollY'] = '400px';
                    $config['paging'] = false;
                    $config['scrollCollapse'] = true;
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" :config="$config" hoverable bordered
                    compressed>
                    @foreach ($nota as $item)
                        <tr class="btnEdit" data-id="{{ $item->id }}">
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->tanggal_faktur }}</td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ $item->supplier->nama }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td class="text-right">{{ money($item->harga_beli, 'IDR2') }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
    <x-adminlte-modal id="modal" title="Nota Penjualan Barang" size="xl" theme="success" v-centered>
        <form action="" id="form">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input id="id" type="hidden" name="id">
                    <x-adminlte-input name="kode" label="Kode" igroup-size="sm" required readonly />
                    <x-adminlte-select2 name="pasien_id" label="Pasien">
                        <option value="" selected disabled>Pilih Pasien</option>
                        @foreach ($pasien as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    @php
                        $config = ['format' => 'YYYY-MM-DD'];
                    @endphp
                    <x-adminlte-input-date name="tanggal_faktur" label="Tanggal Faktur" placeholder="Tanggal Faktur"
                        igroup-size="sm" :config="$config" required />
                    <x-adminlte-input name="nomor_faktur" label="Nomor Faktur" igroup-size="sm" required />
                </div>
                <div class="col-md-6">
                    <x-adminlte-select2 name="barang_id" label="Barang">
                        <option value="" selected disabled>Pilih Obat</option>
                        @foreach ($barang as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    <x-adminlte-input name="jumlah" label="Jumlah Kuantitas" igroup-size="sm" required />
                    <x-adminlte-input name="harga_jual" label="Harga Jual" igroup-size="sm" required />
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
@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)
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
                $.get("{{ route('notapenjualan.index') }}" + '/' + id, function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#kode').val(data.kode);
                    $('#supplier_id').val(data.supplier_id).trigger('change');
                    $('#tanggal_faktur').val(data.tanggal_faktur);
                    $('#nomor_faktur').val(data.nomor_faktur);

                    $('#barang_id').val(data.barang_id).trigger('change');
                    $('#nomor_faktur').val(data.nomor_faktur);
                    $('#jumlah').val(data.jumlah);
                    $('#harga_beli').val(data.harga_beli);
                    $('#tanggal_expire').val(data.tanggal_expire);

                    $('#barcode').val(data.barcode);
                    $('#nama').val(data.nama);
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
                var url = "{{ route('notapenjualan.store') }}";
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
                var url = "{{ route('notapenjualan.index') }}/" + id;
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
