<table id="tabelriwayattindakan" class="table table-sm table-hover">
    <thead>
        <th>Kode Header</th>
        {{-- <th>Kode Detail</th> --}}
        <th>Nama Obat / Barang</th>
        <th>Tarif</th>
        <th>Jlh</th>
        <th>Satuan</th>
        <th>Signa</th>
        <th>Mata Kanan</th>
        <th>Mata Kiri</th>
        <th>Discount</th>
        <th>status</th>
    </thead>
    <tbody>
        @foreach ($detail_tindakan as $dt)
            <tr>
                <td>{{ $dt->kode_layanan_header }}</td>
                {{-- <td>{{ $dt->id_layanan_detail }}</td> --}}
                <td>{{ $dt->nama_tarif }}</td>
                <td>{{ money($dt->tarif, 'IDR')}}</td>
                <td class="text-center">{{ $dt->jumlah_layanan }}</td>
                <td class="text-center">{{ $dt->satuan }}</td>
                <td class="text-center">{{ $dt->signa }}</td>
                <td class="text-center">{{ $dt->matakanan }}</td>
                <td class="text-center">{{ $dt->matakiri }}</td>
                <td class="text-center">{{ $dt->diskon_layanan }}</td>
                <td class="text-center">
                    @if($dt->status_layanan == 1)
                        <p class="text-bold"> Sudah Verifikasi dokter</p>

                    @elseif ($dt->status_layanan == 2)
                        <p class="text-bold"> Diterima farmasi / kasir </p>

                    @elseif ($dt->status_layanan == 3)
                        <p class="text-bold"> Sudah Dibayar </p>

                    @elseif ($dt->status_layanan == 0)
                        <p class="text-bold"> Belum verifikasi dokter</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayattindakan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
</script>
