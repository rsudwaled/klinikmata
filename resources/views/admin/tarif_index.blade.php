@extends('adminlte::page')
@section('title', 'Tarif Pelayanan')
@section('content_header')
    <h1 class="m-0 text-dark">Tarif Pelayanan</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Tarif Pelayanan" theme="secondary" collapsible>
                @php
                    $heads = ['Kode Tarif', 'Nama', 'Harga', 'Jenis', 'Status', 'Tgl Update'];
                @endphp
                <div class="row">
                    <div class="col-md-8 mb-2">
                        <x-adminlte-button label="Import" class="btn-sm btnImport" theme="warning" title="Tambah Pasien"
                            icon="fas fa-plus" />
                        <a href="{{ route('dokter.index') }}" class="btn btn-sm btn-warning"><i class="fas fa-sync"></i>
                            Refresh</a>

                    </div>
                </div>
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($tarif as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ money($item->harga, 'IDR') }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
    <x-adminlte-modal id="modalImport" title="Import Tarif" theme="success" v-centered>
        <form id="formImport" method="POST" action="{{ route('tarif.import') }}" enctype="multipart/form-data">
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
        {{-- <form action="" id="form">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-input name="nik" label="NIK" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="kode" label="Kode Dokter" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="kode_jkn" label="Kode BPJS" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="kode_ihs" label="Kode Satu Sehat" igroup-size="sm" enable-old-support
                        required />
                </div>
                <div class="col-md-8">
                    <input id="id" type="hidden" name="id">
                    <div class="row">
                        <div class="col-md-2">
                            <x-adminlte-input name="preffix" label="Preffix" igroup-size="sm" enable-old-support required />

                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="nama" label="Nama" igroup-size="sm" enable-old-support required />
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="suffix" label="Suffix" igroup-size="sm" enable-old-support required />

                        </div>
                    </div>
                    <x-adminlte-input name="nohp" label="No HP" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="sip" label="Surat Izin Praktek" igroup-size="sm" enable-old-support
                        required />
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-select2 name="poliklinik" label="Poliklinik">
                                <option value="" selected disabled>PILIH POLIKLINIK</option>
                                @foreach ($poliklinik as $code => $name)
                                    <option value="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </x-adminlte-select2>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input-switch name="status" igroup-size="sm" label="Status Aktif" data-on-text="YES"
                                data-off-text="NO" data-on-color="primary" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto " id="btnStore" theme="success" icon="fas fa-save" label="Simpan" />
            <x-adminlte-button class="mr-auto" id="btnUpdate" theme="warning" icon="fas fa-edit" label="Update" />
            <x-adminlte-button id="btnDelete" theme="danger" icon="fas fa-trash-alt" label="Delete" />
            <x-adminlte-button theme="secondary" icon="fas fa-arrow-left" label="Kembali" data-dismiss="modal" />
        </x-slot> --}}
    </x-adminlte-modal>
@stop

@section('plugins.Datatables', true)

@section('js')
    <script>
        $(function() {
            $('.btnImport').click(function() {
                $('#modalImport').modal('show');
            });

            // $('.btnEdit').click(function() {
            //     var jadwalid = $(this).data('id');
            //     $.LoadingOverlay("show");
            //     $.get("{{ route('dokter.index') }}" + '/' + jadwalid + '/edit', function(data) {
            //         console.log(data);
            //         $('#id').val(data.id);

            //         $('#nik').val(data.nik);
            //         $('#kode').val(data.kode);
            //         $('#kode_jkn').val(data.kode_jkn);
            //         $('#kode_ihs').val(data.kode_ihs);

            //         $('#nama').val(data.nama);
            //         $('#suffix').val(data.suffix);
            //         $('#preffix').val(data.preffix);
            //         $('#nohp').val(data.nohp);
            //         $('#sip').val(data.sip);

            //         $('#poliklinik').val(data.poliklinik).trigger('change');
            //         if (data.status == 1) {
            //             $('#status').prop('checked', true).trigger('change');
            //         }

            //         $.LoadingOverlay("hide", true);
            //         $('#btnUpdate').show();
            //         $('#btnStore').hide();
            //         $('#modal').modal('show');
            //     })

            // });

            // $('#btnStore').click(function(e) {
            //     $.LoadingOverlay("show");
            //     e.preventDefault();
            //     var url = "{{ route('dokter.store') }}";
            //     $.ajax({
            //         data: $('#form').serialize(),
            //         url: url,
            //         type: "POST",
            //         dataType: 'json',
            //         success: function(data) {
            //             console.log(data);
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Success',
            //                 text: 'Data berhasil disimpan',
            //             }).then(okay => {
            //                 if (okay) {
            //                     $.LoadingOverlay("show");
            //                     location.reload();
            //                 }
            //             });
            //             $.LoadingOverlay("hide");
            //         },
            //         error: function(data) {
            //             console.log(data);
            //             swal.fire({
            //                 icon: 'error',
            //                 title: 'Error ' + data.statusText,
            //                 text: data.responseJSON.metadata.message,
            //             });
            //             $.LoadingOverlay("hide");
            //         }
            //     });
            // });

            // $('#btnUpdate').click(function(e) {
            //     var id = $("#id").val()
            //     $.LoadingOverlay("show");
            //     e.preventDefault();
            //     var url = "{{ route('dokter.index') }}/" + id;
            //     $.LoadingOverlay("hide");
            //     $.ajax({
            //         data: $('#form').serialize(),
            //         url: url,
            //         type: "PUT",
            //         dataType: 'json',
            //         success: function(data) {
            //             console.log(data);
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Success',
            //                 text: 'Data berhasil disimpan',
            //             }).then(okay => {
            //                 if (okay) {
            //                     $.LoadingOverlay("show");
            //                     location.reload();
            //                 }
            //             });
            //             $.LoadingOverlay("hide");
            //         },
            //         error: function(data) {
            //             console.log(data);
            //             swal.fire({
            //                 icon: 'error',
            //                 title: 'Error ' + data.status,
            //                 text: data.statusText,
            //             });
            //             $.LoadingOverlay("hide");
            //         }
            //     });
            // });

            // $('#btnDelete').click(function(e) {
            //     Swal.fire({
            //         title: 'Konfirmasi Hapus Data',
            //         text: 'Apakah anda akan menghapus data ini ?',
            //         showDenyButton: true,
            //         showCancelButton: true,
            //         confirmButtonText: 'Ya,  Hapus',
            //         denyButtonText: `Tidak`,
            //     }).then((result) => {
            //         /* Read more about isConfirmed, isDenied below */
            //         if (result.isConfirmed) {
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Success',
            //                 text: 'Data berhasil dihapus',
            //             }).then(okay => {
            //                 if (okay) {
            //                     $.LoadingOverlay("show");
            //                     location.reload();
            //                 }
            //             });
            //         } else if (result.isDenied) {
            //             Swal.fire('Data tidak jadi dihapus', '', 'info')
            //         }
            //     })
            // });
        });
    </script>
@endsection
