@extends('adminlte::page')
@section('title', 'Poliklinik - Antrian BPJS')
@section('content_header')
    <h1 class="m-0 text-dark">Poliklinik Antrian BPJS</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Referensi Poliklinik Antrian BPJS" theme="secondary" collapsible>
                @php
                    $heads = ['No', 'Nama', 'Deskripsi', 'Lokasi', 'Lantai', 'Status',];
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($ruangans as $poliklinik)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $poliklinik->nama }}</td>
                            <td>{{ $poliklinik->deskripsi }}</td>
                            <td>{{ $poliklinik->lokasi }}</td>
                            <td>{{ $poliklinik->lantai }}</td>
                            <td>{{ $poliklinik->status }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
