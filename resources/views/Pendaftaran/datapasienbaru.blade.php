 <div class="card">
     <div class="card-header text-bold text-lg"><i class="fas fa-procedures mr-2"></i> Tabel Pasien Baru</div>
     <div class="card-body">
         <table id="tabelpasienbaru" class="table table-sm table-hover table-bordered">
             <thead class="bg-info text-bold">
                 <th>Nomor RM</th>
                 <th>Nama Pasien</th>
                 <th>Tempat, Tanggal Lahir</th>
                 <th>Alamat</th>
             </thead>
             <tbody>
                 @foreach ($datapasien as $d)
                     <tr class="pilihpasien" nomorrm="{{ $d->no_rm }}">
                         <td>{{ $d->no_rm }}</td>
                         <td>{{ $d->nama }}</td>
                         <td>{{ $d->tgl_lahir }}</td>
                         <td>{{ $d->alamat }}</td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>
<script>
 $(function() {
            $("#tabelpasienbaru").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 8,
                "searching": true,
                "order": [
                    [1, "desc"]
                ]
            })
        });
        $('#tabelpasienbaru').on('click', '.pilihpasien', function() {
            $(".slide2").removeAttr('hidden', true);
            $(".slide1").attr('hidden', true);
            nomorrm = $(this).attr('nomorrm')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorrm
                },
                url: '<?= route('pendaftaranpasien') ?>',
                success: function(response) {
                    $('.formpendaftaran').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
</script>
