<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Support\Arr;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use RealRashid\SweetAlert\Facades\Alert;
// use Spatie\Permission\Models\Role;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\LayananHeader;
use App\Models\LayananDetail;
use Laravolt\Indonesia\Models\Provinsi;

class PendaftaranController extends Controller
{
    public function indexPendaftaran(Request $request)
    {
        $provinsi = Provinsi::pluck('name', 'code');
        return view('Pendaftaran.index_pendaftaran', compact([
            'provinsi'
        ]));
    }
    public function dataPasienBaru(Request $request)
    {
        $pasiens = Pasien::get();
        return view('Pendaftaran.datapasienbaru', [
            'datapasien' => $pasiens
        ]);
    }
    public function pencarianPasien(Request $request)
    {
        $pasiens = Pasien::orderBy('id', 'desc')
            ->where('no_rm', 'LIKE', "%{$request->search}%")
            ->orWhere('nama', 'LIKE', "%{$request->search}%")
            ->orWhere('nik', 'LIKE', "%{$request->search}%")
            ->get();
        return view('Pendaftaran.datapasienbaru', [
            'datapasien' => $pasiens
        ]);
    }
    public function formPendaftaran(Request $request)
    {
        $pasiens = Pasien::where('no_rm', $request->nomorrm)->first();
        $kunjungan = Kunjungan::where('pasien_id', $request->id)->get();
        $dokter = Dokter::get();
        return view('Pendaftaran.formpendaftaran', compact([
            'pasiens',
            'dokter',
            'kunjungan'
        ]));
    }
    public function simpanPendfataran(Request $request)
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        if ($dataSet['dokter'] == "") {
            $data = [
                'kode' => 502,
                'message' => 'Dokter belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['keluhan'] == "") {
            $data = [
                'kode' => 502,
                'message' => 'Silahkan isi keluhan pasien !'
            ];
            echo json_encode($data);
            die;
        }
        $kodekunjungan = $this->kodeRegistrasi();
        $arr = [
            'kode' => $kodekunjungan,
            'tgl_masuk' => $now,
            'pasien_id' => $dataSet['idpasien'],
            'dokter_id' => $dataSet['dokter'],
            'penjamin_id' => $dataSet['penjamin'],
            'status' => 1,
            'pic' => auth()->user()->id,
            'poliklinik' => $dataSet['tujuan'],
            'tujuan' => $dataSet['tujuan'],
            'keluhan' => $dataSet['keluhan']
        ];

            $kunjungans = Kunjungan::create($arr);
            $data = [
                'kode' => 200,
                'message' => 'Pendaftaran berhasil ...'
            ];
            echo json_encode($data);
            die;
        echo json_encode($data);
    }
    public function kodeRegistrasi()
    {
        $date = date('Y-m-d');
        $q = DB::select('SELECT id,kode,RIGHT(kode,3) AS kd_max  FROM kunjungans
        WHERE DATE(tgl_masuk) = ?
        ORDER BY id DESC
        LIMIT 1', [$date]);
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'MAT' . date('ymd') . $kd;
    }
    public function createKodeHeader($kode)
    {
        $date = date('Y-m-d');
        $q = DB::select('SELECT id,kode_layanan_header,RIGHT(kode_layanan_header,6) AS kd_max  FROM layanan_headers
        WHERE DATE(tgl_entry) = ?
        ORDER BY id DESC
        LIMIT 1', [$date]);
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $kode . date('ymd') . $kd;
    }
    public function createLayanandetail()
    {
        $q = DB::select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM layanan_details
        WHERE DATE(tgl_layanan_detail) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'DET' . date('ymd') . $kd;
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
}
