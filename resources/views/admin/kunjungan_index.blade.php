@extends('adminlte::page')
@section('title', 'Kunjungan')
@section('content_header')
    <h1>Kunjungan</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-3">
            <x-adminlte-small-box title="{{ $kunjungan_total }}" text="Total Kunjungan" theme="success" icon="fas fa-users" />
        </div>
        <div class="col-md-3">
            <x-adminlte-small-box title="{{ $kunjungan_today }}" text="Kunjungan Hari Ini" theme="success"
                icon="fas fa-users" />
        </div>
        <div class="col-12">
            <x-adminlte-card title="Tabel Data Kunjungan" theme="secondary" collapsible>
                <div class="dataTables_wrapper dataTable">
                    <div class="row">
                        <div class="col-md-8">
                            {{-- <x-adminlte-button label="Tambah" class="btn-sm" theme="success" title="Tambah Kunjungan"
                                icon="fas fa-plus" data-toggle="modal" data-target="#modalCustom" />
                            <x-adminlte-button label="Export" class="btn-sm" theme="primary" title="Tooltip"
                                icon="fas fa-print" /> --}}
                        </div>
                        <div class="col-md-4">
                            <form action="#" method="get">
                                <x-adminlte-input name="search" placeholder="Pencarian No RM / Nama" igroup-size="sm"
                                    value="{{ $request->search }}">
                                    <x-slot name="appendSlot">
                                        <x-adminlte-button type="submit" theme="outline-primary" label="Go!" />
                                    </x-slot>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text text-primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $heads = ['Tgl Masuk', 'Tgl Keluar', 'Kode Kunjungan', 'Counter', 'Pasien (RM)', 'Dokter', 'Tujuan', 'Status'];
                                $config['paging'] = false;
                                $config['lengthMenu'] = false;
                                $config['searching'] = false;
                                $config['info'] = false;
                                $config['order'] = [[0, 'desc']];
                            @endphp
                            <x-adminlte-datatable id="table1" class="nowrap" :heads="$heads" :config="$config"
                                hoverable bordered compressed>
                                @foreach ($kunjungans as $item)
                                    <tr class="btnEdit" data-id="{{ $item->id }}">
                                        <td>{{ $item->tgl_masuk }}</td>
                                        <td>{{ $item->tgl_keluar }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->counter }}</td>
                                        <td>{{ $item->pasien->nama }} ({{ $item->no_rm }})</td>
                                        <td>{{ $item->dokter->preffix }} {{ $item->dokter->nama }}
                                            {{ $item->dokter->suffix }}</td>
                                        <td>{{ $item->tujuan }}</td>
                                        <td>
                                            @switch($item->status)
                                                @case(1)
                                                    <span class="badge bg-warning">Open</span>
                                                @break

                                                @case(2)
                                                    <span class="badge bg-success">Selesai</span>
                                                @break

                                                @case(99)
                                                    <span class="badge bg-danger">Batal</span>
                                                @break

                                                @default
                                                    Default
                                            @endswitch

                                        </td>
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="dataTables_info">
                                Tampil {{ $kunjungans->firstItem() }} s/d {{ $kunjungans->lastItem() }} dari total
                                {{ $kunjungan_total }}
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="dataTables_paginate pagination-sm">
                                {{ $kunjungans->appends($request->all())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
            <x-adminlte-alert title="Catatan Informasi" theme="info" dismissable>
                Data pada halaman diambil pada waktu {{ \Carbon\Carbon::now() }}
            </x-adminlte-alert>
        </div>
    </div>
    <x-adminlte-modal id="modal" title="Data Kunjungan" theme="success" size="xl" v-centered>
        <form action="" id="form">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" name="id" id="id">
                    <x-adminlte-input name="kode" label="Kode" igroup-size="sm" enable-old-support readonly />
                    <x-adminlte-input name="counter" label="Counter" igroup-size="sm" enable-old-support readonly />
                    <x-adminlte-input name="tgl_masuk" label="Tgl Masuk" igroup-size="sm" enable-old-support readonly />
                    <x-adminlte-input name="tgl_keluar" label="Tgl Keluar" igroup-size="sm" enable-old-support readonly />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="nik" label="nik" igroup-size="sm" enable-old-support readonly />
                    <x-adminlte-input name="no_rm" label="no_rm" igroup-size="sm" enable-old-support readonly />
                    <x-adminlte-input name="pasien" label="pasien" igroup-size="sm" enable-old-support readonly />
                    <x-adminlte-input name="dokter" label="Dokter" igroup-size="sm" enable-old-support readonly />
                </div>
                <div class="col-md-4">
                    <x-adminlte-select name="status" label="Status Kunjungan" igroup-size="sm" enable-old-support required>
                        <option value="1">Aktif</option>
                        <option value="2">Selesai</option>
                        <option value="99">Batal</option>
                    </x-adminlte-select>
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
@section('plugins.DateRangePicker', true)
@section('plugins.TempusDominusBs4', true)

@section('js')
    <script>
        $(function() {
            $('.btnEdit').click(function() {
                var id = $(this).data('id');
                $.LoadingOverlay("show");
                $.get("{{ route('kunjungan.index') }}" + '/' + id + '/edit', function(data) {
                    console.log(data);

                    $('#id').val(data.id);
                    $('#kode').val(data.kode);
                    $('#counter').val(data.counter);
                    $('#tgl_masuk').val(data.tgl_masuk);
                    $('#tgl_keluar').val(data.tgl_keluar);

                    $('#nik').val(data.pasien.nik);
                    $('#no_rm').val(data.pasien.no_rm);
                    $('#pasien').val(data.pasien.nama);
                    $('#dokter').val(data.dokter.nama_lengkap);
                    $('#status').val(data.status).trigger('change');

                    $.LoadingOverlay("hide", true);
                    $('#btnUpdate').show();
                    $('#btnStore').hide();
                    $('#modal').modal('show');
                })

            });
            $('#btnUpdate').click(function(e) {
                var id = $("#id").val()
                $.LoadingOverlay("show");
                e.preventDefault();
                var url = "{{ route('kunjungan.index') }}/" + id;
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
        });
    </script>
@endsection
