@extends('adminlte::page')
@section('title', 'Nota Pembelian Barang')
@section('content_header')
    <h1 class="m-0 text-dark">Nota Pembelian Barang</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Riwayat Nota Pembelian Barang" theme="secondary" collapsible>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">Uraian</th>
                            <th colspan="3">Jumlah Barang</th>
                            <th rowspan="2">Harga Satuan</th>
                            <th rowspan="2">Keterangan</th>
                        </tr>
                        <tr>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stok as $item)
                            <tr>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->harga_beli }}</td>
                                <td>{{ $item->harga_jual }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </x-adminlte-card>
        </div>
    </div>

@stop
@section('plugins.Datatables', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)
