@extends('adminlte::page')
@section('title', 'Stok Obat')
@section('content_header')
    <h1 class="m-0 text-dark">Stok Obat</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Riwayat Stok Obat" theme="secondary" collapsible>
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
                    $heads = ['No', 'Kode', 'Obat', 'Qty', 'Kategori', 'Supplier', 'Invoice', 'Harga Beli', 'Upadted at'];
                @endphp
                <x-adminlte-datatable id="table1" class="text-xs" :heads="$heads" hoverable bordered compressed>
                    @foreach ($stoks as $item)
                        <tr class="btnEdit" data-id="{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->obat->nama }} {{ '/ '. $item->obat->satuan_obat ?? null }}</td>
                            <td>{{ $item->stok_in }}</td>
                            <td>{{ $item->kategori->nama }}</td>
                            <td>{{ $item->supplier->nama }}</td>
                            <td>{{ $item->invoice }}</td>
                            <td>{{ money($item->total_harga, 'IDR2') }}</td>
                            <td>{{ $item->created_at }} ({{ $item->user_entry }})</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
    <x-adminlte-modal id="modal" title="Tambah Stok Obat" theme="success" size="xl" v-centered>
        <form action="" id="form">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-select2 name="obat_id" label="Obat">
                        <option value="" selected disabled>Pilih Obat</option>
                        @foreach ($obats as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}
                                {{ $item->satuan ? ' / ' . $item->satuan->nama : '' }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    <x-adminlte-input name="stok_in" label="Qty Stok Masuk" igroup-size="sm" enable-old-support required />
                    <x-adminlte-select2 name="kategori_id" label="Kategori">
                        <option value="" selected disabled>Pilih Obat</option>
                        @foreach ($kategori as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    <x-adminlte-select2 name="unit_id" label="Unit">
                        <option value="" selected disabled>Pilih Unit</option>
                        @foreach ($units as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
                <div class="col-md-4">
                    @php
                        $config = ['format' => 'YYYY-MM-DD'];
                    @endphp
                    <x-adminlte-input-date name="tgl_expire" label="Tanggal Expiered" :config="$config" enable-old-support
                        required />
                    <x-adminlte-input name="transaksi_id" label="Kode Trsansaki" igroup-size="sm" readonly
                        enable-old-support />
                    <x-adminlte-select2 name="supplier_id" label="Supplier">
                        <option value="" selected disabled>Pilih Supplier</option>
                        @foreach ($supplier as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    <x-adminlte-input name="invoice" label="Invoice / Faktu Perusahaan" igroup-size="sm" enable-old-support
                        required />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="harga_beli" label="Harga Beli" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="diskon" label="Diskon" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="ppn" label="Persentase PPN" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="pph" label="Persentase PPH" igroup-size="sm" enable-old-support required />
                </div>
            </div>
        </form>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto " id="btnStore" theme="success" icon="fas fa-save" label="Simpan" />
            <x-adminlte-button class="mr-auto" id="btnUpdate" theme="warning" icon="fas fa-edit" label="Update" />
            <x-adminlte-button id="btnDelete" theme="danger" icon="fas fa-trash-alt" label="Delete" />
            <x-adminlte-button theme="secondary" icon="fas fa-arrow-left" label="Kembali" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="modalPO" title="Detail Purching Order" theme="success" size="xl" v-centered>
        {{-- <form action="" id="form">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-select2 name="obat_id" label="Obat">
                        <option value="" selected disabled>Pilih Obat</option>
                        @foreach ($obats as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    <x-adminlte-input name="stok_in" label="Qty Stok Masuk" igroup-size="sm" enable-old-support required />
                    <x-adminlte-select2 name="kategori_id" label="Kategori">
                        <option value="" selected disabled>Pilih Obat</option>
                        @foreach ($kategori as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    <x-adminlte-select2 name="unit_id" label="Unit">
                        <option value="" selected disabled>Pilih Unit</option>
                        @foreach ($units as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
                <div class="col-md-4">
                    @php
                        $config = ['format' => 'YYYY-MM-DD'];
                    @endphp
                    <x-adminlte-input-date name="tgl_expire" label="Tanggal Expiered" :config="$config" enable-old-support
                        required />
                    <x-adminlte-input name="transaksi_id" label="Kode Trsansaki" igroup-size="sm" readonly
                        enable-old-support />
                    <x-adminlte-select2 name="supplier_id" label="Supplier">
                        <option value="" selected disabled>Pilih Supplier</option>
                        @foreach ($supplier as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    <x-adminlte-input name="invoice" label="Invoice / Faktu Perusahaan" igroup-size="sm" enable-old-support
                        required />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="harga_beli" label="Harga Beli" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="diskon" label="Diskon" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="ppn" label="Persentase PPN" igroup-size="sm" enable-old-support required />
                    <x-adminlte-input name="pph" label="Persentase PPH" igroup-size="sm" enable-old-support required />
                </div>
            </div>
        </form> --}}
        {{-- <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto " id="btnStore" theme="success" icon="fas fa-save" label="Simpan" />
            <x-adminlte-button class="mr-auto" id="btnUpdate" theme="warning" icon="fas fa-edit" label="Update" />
            <x-adminlte-button id="btnDelete" theme="danger" icon="fas fa-trash-alt" label="Delete" />
            <x-adminlte-button theme="secondary" icon="fas fa-arrow-left" label="Kembali" data-dismiss="modal" />
        </x-slot> --}}
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Klinik Mata Losari.
                        <small class="float-right">{{ now()->format('m/d/Y') }}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Telah diterima dari
                    <address>
                        <strong><span id="supplier">-</span></strong><br>
                        <span id="penanggungjawab">-</span><br>
                        <span id="nohp">-</span><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Diterima oleh
                    <address>
                        <strong>Klinik Mata Losari</strong><br>
                        <span id="user_entry">-</span><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b><br>
                    <b>Kode PO : </b> 4F3S8J<br>
                    <b>Kode Transaksi : </b> 2/22/2014<br>
                    <b>Account </b> 968-34567
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Serial #</th>
                                <th>Description</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Call of Duty</td>
                                <td>455-981-221</td>
                                <td>El snort testosterone trophy driving gloves handsome</td>
                                <td>$64.50</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Need for Speed IV</td>
                                <td>247-925-726</td>
                                <td>Wes Anderson umami biodiesel</td>
                                <td>$50.00</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Monsters DVD</td>
                                <td>735-845-642</td>
                                <td>Terry Richardson helvetica tousled street art master</td>
                                <td>$10.70</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Grown Ups Blue Ray</td>
                                <td>422-568-642</td>
                                <td>Tousled lomo letterpress</td>
                                <td>$25.99</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Payment Methods:</p>
                    {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                        plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$250.30</td>
                            </tr>
                            <tr>
                                <th>Tax (9.3%)</th>
                                <td>$10.34</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>$5.80</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>$265.24</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                            class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                        Payment
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>
        </div>
    </x-adminlte-modal>
@stop

@section('plugins.Datatables', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)

@section('js')
    <script>
        $(function() {
            $('.btnTambah').click(function() {
                $('#form').trigger("reset");
                $('#modal').modal('show');
                $('#btnUpdate').hide();
                $('#btnStore').show();
            });

            $('.btnEdit').click(function() {
                var id = $(this).data('id');
                $.LoadingOverlay("show");
                $.get("{{ route('stokobat.index') }}" + '/' + id + '/edit', function(data) {
                    console.log(data);
                    // $('#id').val(data.id);

                    $('#user_entry').html(data.user_entry);
                    // $('#no_rm').val(data.no_rm);
                    // $('#no_ihs').val(data.no_ihs);
                    // $('#no_bpjs').val(data.no_bpjs);

                    // $('#nama').val(data.nama);
                    // $('#sex').val(data.sex).trigger('change');
                    // $('#tempat_lahir').val(data.tempat_lahir);
                    // $('#tgl_lahir').val(data.tgl_lahir);
                    // $('#nohp').val(data.nohp);

                    $.LoadingOverlay("hide", true);
                    $('#modalPO').modal('show');
                })

            });

            $('#btnStore').click(function(e) {
                $.LoadingOverlay("show");
                e.preventDefault();
                var url = "{{ route('stokobat.store') }}";
                $.ajax({
                    data: $('#form').serialize(),
                    url: url,
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil disimpan',
                        }).then(okay => {
                            if (okay) {
                                $.LoadingOverlay("show");
                                location.reload();
                            }
                        });
                        $.LoadingOverlay("hide");
                    },
                    error: function(data) {
                        console.log(data);
                        swal.fire({
                            icon: 'error',
                            title: 'Error ' + data.statusText,
                            text: data.responseJSON.metadata.message,
                        });
                        $.LoadingOverlay("hide");
                    }
                });
            });

            $('#btnUpdate').click(function(e) {
                var id = $("#id").val()
                $.LoadingOverlay("show");
                e.preventDefault();
                var url = "{{ route('pasien.index') }}/" + id;
                $.LoadingOverlay("hide");
                $.ajax({
                    data: $('#form').serialize(),
                    url: url,
                    type: "PUT",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil disimpan',
                        }).then(okay => {
                            if (okay) {
                                $.LoadingOverlay("show");
                                location.reload();
                            }
                        });
                        $.LoadingOverlay("hide");
                    },
                    error: function(data) {
                        console.log(data);
                        swal.fire({
                            icon: 'error',
                            title: 'Error ' + data.status,
                            text: data.statusText,
                        });
                        $.LoadingOverlay("hide");
                    }
                });
            });

            $('#btnDelete').click(function(e) {
                Swal.fire({
                    title: 'Konfirmasi Hapus Data',
                    text: 'Apakah anda akan menghapus data ini ?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Ya,  Hapus',
                    denyButtonText: `Tidak`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Data berhasil dihapus', '', 'success')
                    } else if (result.isDenied) {
                        Swal.fire('Data tidak jadi dihapus', '', 'info')
                    }
                })
            });
        });
    </script>
@endsection
