@extends('adminlte::page')
@section('title', 'Pendaftaran Pasien')
@section('content_header')
    <div class="preloader2" id="loader2">
        <div class="loading">
            <img src="{{ asset('klinik mata losari/fb.gif') }}" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div>
    <h1 class="text-bold">Pendaftaran</h1>
@stop

@section('content')
    <button class="btn btn-success btnTambah"><i class="fas fa-user-plus mr-2"></i>Pasien Baru</button>
    <div class="slide1">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_nomorrm" placeholder="cari nomor RM / nik / nama">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary mb-2" onclick="caripasien()"> <i
                            class="bi bi-search-heart"></i> Cari Pasien</button>

                </div>
            </div>
        </div>
        <div id="hasilpencarianpasien" class="hasilpencarianpasien mt-2">

        </div>
        <div id="hasilpencarianpasien2" class="hasilpencarianpasien mt-2">

        </div>
    </div>
    <div hidden class="slide2 text-sm">
        <div class="formpendaftaran">

        </div>
    </div>
    <x-adminlte-modal id="modalPasienBaru" title="Tambah Pasien Baru" icon="fas fa-user-plus" theme="success" size="xl"
        v-centered>
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
@section('css')
    <style>
        .preloader2 {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
            opacity: 0.9;
        }

        .preloader2 .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font: 14px arial;
        }

        .scroll {
            max-height: 800px;
            overflow-y: auto;
        }
    </style>
@stop
@section('js')
    <script>
        $(".preloader2").fadeOut();

        function batalpilih() {
            $(".slide2").attr('hidden', true);
            $(".slide1").removeAttr('hidden', true);
        }
        $(document).ready(function() {
            // $('.select2').select2();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('datapasienbaru') ?>',
                success: function(response) {
                    $('#hasilpencarianpasien').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });

        function caripasien() {

            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    search: $('#cari_nomorrm').val()
                },
                url: '<?= route('pencaripasien') ?>',
                success: function(response) {
                    $('#hasilpencarianpasien').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }
    </script>
    <script>
        $(function() {
            $('.btnTambah').click(function() {
                $('#form').trigger("reset");
                $('#modalPasienBaru').modal('show');
                $('#btnUpdate').hide();
                $('#btnDelete').hide();
                $('#btnStore').show();
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
@stop
