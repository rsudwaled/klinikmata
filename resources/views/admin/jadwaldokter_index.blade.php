@extends('adminlte::page')

@section('title', 'Jadwal Dokter')

@section('content_header')
    <h1>Jadwal Dokter</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Jadwal Dokter" theme="secondary" collapsible>
                <div class="row">
                    <div class="col-md-8">
                        <x-adminlte-button label="Tambah" class="btn-sm btnTambah" theme="success" title="Tambah Pasien"
                            icon="fas fa-plus" />
                        <a href="{{ route('jadwaldokter.index') }}" class="btn btn-sm btn-warning"><i
                                class="fas fa-sync"></i>Refresh</a>

                    </div>
                </div>
                @php
                    $heads = ['Poliklinik', 'Dokter', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    $config['paging'] = false;
                @endphp
                <x-adminlte-datatable id="table1" class="nowrap text-xs" :heads="$heads" :config="$config" striped
                    bordered hoverable compressed>
                    @foreach ($jadwals->groupby('kodedokter') as $item)
                        <tr>
                            <td>{{ strtoupper($item->first()->namasubspesialis) }}
                            </td>
                            <td>{{ $item->first()->namadokter }} ({{ $item->first()->kodedokter_jkn }})</td>
                            @for ($i = 1; $i <= 6; $i++)
                                <td>
                                    @foreach ($item as $jadwal)
                                        @if ($jadwal->hari == $i)
                                            <x-adminlte-button label="{{ $jadwal->jampraktek }} ({{ $jadwal->kapasitaspasien }})"
                                                class="btn-xs mb-1 btnJadwal"
                                                theme="{{ $jadwal->libur ? 'danger' : 'warning' }}" data-toggle="tooltip"
                                                title="Jadwal Dokter" data-id="{{ $jadwal->id }}" />
                                        @endif
                                    @endforeach
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
    <x-adminlte-modal id="modal" title="Jadwal Dokter" theme="warning" icon="fas fa-calendar-alt">
        <form name="form" id="form" action="">
            @csrf
            <input type="hidden" name="method" value="UPDATE">
            <input type="hidden" class="id" name="id" id="id">
            <label id="labeljadwal">Jadwal ID : 1</label>
            <x-adminlte-select2 name="kodesubspesialis" id="kodesubspesialis" label="Poliklinik">
                @foreach ($polikliniks as $item)
                    <option value="{{ $item->kodesubspesialis }}">{{ $item->kodesubspesialis }} -
                        {{ $item->namasubspesialis }}
                    </option>
                @endforeach
            </x-adminlte-select2>
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-select2 name="hari" id="hari" label="Hari">
                        <option value="1">SENIN</option>
                        <option value="2">SELASA</option>
                        <option value="3">RABU</option>
                        <option value="4">KAMIS</option>
                        <option value="5">JUMAT</option>
                        <option value="6">SABTU</option>
                        <option value="0">MINGGU</option>
                    </x-adminlte-select2>
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="jampraktek" label="Jam Praktek" placeholder="Jam Praktek" value="08:00 - 12:00"
                        enable-old-support />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="kapasitaspasien" label="Kapasitas Pasien" placeholder="Kapasitas Pasien"
                        enable-old-support />
                </div>
                <div class="col-md-6">
                    {{-- <input type="hidden" name="libur" id="libur" value="0"> --}}
                    <x-adminlte-input-switch name="libur" label="Libur" data-on-text="YES" data-off-text="NO"
                        data-on-color="primary" />
                </div>
            </div>
            <x-adminlte-select2 name="kodedokter" id="kodedokter" label="Dokter">
                @foreach ($dokters as $item)
                    <option value="{{ $item->kode }}">{{ $item->preffix }} {{ $item->nama }} {{ $item->suffix }}
                        ({{ $item->kode_jkn }})
                    </option>
                @endforeach
            </x-adminlte-select2>
        </form>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto " id="btnStore" theme="success" icon="fas fa-save" label="Simpan" />
            <x-adminlte-button class="mr-auto" id="btnUpdate" theme="warning" icon="fas fa-edit" label="Update" />
            <x-adminlte-button id="btnDelete" theme="danger" icon="fas fa-trash-alt" label="Delete" />

            {{-- <x-adminlte-button label="Update" id="btnUpdate" class="mr-auto" type="submit" theme="warning"
                icon="fas fa-edit" /> --}}
            <x-adminlte-button theme="danger" icon="fas fa-times" label="Close" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>

@stop

@section('plugins.Select2', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Datatables', true)
@section('plugins.BootstrapSwitch', true)

@section('js')
    <script>
        $(function() {
            $('.btnTambah').click(function() {
                $('#form').trigger("reset");
                $('#modal').modal('show');
                $('#btnUpdate').hide();
                $('#btnStore').show();
            });
            $('.btnJadwal').click(function() {
                var id = $(this).data('id');
                $.LoadingOverlay("show");
                $.get("{{ route('jadwaldokter.index') }}" + '/' + id + '/edit', function(data) {
                    console.log(data);
                    $('#kodesubspesialis').val(data.kodesubspesialis).trigger('change');
                    $('#kodedokter').val(data.kodedokter).trigger('change');
                    $('#hari').val(data.hari).trigger('change');
                    $('#kapasitaspasien').val(data.kapasitaspasien);
                    $('#labeljadwal').html("Jadwal ID : " + data.id);
                    $('#jampraktek').val(data.jampraktek);
                    $('.id').val(data.id);
                    if (data.libur == 1) {
                        $('#libur').prop('checked', true).trigger('change');
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
                var url = "{{ route('jadwaldokter.store') }}";
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
                var url = "{{ route('jadwaldokter.index') }}/" + id;
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
                            text: 'Data berhasil diupdate',
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil dihapus',
                        }).then(okay => {
                            if (okay) {
                                $.LoadingOverlay("show");
                                location.reload();
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Data tidak jadi dihapus', '', 'info')
                    }
                })
            });
        });
    </script>
@endsection
