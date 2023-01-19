@extends('adminlte::page')
@section('title', 'Tarif Pelayanan')
@section('content_header')
    <h1 class="m-0 text-dark">Tarif Pelayanan</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Tarif Pelayanan" theme="secondary" collapsible>
                <div class="row">
                    <div class="col-md-8 mb-2">
                        <x-adminlte-button label="Import" class="btn-sm btnImport" theme="warning" title="Tambah Pasien"
                            icon="fas fa-plus" />
                        <a href="{{ route('tarif.index') }}" class="btn btn-sm btn-warning"><i class="fas fa-sync"></i>
                            Refresh</a>
                    </div>
                </div>
                @php
                    $heads = ['Kode Tarif', 'Nama', 'Harga', 'Jenis', 'Status', 'Tgl Update'];
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($tarif as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ money($item->harga, 'IDR') }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
    <x-adminlte-modal id="modalImport" title="Import Tarif" theme="success" v-centered>
        <form id="formImport" method="POST" action="{{ route('tarif.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="file" required="required">
            </div>
        </form>
        <x-slot name="footerSlot">
            <x-adminlte-button type="submit" class="mr-auto " form="formImport" theme="success" icon="fas fa-save"
                label="Import" />
            <x-adminlte-button theme="secondary" icon="fas fa-arrow-left" label="Kembali" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
@stop

@section('plugins.Datatables', true)

@section('js')
    <script>
        $(function() {
            $('.btnImport').click(function() {
                $('#modalImport').modal('show');
            });
        });
    </script>
@endsection
