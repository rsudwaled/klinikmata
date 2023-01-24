<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ asset('vendor/adminlte/dist/img/pasien.jpg') }}" alt="User profile picture">
                </div>

                <h3 class="text-bold profile-username text-center text-md">{{ $kunjungan->pasien->nama }}</h3>

                <p class="text-bold text-center text-xs">{{ $kunjungan->pasien->no_rm }}</p>
                <p class="text-bold text-center text-xs">{{ $kunjungan->pasien->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($kunjungan->pasien->tgl_lahir)->format('Y-m-d') }}
                    (Usia {{ \Carbon\Carbon::parse($kunjungan->pasien->tgl_lahir)->age }})</p>
                <p class="text-bold text-center text-xs">Alamat : {{ $kunjungan->pasien->alamat }} |
                    {{ $kunjungan->pasien->nama_desa }}, {{ $kunjungan->pasien->nama_kecamatan }}</p>
                <p class="text-bold text-center text-md">Keluhan : {{ $kunjungan->keluhan }}</p>
                <a href="#" onclick="formcatatanmedis({{ $kunjungan->pasien_id }})" class="btn btn-primary btn-block"><b>Catatan
                        Medis</b></a>
                <input hidden type="text" id="idkunjungan" value="{{ $kunjungan->id }}">
                <input hidden type="text" id="kodekunjungan" value="{{ $kunjungan->kode }}">
                <input hidden type="text" id="idpasien" value="{{ $kunjungan->pasien_id }}">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pemeriksaan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaan()">
                            <i class="fas fa-inbox mr-2"></i> Hasil Pemeriksaan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="forminputtindakan()">
                            <i class="far fa-envelope mr-2"></i>Input Tindakan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="orderfarmasi()">
                            <i class="far fa-file-alt mr-2"></i>Order Farmasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="orderpenunjang()">
                            <i class="fas fa-filter mr-2"></i> Order Penunjang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="resumedokter()">
                            <i class="fas fa-filter mr-2"></i> Resume
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

        </div>
    </div>
    <!-- /.col -->
</div>
<script>
    $(document).ready(function() {
        id = $('#idpasien').val()
        formcatatanmedis(id)
    })
</script>
