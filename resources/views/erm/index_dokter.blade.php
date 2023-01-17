@extends('adminlte::page')

@section('title', 'ERM')

@section('content_header')
    <h1>ERM</h1>
@stop

@section('content')
<div class="slide1">
    <table id="tabeldatapasien" class="table table-sm table-hover table-bordered">
        <thead class="bg-secondary">
            <th>Nomor RM</th>
            <th>Nama Pasien</th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Alamat</th>
        </thead>
        <tbody>
            @foreach ($kunjungan as $k )
            <tr class="pilihpasien">
                <td>{{ $k->pasien->no_rm }}</td>
                <td>{{ $k->pasien->nama }}</td>
                <td>{{ $k->pasien->tempat_lahir }}, {{ \Carbon\Carbon::parse($k->pasien->tgl_lahir)->format('Y-m-d') }}
                    ( Usia {{ \Carbon\Carbon::parse($k->pasien->tgl_lahir)->age }})</td>
                <td>{{ $k->pasien->nama_desa }}, {{ $k->pasien->nama_kecamatan }} | {{ $k->pasien->alamat }}</td>
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
                        <li class="breadcrumb-item"> <button class="btn btn-danger" onclick="batalpilih()"><i class="fas fa-backspace mr-2"></i>Batal</button>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('vendor/adminlte/dist/img/pasien.jpg') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center text-xs">Nina Mcintire</h3>

                            <p class="text-muted text-center text-xs">Software Engineer</p>
                            <a href="#" onclick="formcatatanmedis()" class="btn btn-primary btn-block"><b>Catatan Medis</b></a>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Pemeriksaan</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body p-0">
                          <ul class="nav nav-pills flex-column">
                            <li class="nav-item" id="pemeriksaan">
                              <a href="#" class="nav-link" onclick="formpemeriksaan()">
                                <i class="fas fa-inbox mr-2"></i> Hasil Pemeriksaan
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link" onclick="forminputtindakan()">
                                <i class="far fa-envelope mr-2"></i>Input Tindakan
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link" onclick="orderfarmasi()">
                                <i class="far fa-file-alt mr-2"></i>Order Farmasi
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link" onclick="orderpenunjang()">
                                <i class="fas fa-filter mr-2"></i> Order Penunjang
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link" onclick="orderpenunjang()">
                                <i class="fas fa-filter mr-2"></i> Resume
                              </a>
                            </li>
                          </ul>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="slide3">
                        {{-- <div class="card">
                            <div class="card-header p-2">
                                <h5 class="mr-2">
                                    Catatan Medis
                                </h5>
                            </div>
                            <div class="card-body">

                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@stop
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.TempusDominusBs4', true)
@section('css')
<style>
    .scroll {
            max-height: 800px;
            overflow-y: auto;
        }
</style>
@stop
@section('js')
<script>
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
    });
    function batalpilih() {
        $(".slide2").attr('hidden', true);
        $(".slide1").removeAttr('hidden', true);
    }
    $(document).ready(function() {
        formcatatanmedis()
    })
    function formcatatanmedis() {
       var element = document.getElementById("pemeriksaan");
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
            },
            url: '<?= route('formcatatanmedis') ?>',
            error: function(data) {
               alert('ok')
            },
            success: function(response) {
                $('.slide3').html(response)
            }
        });
    }
    function formpemeriksaan() {
       var element = document.getElementById("pemeriksaan");
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
            },
            url: '<?= route('formpemeriksaan_dokter') ?>',
            error: function(data) {
               alert('ok')
            },
            success: function(response) {
                $('.slide3').html(response)
            }
        });
    }
    function forminputtindakan() {
        var element = document.getElementById("pemeriksaan");
        element.classList.add("active");
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
                $('.slide3').html(response)
            }
        });
    }
    function orderfarmasi() {
        var element = document.getElementById("pemeriksaan");
        element.classList.add("active");
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
                $('.slide3').html(response)
            }
        });
    }
    function orderpenunjang() {
        var element = document.getElementById("pemeriksaan");
        element.classList.add("active");
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
