@extends('adminlte::page')
@section('title', 'Unit')
@section('content_header')
    <h1 class="m-0 text-dark">Unit</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Data Unit" theme="secondary" collapsible>
                @php
                    $heads = ['No', 'Kode', 'Nama', 'Deskripsi', 'Status', 'Tgl Update'];
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($units as $poliklinik)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $poliklinik->kode }}</td>
                            <td>{{ $poliklinik->nama }}</td>
                            <td>{{ $poliklinik->deskripsi }}</td>
                            <td>{{ $poliklinik->status }}</td>
                            <td>{{ $poliklinik->updated_at }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
