<form action="" class="formkasir">
<table class="table table-sm table-bordered">
    <thead class="text-bold text-sm">
        <th>Kode Layanan</th>
        <th>Keterangan</th>
        <th>Jumlah Layanan</th>
    </thead>
    <tbody>
        @php $totalbayar = 0 @endphp
        @foreach ($d as $a )
        @if($a['dibayar'] != 0)
            <tr class="text-sm">
                <td>{{ $a['kode_layanan_header']}}</td>
                <td>{{ $a['keterangan']}}</td>
                <td>{{ money($a['total_layanan'],'IDR')}}</td>
                <input hidden type="text" name="idheader" value="{{ $a['id_header']}}">
            </tr>
            @php $totalbayar = $totalbayar + $a['total_layanan'] @endphp
            @endif
            @endforeach
            <tr>
                <td colspan="2" class="text-bold text-sm">Total Bayar</td>
                <td>
                    <input type="text" id="uangbayar" class="form-control" onchange="hitungkembalian()">
                </td>
            </tr>
        <tr>
            <td colspan="2" class="text-bold text-sm">Total Pelayanan</td>
            <td class="text-bold text-lg">{{ money($totalbayar,'IDR') }}
                <input hidden type="text" id="totalbayar" value="{{ $totalbayar }}">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-bold text-sm">Kembalian</td>
            <td><input readonly type="text" id="kembaliannya" class="form-control"></td>
        </tr>
    </tbody>
</table>
<button type="button" class="btn btn-success float-right btn-lg simpanpembayaran">Bayar</button>
</form>
<script>
    function hitungkembalian()
    {
        uangbayar = $('#uangbayar').val()
        tagihan = $('#totalbayar').val()
        kembalian = uangbayar - tagihan
        $('#kembaliannya').val(kembalian)
    }
    $(".simpanpembayaran").click(function() {
        var data = $('.formkasir').serializeArray();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                    uangbayar  : $('#uangbayar').val(),
                    totalbayar : $('#totalbayar').val(),
                    kembalian : $('#kembaliannya').val(),
                },
                url: '<?= route('simpanpembayaran') ?>',
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Sepertinya ada masalah ...',
                        footer: ''
                    })
                },
                success: function(data) {
                    if (data.kode == 502) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: data.message,
                            footer: ''
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'OK',
                            text: data.message,
                            footer: ''
                        })
                    }
                }
            });
    })
</script>
