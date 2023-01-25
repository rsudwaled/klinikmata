@extends('adminlte::page')
@section('title', 'Poliklinik')
@section('content_header')
    <h1 class="m-0 text-dark">Poliklinik</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Data Poliklinik" theme="secondary" collapsible>
                @php
                    $heads = ['No', 'Nama Subspesialis', 'Kode Subspesialis', 'Nama Poli', 'Kode Poli', 'Status',];
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($polikliniks as $poliklinik)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $poliklinik->namasubspesialis }}</td>
                            <td>{{ $poliklinik->kodesubspesialis }}</td>
                            <td>{{ $poliklinik->namapoli }}</td>
                            <td>{{ $poliklinik->kodepoli }}</td>
                            <td>{{ $poliklinik->status }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
