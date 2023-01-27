<table id="tabelriwayattindakan" class="table table-sm table-hover">
    <thead>
        <th>Kode Header</th>
        <th>Kode Detail</th>
        <th>Nama Tindakan</th>
        <th>Tarif</th>
        <th>Jlh Tindakan</th>
        <th>Discount</th>
        <th>action</th>
    </thead>
    <tbody>
        @foreach ($detail_tindakan as $dt)
            <tr>
                <td>{{ $dt->kode_layanan_header }}</td>
                <td>{{ $dt->id_layanan_detail }}</td>
                <td>{{ $dt->nama_tarif }}</td>
                <td>{{ money($dt->tarif, 'IDR')}}</td>
                <td class="text-center">{{ $dt->jumlah_layanan }}</td>
                <td class="text-center">{{ $dt->diskon_layanan }}</td>
                <td class="text-center"><button class="badge badge-sm badge-danger">batal</button></td>
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
            "pageLength": 3,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
</script>
