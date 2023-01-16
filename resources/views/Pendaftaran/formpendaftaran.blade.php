

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

                        <h3 class="profile-username text-center text-md">{{ strtoupper($datapasien[0]->nama) }}</h3>

                        <p class="text-muted text-center text-xs">Software Engineer</p>
                        <a href="#" class="btn btn-primary btn-block"><b>Catatan Medis</b></a>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat Kunjungan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-inbox mr-2"></i> 2023-01-01 | Dr. Mata 1
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="slide3">
                    <div class="card">
                        <div class="card-header p-2">
                            <h5 class="mr-2">
                                Form Pendaftaran
                            </h5>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Dokter</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis
                                            Penjamin</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputPassword3">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" class="btn btn-danger" onclick="batalpilih()"><i
                                            class="fas fa-backspace mr-2"></i>Batal</button>
                                    <button type="button" class="btn btn-success float-right"><i
                                            class="fas fa-save mr-2"></i> Daftar</button>
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
