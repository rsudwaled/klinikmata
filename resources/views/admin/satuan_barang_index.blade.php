@extends('adminlte::page')
@section('title', 'Satuan Obat')
@section('content_header')
    <h1 class="m-0 text-dark">Satuan Obat</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Satuan Obat" theme="secondary" collapsible>
                @php
                    $heads = ['No', 'Kode', 'Nama Satuan', 'Deskripsi', 'Status', 'Upadted at'];
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($satuans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->created_at }} {{ $item->user_entry }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
