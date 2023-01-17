@extends('adminlte::page')

@section('title', 'ERM')

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
    <button class="btn btn-success" data-toggle="modal" data-target="#modalPasienBaru"><i
            class="fas fa-user-plus mr-2"></i>Pasien Baru</button>
    <div class="slide1">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_nomorrm" placeholder="nomor RM ..">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_nomorktp" placeholder="nomor KTP ..">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_namapasien" placeholder="Nama pasien ..">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_nomorbpjs" placeholder="nomor BPJS ..">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_alamat" placeholder="Alamat ..">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary mb-2" onclick="caripasien()"> <i
                            class="bi bi-search-heart"></i> Cari Pasien</button>

                </div>
            </div>
        </div>
        <div id="hasilpencarianpasien" class="hasilpencarianpasien mt-2">

        </div>
    </div>
    <div hidden class="slide2 text-sm">
        <div class="formpendaftaran">

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalPasienBaru" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus mr-2"></i> Data Pasien Baru
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
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
            $('.select2').select2();

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
    </script>
@stop
