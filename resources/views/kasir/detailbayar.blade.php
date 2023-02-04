<div class="card">
    <div class="card-header">Riwayat Pelayanan</div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <th>Kode Layanan</th>
                <th>Keterangan</th>
                <th>Total Layanan</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($datalayanan2 as $dt )
                    <tr>
                        <td>{{ $dt->kode_layanan_header}}</td>
                        <td>@if($dt->keterangan == 'Order Farmasi') {{ $dt->keterangan}} @else Tindakan Medis @endif</td>
                        <td>{{ money($dt->total_layanan, 'IDR')  }}</td>
                        <td>@if($dt->status_layanan == 2) Sudah Dibayar @else Belum dibayar @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header">Detail Pembayaran</div>
    <div class="card-body">
        @if(count($datalayanan) == 0)
            <h4 class="text-danger">Tidak ada layanan yang harus dibayar !</h4>
        @else
        <input hidden id="id_kunjungan" type="text" value="{{ $id_kunjungan }}">
        <form action=""  method="post" class="form-pembayaran">
            @foreach ($datalayanan as $d)
                {{-- <div class="form-row"> --}}
                <div class="row">
                    <div class="form-group col-md-1">
                        <label for="inputPassword4">status</label>
                        <input  class="form-control" name="dibayar" value="1">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Kode Layanan</label>
                        <input readonly class="form-control" name="kode_layanan_header" value="{{ $d->kode_layanan_header }}">
                        <input hidden  class="form-control" name="id_header" value="{{ $d->id }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Keterangan</label>
                        <input  readonly class="form-control" name="keterangan" value="@if($d->keterangan == 'Order Farmasi') {{ $d->keterangan }} @else Tindakan @endif">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Total Layanan</label>
                        <input readonly class="form-control" name="total_layanan_v" value="{{ money($d->total_layanan, 'IDR') }}">
                        <input hidden readonly class="form-control" name="total_layanan" value="{{ $d->total_layanan }}">
                    </div>
                </div>
                {{-- </div> --}}
            @endforeach
            <button class="btn btn-danger">Batal</button>
            <button type="button" data-toggle="modal" data-target="#modalpembayaran" class="btn btn-success bayarlayanan">Bayar Layanan</button>
        </form>
        @endif
    </div>
</div>

<div class="modal fade" id="modalpembayaran" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Detail Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="detailnya">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
$(".bayarlayanan").click(function() {
    var data = $('.form-pembayaran').serializeArray();
    $.ajax({
        type: 'post',
        data: {
            _token: "{{ csrf_token() }}",
            data: JSON.stringify(data),
            id_kunjungan : $('#id_kunjungan').val(),
        },
        url: '<?= route('bayarlayanan') ?>',
        error: function(data) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Sepertinya ada masalah ...',
                footer: ''
            })
        },
        success: function(response) {
            $('.detailnya').html(response)

        }
    });
});

</script>
