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
use App\Models\AssesmenDokter;
use App\Models\Tarif;

class DokterController extends Controller
{
    public function indexDokter(Request $request)
    {
        $kunjungan = Kunjungan::where('status', 1)->get();
        return view('erm.index_dokter',compact([
            'kunjungan'
        ]));
    }
    public function indexErm(Request $request)
    {
        $kunjungan = Kunjungan::where('kode', $request->kodekunjungan)->first();
        return view('erm.index_erm_dokter',compact([
            'kunjungan'
        ]));
    }
    public function formPemeriksaan(Request $request)
    {
        // $Icd10 = Icd10::get();
        // $Icd9 = Icd9::get();
        $now = $this->get_now();
        $kunjungan = Kunjungan::where('id', $request->idkunjungan)->get();
        $asskep = AssesmenPerawat::where('id_kunjungan', $request->idkunjungan)->get();
        $assdok = AssesmenDokter::where('id_kunjungan', $request->idkunjungan)->get();
        if(count($assdok) > 0){
            return view('erm.form_dokter_edit',compact([
                'kunjungan',
                'asskep',
                'now',
                'assdok'
                // 'Icd10',
                // 'Icd9',
            ]));
        }else{
            return view('erm.form_dokter',compact([
                'kunjungan',
                'asskep',
                'now'
                // 'Icd10',
                // 'Icd9',
            ]));
        }
    }
    public function formTindakan(Request $request)
    {
        $tarif = Tarif::get();
        return view('erm.form_tindakan',compact([
            'tarif'
        ]));
    }
    public function orderFarmasi(Request $request)
    {
        return view('erm.form_order_farmasi');
    }
    public function orderPenunjang(Request $request)
    {
        return view('erm.form_order_penunjang');
    }
    public function resumeDokter(Request $request)
    {
        $assdok = AssesmenDokter::where('id_kunjungan', $request->idkunjungan)->get();
        return view('erm.resumedokter',compact([
            'assdok'
        ]));
    }
    public function simpanTtdDokter(Request $request)
    {
        $assdok = [
            'signature' => $request->signature,
            'status' => 1
        ];
        try {
                $kunjungans = DB::table('assesmen_dokters')
                ->where('id_kunjungan', $request->idkunjungan)
                ->update($assdok);
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
    public function formCatatanMedis(Request $request)
    {
        $kunjungan = Kunjungan::where('kode', $request->kodekunjungan)->first();
        $riwayat = DB::select('SELECT * FROM kunjungans a
        LEFT OUTER JOIN assesmen_perawats b ON a.`id` = b.`id_kunjungan` WHERE a.`pasien_id` = ?',[$request->idpasien]);
        return view('erm.form_catatan_medis',compact([
            'kunjungan',
            'riwayat'
        ]));
    }
    public function gambarMata1(){
        return view('erm.gambarmata1');
    }
    public function gambarMata2(){
        return view('erm.gambarmata2');
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function simpanForm(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        // $assdok = [
        //     'id_kunjungan' => $request->idkunjungan,
        //     'id_pasien' => $request->idpasien,
        //     'id_asskep' =>'',
        //     'pic' => auth()->user()->id,
        //     'tgl_entry' => $this->get_now(),
        //     'tgl_kunjungan' => $dataSet['tgljamkunjungan'],
        //     'tgl_pemeriksaan' => $dataSet['tgljampemeriksaan'],
        //     'sumber_data' => $dataSet['sumberdataperiksa'],
        //     'tekanan_darah' => $dataSet['tekanandarah'],
        //     'frekuensi_nadi' => $dataSet['frekuensinadi'],
        //     'frekuensi_nafas' => $dataSet['frekuensinapas'],
        //     'suhu_tubuh' => $dataSet['suhutubuh'],
        //     'riwayat_alergi' => $dataSet['alergi'],
        //     'keterangan_alergi' => $dataSet['ketalergi'],
        //     'keluhan_pasien' => $dataSet['keluhanutama'],
        //     'riwayat_kehamilan_pasien_wanita' => $dataSet['riwayatkehamilan'],
        //     'riwyat_kelahiran_pasien_anak' => $dataSet['riwayatkelahiran'],
        //     'riwyat_penyakit_sekarang' => $dataSet['riwayatpenyakitsekarang'],
        //     'hipertensi' => '',
        //     'kencingmanis' => '',
        //     'jantung' => '',
        //     'stroke' => '',
        //     'hepatitis' => '',
        //     'asthma' => '',
        //     'ginjal' => '',
        //     'tbparu' => '',
        //     'riwayatlain' => '',
        //     'statusgeneralis' => $dataSet['statusgeneralis'],
        //     'keadaanumum' => $dataSet['keadaanumum'],
        //     'kesadaran' => $dataSet['kesadaran'],
        //     'diagnosakerja' => $dataSet['diagnosakerja'],
        //     'diagnosabanding' => $dataSet['diagnosabanding'],
        //     'rencanakerja' => $dataSet['rencanakerja'],
        //     'vd_od' => $dataSet['od_visus_dasar'],
        //     'vd_od_pinhole' => $dataSet['od_pinhole_visus_dasar'],
        //     'vd_os' => $dataSet['os_visus_dasar'],
        //     'vd_os_pinhole' => $dataSet['os_pinhole_visus_dasar'],
        //     'refraktometer_od_sph' => $dataSet['od_sph_refraktometer'],
        //     'refraktometer_od_cyl' => $dataSet['od_cyl_refraktometer'],
        //     'refraktometer_od_x' => $dataSet['od_x_refraktometer'],
        //     'refraktometer_os_sph' => $dataSet['os_sph_refraktometer'],
        //     'refraktometer_os_cyl' => $dataSet['os_cyl_refraktometer'],
        //     'refraktometer_os_x' => $dataSet['os_x_refraktometer'],
        //     'Lensometer_od_sph' => $dataSet['od_sph_Lensometer'],
        //     'Lensometer_od_cyl' => $dataSet['od_cyl_Lensometer'],
        //     'Lensometer_od_x' => $dataSet['od_x_Lensometer'],
        //     'Lensometer_os_sph' => $dataSet['os_sph_Lensometer'],
        //     'Lensometer_os_cyl' => $dataSet['os_cyl_Lensometer'],
        //     'Lensometer_os_x' => $dataSet['os_x_Lensometer'],
        //     'koreksipenglihatan_vod_sph' =>$dataSet['vod_sph_kpj'],
        //     'koreksipenglihatan_vod_cyl' => $dataSet['vod_cyl_kpj'],
        //     'koreksipenglihatan_vod_x' => $dataSet['vod_x_kpj'],
        //     'koreksipenglihatan_vos_sph' => $dataSet['vos_sph_kpj'],
        //     'koreksipenglihatan_vos_cyl' => $dataSet['vos_cyl_kpj'],
        //     'koreksipenglihatan_vos_x' => $dataSet['vos_x_kpj'],
        //     'tajampenglihatandekat' => $dataSet['penglihatan_dekat'],
        //     'tekananintraokular' => $dataSet['tekanan_intra_okular'],
        //     'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
        //     'palpebra' => $dataSet['palpebra'],
        //     'konjungtiva' => $dataSet['konjungtiva'],
        //     'kornea' => $dataSet['kornea'],
        //     'bilikmatadepan' => $dataSet['bilik_mata_depan'],
        //     'pupil' => $dataSet['pupil'],
        //     'iris' => $dataSet['iris'],
        //     'lensa' => $dataSet['lensa'],
        //     'funduskopi' => $dataSet['funduskopi'],
        //     'status_oftamologis_khusus' => $dataSet['oftamologis'],
        //     'masalahmedis' => $dataSet['masalahmedis'],
        //     'prognosis' => $dataSet['prognosis'],
        //     'gambar1' => '',
        //     'gambar2' => '',
        //     'gambar2' => '',
        //     'signature' => '',
        //     'status' => ''
        // ];

        try {
            if (empty($dataSet['hipertensi'])) {
                $hipertensi = 0;
            } else {
                $hipertensi = $dataSet['hipertensi'];
            };

            if (empty($dataSet['kencingmanis'])) {
                $kencingmanis = 0;
            } else {
                $kencingmanis = $dataSet['kencingmanis'];
            };

            if (empty($dataSet['jantung'])) {
                $jantung = 0;
            } else {
                $jantung = $dataSet['jantung'];
            };

            if (empty($dataSet['stroke'])) {
                $stroke = 0;
            } else {
                $stroke = $dataSet['stroke'];
            };

            if (empty($dataSet['hepatitis'])) {
                $hepatitis = 0;
            } else {
                $hepatitis = $dataSet['hepatitis'];
            };

            if (empty($dataSet['asthma'])) {
                $asthma = 0;
            } else {
                $asthma = $dataSet['asthma'];
            };

            if (empty($dataSet['ginjal'])) {
                $ginjal = 0;
            } else {
                $ginjal = $dataSet['ginjal'];
            };

            if (empty($dataSet['tb'])) {
                $tb = 0;
            } else {
                $tb = $dataSet['tb'];
            };

            if (empty($dataSet['riwayatlain'])) {
                $riwayatlain = 0;
            } else {
                $riwayatlain = $dataSet['riwayatlain'];
                if ($dataSet['ketriwayatlain'] == '') {
                    $data = [
                        'kode' => 502,
                        'message' => 'Isi keterangan riwayat lain ...'
                    ];
                    echo json_encode($data);
                    die;
                }
            };
            $assdok = [
                'id_kunjungan' => $request->idkunjungan,
                'id_pasien' => $request->idpasien,
                'id_asskep' => $request->idaskep,
                'pic' => auth()->user()->id,
                'tgl_entry' => $this->get_now(),
                'tgl_kunjungan' => $dataSet['tgljamkunjungan'],
                'tgl_pemeriksaan' => $dataSet['tgljampemeriksaan'],
                'sumber_data' => $dataSet['sumberdataperiksa'],
                'tekanan_darah' => $dataSet['tekanandarah'],
                'frekuensi_nadi' => $dataSet['frekuensinadi'],
                'frekuensi_nafas' => $dataSet['frekuensinapas'],
                'suhu_tubuh' => $dataSet['suhutubuh'],
                'riwayat_alergi' => $dataSet['alergi'],
                'keterangan_alergi' => $dataSet['ketalergi'],
                'keluhan_pasien' => $dataSet['keluhanutama'],
                'riwayat_kehamilan_pasien_wanita' => $dataSet['riwayatkehamilan'],
                'riwyat_kelahiran_pasien_anak' => $dataSet['riwayatkelahiran'],
                'riwyat_penyakit_sekarang' => $dataSet['riwayatpenyakitsekarang'],
                'hipertensi' => $hipertensi,
                'kencingmanis' => $kencingmanis,
                'jantung' => $jantung,
                'stroke' => $stroke,
                'hepatitis' => $hepatitis,
                'asthma' => $asthma,
                'ginjal' => $ginjal,
                'tbparu' => $tb,
                'riwayatlain' => $riwayatlain,
                'statusgeneralis' => $dataSet['statusgeneralis'],
                'keadaanumum' => $dataSet['keadaanumum'],
                'kesadaran' => $dataSet['kesadaran'],
                'diagnosakerja' => $dataSet['diagnosakerja'],
                'diagnosabanding' => $dataSet['diagnosabanding'],
                'rencanakerja' => $dataSet['rencanakerja'],
                'vd_od' => $dataSet['od_visus_dasar'],
                'vd_od_pinhole' => $dataSet['od_pinhole_visus_dasar'],
                'vd_os' => $dataSet['os_visus_dasar'],
                'vd_os_pinhole' => $dataSet['os_pinhole_visus_dasar'],
                'refraktometer_od_sph' => $dataSet['od_sph_refraktometer'],
                'refraktometer_od_cyl' => $dataSet['od_cyl_refraktometer'],
                'refraktometer_od_x' => $dataSet['od_x_refraktometer'],
                'refraktometer_os_sph' => $dataSet['os_sph_refraktometer'],
                'refraktometer_os_cyl' => $dataSet['os_cyl_refraktometer'],
                'refraktometer_os_x' => $dataSet['os_x_refraktometer'],
                'Lensometer_od_sph' => $dataSet['od_sph_Lensometer'],
                'Lensometer_od_cyl' => $dataSet['od_cyl_Lensometer'],
                'Lensometer_od_x' => $dataSet['od_x_Lensometer'],
                'Lensometer_os_sph' => $dataSet['os_sph_Lensometer'],
                'Lensometer_os_cyl' => $dataSet['os_cyl_Lensometer'],
                'Lensometer_os_x' => $dataSet['os_x_Lensometer'],
                'koreksipenglihatan_vod_sph' =>$dataSet['vod_sph_kpj'],
                'koreksipenglihatan_vod_cyl' => $dataSet['vod_cyl_kpj'],
                'koreksipenglihatan_vod_x' => $dataSet['vod_x_kpj'],
                'koreksipenglihatan_vos_sph' => $dataSet['vos_sph_kpj'],
                'koreksipenglihatan_vos_cyl' => $dataSet['vos_cyl_kpj'],
                'koreksipenglihatan_vos_x' => $dataSet['vos_x_kpj'],
                'tajampenglihatandekat' => $dataSet['penglihatan_dekat'],
                'tekananintraokular' => $dataSet['tekanan_intra_okular'],
                'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
                'palpebra' => $dataSet['palpebra'],
                'konjungtiva' => $dataSet['konjungtiva'],
                'kornea' => $dataSet['kornea'],
                'bilikmatadepan' => $dataSet['bilik_mata_depan'],
                'pupil' => $dataSet['pupil'],
                'iris' => $dataSet['iris'],
                'lensa' => $dataSet['lensa'],
                'funduskopi' => $dataSet['funduskopi'],
                'status_oftamologis_khusus' => $dataSet['oftamologis'],
                'masalahmedis' => $dataSet['masalahmedis'],
                'prognosis' => $dataSet['prognosis'],
                'gambar1' => $request->gambar1,
                'gambar2' =>  $request->gambar2,
                'signature' => '',
                'status' => '0'
            ];
            $cek = AssesmenDokter::where('id_kunjungan', $request->idkunjungan)->get();
            if(count($cek) > 0){
                $kunjungans = DB::table('assesmen_dokters')
                ->where('id_kunjungan', $request->idkunjungan)
                ->update($assdok);
            }else{
                $kunjungans = AssesmenDokter::create($assdok);
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
    public function simpanTindakan(Request $request)
    {
        $data = [
            'kode' => 200,
            'message' => 'Tanda tangan berhasil disimpan ...'
        ];
        echo json_encode($data);
        die;
    }
}
