<!-- Main content -->
<section class="content mt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('vendor/adminlte/dist/img/pasien.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center text-md">{{ strtoupper($pasiens->nama) }}</h3>

                        <p class="text-center text-xs">{{ $pasiens->no_rm }}</p>
                        <p class="text-center text-xs">{{ $pasiens->nama_desa }}, {{ $pasiens->nama_kecamatan }} |
                            {{ $pasiens->alamat }}</p>
                        {{-- <a href="#" class="btn btn-primary btn-block"><b>Catatan Medis</b></a> --}}

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Riwayat Kunjungan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            @foreach ($kunjungan as $k )
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-inbox mr-2"></i>{{ $k->counter }} | {{ \Carbon\Carbon::parse($k->tgl_masuk)->format('Y-m-d') }} | {{ $k->dokter ?  $k->dokter->nama : '-' }} | {{ $k->tujuan }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="slide3">
                    <div class="card">
                        <div class="card-header p-2 bg-primary">
                            <h5 class="mr-2">
                                <i class="fas fa-notes-medical mr-2 ml-2"></i> Form Pendaftaran
                            </h5>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form class="form-horizontal formnyapendaftaran">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tujuan
                                            Kunjungan</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <select class="form-control" name="tujuan"
                                                    id="exampleFormControlSelect1">
                                                    <option value="MAT">Klinik Mata</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Dokter</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <select class="form-control select2" name="dokter"
                                                    style="width: 100%;">
                                                    <option value="">Silahkan Pilih Dokter</option>
                                                    @foreach ($dokter as $d)
                                                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis
                                            Penjamin</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <select class="form-control" name="penjamin"
                                                    id="exampleFormControlSelect1">
                                                    <option value="1">Pribadi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Keluhan</label>
                                        <div class="col-sm-10">
                                            <textarea name="keluhan" class="form-control"></textarea>
                                            <input hidden type="text" name="idpasien" value="{{ $pasiens->id }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" class="btn btn-danger" onclick="batalpilih()"><i
                                            class="fas fa-backspace mr-2"></i>Batal</button>
                                    <button type="button" class="btn btn-success float-right"
                                        onclick="simpanpendaftaran()"><i class="fas fa-save mr-2"></i> Daftar</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div><!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    })

    function simpanpendaftaran() {
        var data = $('.formnyapendaftaran').serializeArray();
        spinner = $('#loader2');
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanpendaftaran') ?>',
            error: function(data) {
                alert('error')
                spinner.hide();
            },
            success: function(data) {
                spinner.hide();
                alert(data.message)
                location.reload()
            }
        });
    }
</script>
