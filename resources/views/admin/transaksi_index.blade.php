@extends('adminlte::page')
@section('title', 'Transaksi')
@section('content_header')
    <h1 class="m-0 text-dark">Transaksi</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Riwayat Transaksi" theme="secondary" collapsible>
                <div class="row">
                    <div class="col-md-8">
                        <x-adminlte-button label="Tambah" class="btn-sm btnTambah" theme="success" title="Tambah Pasien"
                            icon="fas fa-plus" />
                        <a href="{{ route('stokobat.index') }}" class="btn btn-sm btn-warning"><i
                                class="fas fa-sync"></i>Refresh</a>
                    </div>
                    <div class="col-md-4">
                        <form action="" method="get">
                            <x-adminlte-input name="search" placeholder="Pencarian NIK / Nama" igroup-size="sm"
                                value="{{ $request->search }}">
                                <x-slot name="appendSlot">
                                    <x-adminlte-button type="submit" theme="outline-primary" label="Cari" />
                                </x-slot>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text text-primary">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </form>
                    </div>
                </div>
                @php
                    $heads = ['No', 'Kode', 'Nama', 'Debit', 'Kredit', 'Tipe', 'Ket', 'Status', 'Tgl Transaksi'];
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($transaksi as $item)
                        <tr class="btnEdit" data-id="{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-right">{{ $item->debit ? money($item->debit, 'IDR2') : '-' }}</td>
                            <td class="text-right">{{ $item->kredit ? money($item->kredit, 'IDR2') : '-' }}</td>
                            <td>{{ $item->tipe }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->status }}</td>

                            <td>{{ $item->created_at }} ({{ $item->user_entry }})</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)
