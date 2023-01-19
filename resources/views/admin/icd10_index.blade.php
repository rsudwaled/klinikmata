@extends('adminlte::page')
@section('title', 'ICD 10')
@section('content_header')
    <h1>ICD 10</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Data Diagnosa ICD 10" theme="secondary" collapsible>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="get">
                            <x-adminlte-input name="kode" placeholder="Pencarian Berdasarkan Kode" igroup-size="sm"
                                value="{{ $request->kode }}">
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
                    <div class="col-md-3">
                        <form action="" method="get">
                            <x-adminlte-input name="nama" placeholder="Pencarian Berdasarkan Nama" igroup-size="sm"
                                value="{{ $request->nama }}">
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
                    $heads = ['Kode Diagnosa', 'Nama Diagnosa', 'Kode DTD'];
                    $config['paging'] = false;
                    $config['lengthMenu'] = false;
                    $config['searching'] = false;
                    $config['info'] = false;
                    $config['responsive'] = true;
                @endphp
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" hoverable bordered compressed>
                    @foreach ($icd as $item)
                        <tr>
                            <td>{{ $item->diag }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->dtd }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
                <div class="row">
                    <div class="col-md-5">
                        Tampil data {{ $icd->firstItem() }} sampai {{ $icd->lastItem() }} dari total
                        {{ $total_icd }}
                    </div>
                    <div class="col-md-7">
                        <div class="float-right pagination-sm">
                            {{ $icd->appends($request->all())->links() }}
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.TempusDominusBs4', true)
