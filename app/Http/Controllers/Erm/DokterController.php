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
use App\Models\LayananHeader;
use App\Models\LayananDetail;
use App\Models\Barang;

class DokterController extends Controller
{
    public function indexDokter(Request $request)
    {
        $kunjungan = Kunjungan::where('status', 1)->get();
        return view('erm.index_dokter', compact([
            'kunjungan'
        ]));
    }
    public function indexErm(Request $request)
    {
        $kunjungan = Kunjungan::where('kode', $request->kodekunjungan)->first();
        return view('erm.index_erm_dokter', compact([
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
        if (count($asskep) > 0) {
            if (count($assdok) > 0) {
                return view('erm.form_dokter_edit', compact([
                    'kunjungan',
                    'asskep',
                    'now',
                    'assdok'
                    // 'Icd10',
                    // 'Icd9',
                ]));
            } else {
                return view('erm.form_dokter', compact([
                    'kunjungan',
                    'asskep',
                    'now'
                    // 'Icd10',
                    // 'Icd9',
                ]));
            }
        } else {
            return view('erm.NULL2');
        }
    }
    public function formTindakan(Request $request)
    {
        $tarif = Tarif::get();
        $assdok = AssesmenDokter::where('id_kunjungan', $request->idkunjungan)->get();
        if (count($assdok) > 0) {

            return view('erm.form_tindakan', compact([
                'tarif'
            ]));
        } else {
            return view('erm.NULL3');
        }
    }
    public function orderFarmasi(Request $request)
    {
        $barang = Barang::get();
        $assdok = AssesmenDokter::where('id_kunjungan', $request->idkunjungan)->get();
        if (count($assdok) > 0) {
            return view('erm.form_order_farmasi', compact([
                'barang'
            ]));
        } else {
            return view('erm.NULL3');
        }
    }
    public function orderPenunjang(Request $request)
    {
        return view('erm.form_order_penunjang');
    }
    public function resumeDokter(Request $request)
    {
        $assdok = AssesmenDokter::where('id_kunjungan', $request->idkunjungan)->get();
        $detail_tindakan = DB::select('SELECT * FROM layanan_headers a LEFT OUTER JOIN layanan_details b ON a.id = b.`id_header` WHERE  a.id_kunjungan = ?', [$request->idkunjungan]);
        return view('erm.resumedokter', compact([
            'assdok',
            'detail_tindakan'
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

            $cek_status_header = LayananHeader::where('id_kunjungan', $request->idkunjungan)->get();
            if (count($cek_status_header) > 0) {
                //harus dilooping
                foreach ($cek_status_header as $c) {
                    $id_header = $c->id;
                    if ($c->status_layanan == 0) {
                        $header = DB::table('layanan_headers')
                            ->where('id_kunjungan', $request->idkunjungan)
                            ->where('id', $id_header)
                            ->update(['status_layanan' => 1]);
                    }
                }
            }
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
        $riwayat = DB::select('SELECT *,b.tgl_kunjungan as asskep_tgl_kunjungan,b.tgl_pemeriksaan as asskep_tgl_pemeriksaan,b.keluhan_pasien as asskep_keluhan_pasien,
        b.sumber_data as asskep_sumber_data,
        b.tekanan_darah as asskep_tekanan_darah,
        b.frekuensi_nadi as asskep_frekuensi_nadi,
        b.frekuensi_nafas as asskep_frekuensi_nafas,
        b.suhu_tubuh as asskep_suhu_tubuh,
        b.riwayat_alergi as asskep_riwayat_alergi,
        b.keterangan_alergi as asskep_keterangan_alergi,
        b.id as id_perawat,c.id as id_dokter,b.signature as ttdperawat,c.signature as ttddokter FROM kunjungans a
        LEFT OUTER JOIN assesmen_perawats b ON a.`id` = b.`id_kunjungan`
        LEFT OUTER JOIN assesmen_dokters c ON b.id = c.id_asskep
        WHERE a.`pasien_id` = ?', [$request->idpasien]);
        return view('erm.form_catatan_medis_perawat', compact([
            // 'kunjungan',
            'riwayat'
        ]));
    }
    public function detailriwayatorder(Request $request)
    {
        $detail_tindakan = DB::select('SELECT * FROM layanan_headers a LEFT OUTER JOIN layanan_details b ON a.id = b.`id_header` WHERE          a.id_kunjungan = ?', [$request->kodekunjungan]);
        if (count($detail_tindakan) > 0) {
            return view('erm.riwayatorder', compact([
                'detail_tindakan'
            ]));
        } else {
            return view('erm.NULL');
        }
    }
    public function gambarMata1()
    {
        return view('erm.gambarmata1');
    }
    public function gambarMata2()
    {
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
                'nama_dokter' => auth()->user()->name,
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
                'koreksipenglihatan_vod_sph' => $dataSet['vod_sph_kpj'],
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
            if (count($cek) > 0) {
                $kunjungans = DB::table('assesmen_dokters')
                    ->where('id_kunjungan', $request->idkunjungan)
                    ->update($assdok);
            } else {
                $kunjungans = AssesmenDokter::create($assdok);
            }
            $asskep = DB::table('assesmen_perawats')
                ->where('id', $request->idaskep)
                ->update(['status' => 2]);
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
        $data = json_decode($_POST['data'], true);
        if (count($data) > 0) {
        } else {
            $data = [
                'kode' => 502,
                'message' => 'Silahkan Pilih Tindakan ...'
            ];
            echo json_encode($data);
            die;
        }
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'disc') {
                $arrayindex[] = $dataSet;
            }
        }
        $kodeheader = $this->createKodeHeader('KML');
        $dataheader = [
            'kode_layanan_header' => $kodeheader,
            'tgl_entry' => $this->get_now(),
            'id_kunjungan' => $request->idkunjungan,
            'kode_kunjungan' => $request->kodekunjungan,
            'kode_tipe_transaksi' => 1,
            'pic' => auth()->user()->id,
            'status_layanan' => 0,
            'keterangan' => '',
            'status_retur' => 'OPN',
            'kode_penjamin' => '1',
            'diskon_global' => '',
            'status_pembayaran' => '0',
            'id_dokter' => auth()->user()->id,
            'diagnosa' => '',
        ];
        $idheader = LayananHeader::create($dataheader);
        $total_layanan_header = 0;
        foreach ($arrayindex as $arr) {
            $total_layanan = $arr['tarif'] * $arr['qty'];
            if ($arr['disc'] != 0) {
                $grand_total_tarif = $arr['disc'] / 100 * $total_layanan;
            } else {
                $grand_total_tarif = $total_layanan;
            }
            $id_detail = $this->createLayanandetail();
            $save_detail = [
                'id_layanan_detail' => $id_detail,
                'kode_layanan_header' => $kodeheader,
                'nama_tarif' => $arr['namatindakan'],
                'kode_tarif' => $arr['kodelayanan'],
                'tarif' => $arr['tarif'],
                'jumlah_layanan' => $arr['qty'],
                'total_layanan' => $total_layanan,
                'diskon_layanan' => $arr['disc'],
                'grand_total_tarif' => $grand_total_tarif,
                'dokter' => auth()->user()->kode_dpjp,
                'pic' => auth()->user()->kode_dpjp,
                'status_layanan_detail' => '0',
                'tagihan_penjamin' => '',
                'tagihan_pribadi' =>  $grand_total_tarif,
                'tgl_layanan_detail' => $this->get_now(),
                'id_header' => $idheader['id']
            ];
            LayananDetail::create($save_detail);
            $total_layanan_header2 = $grand_total_tarif;
            $total_layanan_header = $total_layanan_header2 + $total_layanan_header;
        }
        LayananHeader::whereRaw('id = ?', array($idheader->id))->update(['total_layanan' => $total_layanan_header, 'tagihan_pribadi' => $total_layanan_header]);
        $assdok = DB::table('assesmen_dokters')
            ->where('id_kunjungan', $request->idkunjungan)
            ->update([
                'signature' => '',
                'status' => 0
            ]);
        $data = [
            'kode' => 200,
            'message' => 'Tindakan berhasil disimpan ...'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanOrderFarmasi(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        if (count($data) > 0) {
        } else {
            $data = [
                'kode' => 502,
                'message' => 'Silahkan Pilih Obat / Barang ...'
            ];
            echo json_encode($data);
            die;
        }
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'signa') {
                $arrayindex[] = $dataSet;
            }
        }
        $kodeheader = $this->createKodeHeader('KMF');
        $dataheader = [
            'kode_layanan_header' => $kodeheader,
            'tgl_entry' => $this->get_now(),
            'id_kunjungan' => $request->idkunjungan,
            'kode_kunjungan' => $request->kodekunjungan,
            'kode_tipe_transaksi' => 1,
            'pic' => auth()->user()->id,
            'status_layanan' => 0,
            'keterangan' => 'Order Farmasi',
            'status_retur' => 'OPN',
            'kode_penjamin' => '1',
            'diskon_global' => '',
            'status_pembayaran' => '0',
            'id_dokter' => auth()->user()->id,
        ];
        $idheader = LayananHeader::create($dataheader);
        $total_layanan_header = 0;
        foreach ($arrayindex as $arr) {
            $total_layanan = $arr['tarif'] * $arr['qty'];
            if ($arr['disc'] != 0) {
                $grand_total_tarif = $arr['disc'] / 100 * $total_layanan;
            } else {
                $grand_total_tarif = $total_layanan;
            }
            $id_detail = $this->createLayanandetail();
            $save_detail = [
                'id_layanan_detail' => $id_detail,
                'kode_layanan_header' => $kodeheader,
                'nama_tarif' => $arr['namatindakan'],
                'kode_tarif' => $arr['kodelayanan'],
                'tarif' => $arr['tarif'],
                'jumlah_layanan' => $arr['qty'],
                'total_layanan' => $total_layanan,
                'diskon_layanan' => $arr['disc'],
                'grand_total_tarif' => $grand_total_tarif,
                'dokter' => auth()->user()->kode_dpjp,
                'pic' => auth()->user()->kode_dpjp,
                'signa' => $arr['signa'],
                'satuan' => $arr['satuan'],
                'matakanan' => $arr['matakanan'],
                'matakiri' => $arr['matakiri'],
                'status_layanan_detail' => '0',
                'keterangan' => 'Order Farmasi',
                'tagihan_penjamin' => '',
                'tagihan_pribadi' =>  $grand_total_tarif,
                'tgl_layanan_detail' => $this->get_now(),
                'id_header' => $idheader['id']
            ];
            LayananDetail::create($save_detail);
            $total_layanan_header2 = $grand_total_tarif;
            $total_layanan_header = $total_layanan_header2 + $total_layanan_header;
        }
        LayananHeader::whereRaw('id = ?', array($idheader->id))->update(['total_layanan' => $total_layanan_header, 'tagihan_pribadi' => $total_layanan_header]);
        $assdok = DB::table('assesmen_dokters')
            ->where('id_kunjungan', $request->idkunjungan)
            ->update([
                'signature' => '',
                'status' => 0
            ]);
        $data = [
            'kode' => 200,
            'message' => 'Tindakan berhasil disimpan ...'
        ];
        echo json_encode($data);
        die;
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
    public function riwayatTindakan(Request $request)
    {
        $detail_tindakan = DB::select('SELECT * FROM layanan_headers a LEFT OUTER JOIN layanan_details b ON a.id = b.`id_header` WHERE  a.id_kunjungan = ? AND a.keterangan = ?', [$request->idkunjungan, '']);
        if (count($detail_tindakan) > 0) {
            return view('erm.riwayattindakan_today', compact([
                'detail_tindakan'
            ]));
        } else {
            return view('erm.NULL');
        }
    }
    public function ambilRiwayatOrder(Request $request)
    {
        $order = 'Order Farmasi';
        $detail_tindakan = DB::select('SELECT * FROM layanan_headers a LEFT OUTER JOIN layanan_details b ON a.id = b.`id_header` WHERE  a.id_kunjungan = ? AND a.keterangan = ?', [$request->idkunjungan, $order]);
        if (count($detail_tindakan) > 0) {
            return view('erm.riwayatorder_today', compact([
                'detail_tindakan'
            ]));
        } else {
            return view('erm.NULL');
        }
    }
}
