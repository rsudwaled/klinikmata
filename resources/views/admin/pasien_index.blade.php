@extends('adminlte::page')
@section('title', 'Pasien')
@section('content_header')
    <h1>Pasien</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-3">
            <x-adminlte-small-box title="{{ $total_pasien }}" text="Total Pasien" theme="success" icon="fas fa-users" />
        </div>
        <div class="col-md-3">
            <x-adminlte-small-box title="{{ $pasien_jkn }} {{ round(($pasien_jkn / $total_pasien) * 100) }}%"
                text="Pasien memiliki Kartu" theme="warning" icon="fas fa-users" />
        </div>
        <div class="col-md-3">
            <x-adminlte-small-box title="{{ $pasien_nik }} {{ round(($pasien_jkn / $total_pasien) * 100) }}%"
                text="Pasien memiliki NIK" theme="warning" icon="fas fa-users" />
        </div>
        <div class="col-12">
            <x-adminlte-card title="Grafik Pasien" theme="secondary" collapsible="collapsed">
                asdasd
            </x-adminlte-card>
            <x-adminlte-card title="Data Pasien" theme="secondary" collapsible>
                <div class="row">
                    <div class="col-md-8">
                        <x-adminlte-button label="Tambah" class="btn-sm btnTambah" theme="success" title="Tambah Pasien"
                            icon="fas fa-plus" />
                        <a href="{{ route('pasien.index') }}" class="btn btn-sm btn-warning"><i
                                class="fas fa-sync"></i>Refresh</a>
                    </div>
                    <div class="col-md-4">
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
                    </div>
                </div>
                @php
                    $heads = ['Kode RM', 'BPJS', 'NIK', 'Nama Pasien (Sex)', 'Tanggal Lahir (Umur)', 'Kecamatan', 'Alamat', 'Tgl Entry'];
                    $config['paging'] = false;
                    $config['lengthMenu'] = false;
                    $config['searching'] = false;
                    $config['info'] = false;
                    $config['responsive'] = true;
                @endphp
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" hoverable bordered compressed>
                    @foreach ($pasiens as $item)
                        <tr class="btnEdit" data-id="{{ $item->id }}">
                            <td>{{ $item->no_rm }}</td>
                            <td>{{ $item->no_bpjs }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nama }} ({{ $item->sex }})</td>
                            <td>{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tgl_lahir)->format('Y-m-d') }}
                                ({{ \Carbon\Carbon::parse($item->tgl_lahir)->age }})
                            </td>
                            <td>{{ $item->nama_desa }}, {{ $item->nama_kecamatan }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->created_at }} ({{ $item->user_entry }})</td>
                            {{-- <form action="{{ route('administrator.pasien.destroy', $item->no_rm) }}" method="POST">
                                    <x-adminlte-button class="btn-xs" theme="warning" icon="fas fa-edit"
                                        onclick="window.location='{{ route('simrs.pasien.edit', $item->no_rm) }}'" />
                                    @csrf
                                    @method('DELETE')
                                    <x-adminlte-button class="btn-xs" theme="danger" icon="fas fa-trash-alt" type="submit"
                                        onclick="return confirm('Apakah anda akan menghapus {{ $item->no_rm }} ?')" />
                                </form> --}}
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
                <div class="row">
                    <div class="col-md-5">
                        Tampil data {{ $pasiens->firstItem() }} sampai {{ $pasiens->lastItem() }} dari total
                        {{ $total_pasien }}
                    </div>
                    <div class="col-md-7">
                        <div class="float-right pagination-sm">
                            {{ $pasiens->links() }}
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>
    <x-adminlte-modal id="modal" title="Data Pasien" theme="success" size="xl" v-centered>
        <form action="" id="form">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-input name="no_rm" label="No RM" igroup-size="sm" enable-old-support readonly />
                    <x-adminlte-input name="nik" label="NIK" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="no_bpjs" label="No BPJS" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="no_ihs" label="No Satu Sehat" igroup-size="sm" enable-old-support required />
                </div>
                <div class="col-md-4">
                    <input id="id" type="hidden" name="id">
                    <x-adminlte-input name="nama" label="Nama" igroup-size="sm" enable-old-support required />
                    <x-adminlte-select name="sex" label="Jenis Kelamin" igroup-size="sm" enable-old-support required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </x-adminlte-select>
                    <div class="row">
                        <div class="col-md-7">
                            <x-adminlte-input name="tempat_lahir" label="Tempat Lahir" igroup-size="sm" enable-old-support
                                required />
                        </div>
                        <div class="col-md-5">
                            @php
                                $config = ['format' => 'YYYY-MM-DD'];
                            @endphp
                            <x-adminlte-input-date name="tgl_lahir" label="Tgl Lahir" igroup-size="sm" :config="$config"
                                enable-old-support required />
                        </div>
                    </div>
                    <x-adminlte-input name="nohp" label="No HP" igroup-size="sm" enable-old-support required />
                </div>
                <div class="col-md-4">
                    <x-adminlte-select2 name="provinsi" label="Provinsi">
                        <option value="" disabled>PILIH PROVINSI</option>
                        @foreach ($provinsi as $code => $name)
                            <option value="{{ $code }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    <x-adminlte-select2 name="kabupaten" label="Kabupaten">
                        <option value="" disabled>PILIH KABUPATEN</option>
                    </x-adminlte-select2>
                    <x-adminlte-select2 name="kecamatan" label="Kecamatan">
                        <option value="" disabled>PILIH KECAMATAN</option>
                    </x-adminlte-select2>
                    <x-adminlte-select2 name="desa" label="Desa">
                        <option value="" disabled>PILIH DESA</option>
                    </x-adminlte-select2>
                    <x-adminlte-textarea name="alamat" placeholder="Alamat" label="Alamat" igroup-size="sm"
                        enable-old-support required />
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
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('plugins.TempusDominusBs4', true)

@section('js')
    <script>
        $(function() {
            $('.btnTambah').click(function() {
                $('#form').trigger("reset");
                $('#modal').modal('show');
                $('#btnUpdate').hide();
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
