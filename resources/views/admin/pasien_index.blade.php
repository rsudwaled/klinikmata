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
                        <x-adminlte-button label="Tambah" class="btn-sm" theme="success" title="Tambah Pasien"
                            icon="fas fa-plus" data-toggle="modal" data-target="#modalCustom" />
                        <a href="{{ route('pasien.index') }}" class="btn btn-sm btn-warning">Refresh</a>
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
                            <td>{{ $item->id }}</td>
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
        <form action="">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-input name="nik" label="NIK" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="no_rm" label="No RM" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="no_bpjs" label="No BPJS" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="no_ihs" label="No Satu Sehat" igroup-size="sm" enable-old-support required />
                </div>
                <div class="col-md-4">
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
                            <x-adminlte-input name="tgl_lahir" label="Tgl Lahir" igroup-size="sm" enable-old-support
                                required />

                        </div>
                    </div>
                    <x-adminlte-input name="nohp" label="No HP" igroup-size="sm" enable-old-support required />


                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="alamat" label="Tgl Lahir" igroup-size="sm" enable-old-support required />
                </div>

            </div>






        </form>
        {{-- <form action="{{ route('simrs.pasien.store') }}" id="myform" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="nik" label="NIK" placeholder="Nomor Induk Kependudukan"
                        enable-old-support required />
                    <x-adminlte-input name="name" label="Nama" placeholder="Nama Lengkap" enable-old-support
                        required />
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="tempat_lahir" label="Tempat Lahir" placeholder="Tempat Lahir"
                                enable-old-support required />
                        </div>
                        <div class="col-md-6">
                            @php
                                $config = ['format' => 'DD-MM-YYYY'];
                            @endphp
                            <x-adminlte-input-date name="tanggal_lahir" label="Tanggal Lahir" placeholder="Tanggal Lahir"
                                :config="$config" enable-old-support required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-select name="gender" label="Jenis Kelamin" enable-old-support>
                                <x-adminlte-options :options="['Laki-Laki', 'Perempuan']" placeholder="Jenis Kelamin" />
                            </x-adminlte-select>
                            <x-adminlte-select name="Agama" label="Agama" enable-old-support>
                                <x-adminlte-options :options="['Islam', 'Perempuan']" placeholder="Agama" />
                            </x-adminlte-select>
                            <x-adminlte-select name="perkawinan" label="Status Perkawinan" enable-old-support>
                                <x-adminlte-options :options="['Islam', 'Perempuan']" placeholder="Status Perkawinan" />
                            </x-adminlte-select>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="pekerjaan" label="Pekerjaan" placeholder="Pekerjaan"
                                enable-old-support />
                            <x-adminlte-input name="kewarganegaraan" label="Kewarganegaraan"
                                placeholder="Kewarganegaraan" enable-old-support />
                            <x-adminlte-select name="darah" label="Golongan Darah" enable-old-support>
                                <x-adminlte-options :options="['A', 'B', 'AB', 'O']" placeholder="Golongan Darah" />
                            </x-adminlte-select>
                        </div>
                    </div>
                </div>
            </div>
        </form> --}}
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" type="submit" theme="success" icon="fas fa-save" label="Simpan" />
            <x-adminlte-button class="mr-auto" type="submit" theme="warning" icon="fas fa-edit" label="Update" />
            <x-adminlte-button theme="danger" label="Kembali" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.TempusDominusBs4', true)

@section('js')
    <script>
        $(function() {
            $('.btnEdit').click(function() {
                var jadwalid = $(this).data('id');
                $.LoadingOverlay("show");
                $.get("{{ route('pasien.index') }}" + '/' + jadwalid + '/edit', function(data) {
                    console.log(data);

                    $('#nik').val(data.nik);
                    $('#no_rm').val(data.no_rm);
                    $('#no_ihs').val(data.no_ihs);
                    $('#no_bpjs').val(data.no_bpjs);

                    $('#nama').val(data.nama);
                    $('#sex').val(data.sex).trigger('change');
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tgl_lahir').val(data.tgl_lahir);
                    $('#nohp').val(data.nohp);



                    // $('#kodesubspesialis').val(data.kodesubspesialis).trigger('change');
                    // $('#kodedokter').val(data.kodedokter).trigger('change');
                    // $('#hari').val(data.hari).trigger('change');
                    // $('#kapasitaspasien').val(data.kapasitaspasien);
                    // $('#labeljadwal').html("Jadwal ID : " + data.id);
                    // $('#jadwal').val(data.jadwal);
                    // $('.idjadwal').val(data.id);
                    // if (data.libur == 1) {
                    //     $('#libur').prop('checked', true).trigger('change');
                    // }
                    $.LoadingOverlay("hide", true);
                    $('#modal').modal('show');
                })

            });
        });
    </script>
@endsection
