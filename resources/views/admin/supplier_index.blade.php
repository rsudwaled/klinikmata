@extends('adminlte::page')
@section('title', 'Supplier')
@section('content_header')
    <h1 class="m-0 text-dark">Supplier </h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Supplier" theme="secondary" collapsible>
                @php
                    $heads = ['No', 'Kode', 'Nama Perusahaan', 'Alamat', 'Penanggungjawab', 'No HP', 'Status', 'Updated at'];
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($satuan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->penanggungjawab }}</td>
                            <td>{{ $item->nohp }}</td>
                            <td>
                                @if ($item->status)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-success">Non-Aktif</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at }} {{ $item->user_entry }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
