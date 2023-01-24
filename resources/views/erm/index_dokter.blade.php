@extends('adminlte::page')

@section('title', 'ERM')

@section('content_header')
    <h1>ERM</h1>
    <div class="preloader2" id="loader2">
        <div class="loading">
            <img src="{{ asset('klinik mata losari/fb.gif') }}" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div>
@stop

@section('content')
    <div class="slide1">
        <table id="tabeldatapasien" class="table table-sm table-hover table-bordered">
            <thead class="bg-secondary">
                <th>Nomor RM</th>
                <th>Nama Pasien</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Keluhan</th>
            </thead>
            <tbody>
                @foreach ($kunjungan as $k)
                    <tr class="pilihpasien" kodekunjungan="{{ $k->kode }}" idkunjungan="{{ $k->id }}">
                        <td>{{ $k->pasien->no_rm }}</td>
                        <td>{{ $k->pasien->nama }}</td>
                        <td>{{ $k->pasien->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($k->pasien->tgl_lahir)->format('Y-m-d') }}
                            (Usia {{ \Carbon\Carbon::parse($k->pasien->tgl_lahir)->age }})
                        </td>
                        <td>{{ $k->pasien->nama_desa }}, {{ $k->pasien->nama_kecamatan }} | {{ $k->pasien->alamat }}</td>
                        <td>{{ $k->keluhan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div hidden class="slide2 text-sm">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Data Pasien</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"> <button class="btn btn-danger" onclick="batalpilih()"><i
                                        class="fas fa-backspace mr-2"></i>Batal</button>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="erm2">

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
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
        $(function() {
            $("#tabeldatapasien").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 8,
                "searching": true,
                "order": [
                    [1, "desc"]
                ]
            })
        });
        $('#tabeldatapasien').on('click', '.pilihpasien', function() {
            $(".slide2").removeAttr('hidden', true);
            $(".slide1").attr('hidden', true);
            spinner = $('#loader2');
            spinner.show();
            kodekunjungan = $(this).attr('kodekunjungan')
            idkunjungan = $(this).attr('idkunjungan')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan,
                    idkunjungan
                },
                url: '<?= route('indexerm') ?>',
                success: function(response) {
                    spinner.hide();
                    $('.erm2').html(response);
                }
            });
        });

        function batalpilih() {
            $(".slide2").attr('hidden', true);
            $(".slide1").removeAttr('hidden', true);
        }
        $(document).ready(function() {
            formcatatanmedis()
        })

        function formcatatanmedis(idpasien) {
            spinner = $('#loader2');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    idpasien
                },
                url: '<?= route('formcatatanmedis') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    spinner.hide()
                    $('.slide3').html(response)
                }
            });
        }

        function formpemeriksaan() {
            var element = document.getElementById("pemeriksaan");
            element.classList.add("active");
            spinner = $('#loader2');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    idkunjungan : $('#idkunjungan').val(),
                    kodekunjungan : $('#kodekunjungan').val()
                },
                url: '<?= route('formpemeriksaan_dokter') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    spinner.hide()
                    $('.slide3').html(response)
                }
            });
        }

        function forminputtindakan() {
            var element = document.getElementById("pemeriksaan");
            element.classList.add("active");
            spinner = $('#loader2');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('inputtindakan') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    spinner.hide()
                    $('.slide3').html(response)
                }
            });
        }

        function orderfarmasi() {
            var element = document.getElementById("pemeriksaan");
            element.classList.add("active");
            spinner = $('#loader2');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('orderfarmasi') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    spinner.hide()
                    $('.slide3').html(response)
                }
            });
        }

        function orderpenunjang() {
            var element = document.getElementById("pemeriksaan");
            element.classList.add("active");
            spinner = $('#loader2');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('orderpenunjang') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    spinner.hide()
                    $('.slide3').html(response)
                }
            });
        }
        function resumedokter() {
            var element = document.getElementById("pemeriksaan");
            element.classList.add("active");
            spinner = $('#loader2');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    idkunjungan : $('#idkunjungan').val(),
                    kodekunjungan : $('#kodekunjungan').val()
                },
                url: '<?= route('resumedokter') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    spinner.hide()
                    $('.slide3').html(response)
                }
            });
        }

        function myFunction(e) {
            var elems = document.querySelectorAll(".active");
            [].forEach.call(elems, function(el) {
                el.classList.remove("active");
            });
            e.target.className = "active";
        }
    </script>
@stop
