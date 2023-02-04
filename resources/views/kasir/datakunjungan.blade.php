     <p class="text-md">Data Kunjungan</p>
     <table id="tabeldatapasien2" class="table table-sm table-hover table-bordered">
         <thead class="bg-secondary">
             <th>Nomor RM</th>
             <th>Nama Pasien</th>
             <th>Tempat, Tanggal Lahir</th>
             <th>Alamat</th>
             <th>Tujuan</th>
         </thead>
         <tbody>
             @foreach ($kunjungan as $k)
                 <tr class="pilihpasien" kodekunjungan="{{ $k->kode }}" idkunjungan="{{ $k->id }}">
                     <td>{{ $k->pasien->no_rm }}</td>
                     <td>{{ $k->pasien->nama }}</td>
                     <td>{{ $k->pasien->tempat_lahir }},
                         {{ \Carbon\Carbon::parse($k->pasien->tgl_lahir)->format('Y-m-d') }}
                         (Usia {{ \Carbon\Carbon::parse($k->pasien->tgl_lahir)->age }})
                     </td>
                     <td>{{ $k->pasien->nama_desa }}, {{ $k->pasien->nama_kecamatan }} | {{ $k->pasien->alamat }}</td>
                     <td>{{ $k->tujuan }}</td>
                 </tr>
             @endforeach
         </tbody>
     </table>
     <script>
         $(function() {
             $("#tabeldatapasien2").DataTable({
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
         $('#tabeldatapasien2').on('click', '.pilihpasien', function() {
             $(".slide2").removeAttr('hidden', true);
             $(".slide1").attr('hidden', true);
             spinner = $('#loader2');
             spinner.show();
             kodekunjungan = $(this).attr('kodekunjungan')
             idkunjungan = $(this).attr('idkunjungan')
             $.ajax({
                 type: 'post',
                 data: {
                     _token: "{{ csrf_token() }}",
                     kodekunjungan,
                     idkunjungan
                 },
                 url: '<?= route('detailbayar') ?>',
                 success: function(response) {
                    spinner.hide()
                     $('.detailbayar').html(response);
                 }
             });
         });
     </script>
