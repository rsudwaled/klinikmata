@extends('adminlte::page')
@section('title', 'Pendaftaran Pasien')
@section('content_header')
    <div class="preloader2" id="loader2">
        <div class="loading">
            <img src="{{ asset('klinik mata losari/fb.gif') }}" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div>
    <h1 class="text-bold">Kasir - Pembayaran</h1>
@stop
@section('plugins.Datatables', true)
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="datakunjungan">

            </div>
        </div>
        <div class="col-md-6">
            <div class="detailbayar">

            </div>
        </div>
    </div>
@stop
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
        $(document).ready(function() {
            ambilkunjungan()
        })

        function ambilkunjungan() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('ambildatakunjungan') ?>',
                error: function(data) {
                    alert('errror')
                },
                success: function(response) {
                    $('.datakunjungan').html(response)
                }
            });
        }
    </script>
@stop
