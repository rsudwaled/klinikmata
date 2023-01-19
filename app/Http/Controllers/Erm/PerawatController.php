<?php

namespace App\Http\Controllers\Erm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use App\Models\Icd10;
use App\Models\Icd9;
use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\AssesmenPerawat;

class PerawatController extends Controller
{
    public function indexPerawat(Request $request)
    {
        $kunjungan = Kunjungan::where('status', 1)->get();
        return view('erm.index_perawat', compact([
            'kunjungan'
        ]));
    }
    public function indexErmPerawat(Request $request)
    {
        $kunjungan = Kunjungan::where('kode', $request->kodekunjungan)->first();
        $idpasien = $request->idpasien;
        return view('erm.index_erm_perawat', compact([
            'kunjungan'
            ,'idpasien'
        ]));
    }
    public function formCatatanMedis(Request $request)
    {
        $kunjungan = Kunjungan::where('kode', $request->kodekunjungan)->first();
        $riwayat = DB::select('SELECT * FROM kunjungans a
        LEFT OUTER JOIN assesmen_perawats b ON a.`id` = b.`id_kunjungan` WHERE a.`pasien_id` = ?',[$request->idpasien]);
        return view('erm.form_catatan_medis_perawat', compact([
            'kunjungan',
            'riwayat'
        ]));
    }
    public function formPemeriksaan(Request $request)
    {
        $now = $this->get_now();
        $kunjungan = Kunjungan::where('id', $request->idkunjungan)->get();
        $asskep = AssesmenPerawat::where('id_kunjungan', $request->idkunjungan)->get();
        if(count($asskep) > 0){
            return view('erm.form_perawat_edit', compact([
                'asskep',
                'kunjungan',
                'now'
            ]));
        }else{
            return view('erm.form_perawat', compact([
                'kunjungan',
                'now'
            ]));
        }
    }
    public function simpanForm(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        if ($dataSet['tekanandarah'] == '') {
            $data = [
                'kode' => 502,
                'message' => 'Silahkan isi tekanan darah pasien !'
            ];
            echo json_encode($data);
            die;
        } else if ($dataSet['frekuensinadi'] == '') {
            $data = [
                'kode' => 502,
                'message' => 'Silahkan isi frekuensi nadi !'
            ];
            echo json_encode($data);
            die;
        } else if ($dataSet['frekuensinapas'] == '') {
            $data = [
                'kode' => 502,
                'message' => 'Silahkan isi frekuensi nafas !'
            ];
            echo json_encode($data);
            die;
        } else if ($dataSet['suhutubuh'] == '') {
            $data = [
                'kode' => 502,
                'message' => 'Silahkan isi suhu tubuh pasien !'
            ];
            echo json_encode($data);
            die;
        } else if ($dataSet['keluhanutama'] == '') {
            $data = [
                'kode' => 502,
                'message' => 'Silahkan isi keluhan utama !'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['alergi'] == 'Ada') {
            if ($dataSet['ketalergi'] == '') {
                $data = [
                    'kode' => 502,
                    'message' => 'Isi keterangan alergi !'
                ];
                echo json_encode($data);
                die;
            }
        }
        $asskep = [
            'id_kunjungan' => $request->idkunjungan,
            'id_pasien' => $request->idpasien,
            'pic' => auth()->user()->id,
            'tgl_entry' => $this->get_now(),
            'tgl_kunjungan' => $dataSet['tgljamkunjungan'],
            'tgl_pemeriksaan' => $dataSet['tanggalperiksa'],
            'sumber_data' => $dataSet['sumberdataperiksa'],
            'tekanan_darah' => $dataSet['tekanandarah'],
            'frekuensi_nadi' => $dataSet['frekuensinadi'],
            'frekuensi_nafas' => $dataSet['frekuensinapas'],
            'suhu_tubuh' => $dataSet['suhutubuh'],
            'riwayat_alergi' => $dataSet['alergi'],
            'keterangan_alergi' => trim($dataSet['ketalergi']),
            'keluhan_pasien' => trim($dataSet['keluhanutama']),
            'signature' => ''
        ];
        try {
            $cek = AssesmenPerawat::where('id_kunjungan', $request->idkunjungan)->get();
            if(count($cek) > 0){
                $kunjungans = DB::table('assesmen_perawats')
                ->where('id_kunjungan', $request->idkunjungan)
                ->update($asskep);
            }else{
                $kunjungans = AssesmenPerawat::create($asskep);
            }
            $data = [
                'kode' => 200,
                'message' => 'Hasil Pemeriksaan berhasil disimpan ...'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 502,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function resumePerawat(Request $request)
    {
        $asskep = AssesmenPerawat::where('id_kunjungan', $request->idkunjungan)->get();
        return view('erm.resume_perawat', compact([
            'asskep'
        ]));
    }
    public function simpanTtdPerawat(Request $request)
    {
        $asskep = [
            'signature' => $request->signature,
            'status' => 1
        ];
        try {
            $cek = AssesmenPerawat::where('id_kunjungan', $request->idkunjungan)->get();
                $kunjungans = DB::table('assesmen_perawats')
                ->where('id_kunjungan', $request->idkunjungan)
                ->update($asskep);
            $data = [
                'kode' => 200,
                'message' => 'Tanda tangan berhasil disimpan ...'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 502,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
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
