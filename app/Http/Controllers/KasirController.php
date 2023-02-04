<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kunjungan;
use App\Models\LayananDetail;
use App\Models\LayananHeader;

class KasirController extends Controller
{
    public function index()
    {
        return view('kasir.index');
    }
    public function ambildatakunjungan()
    {
        $kunjungan = Kunjungan::get();
        return view('kasir.datakunjungan', compact([
            'kunjungan'
        ]));
    }
    public function detailbayar(Request $request)
    {
        $id_kunjungan = $request->idkunjungan;
        $datalayanan = LayananHeader::where('id_kunjungan', $request->idkunjungan)->where('status_layanan', 1)->get();
        $datalayanan2 = LayananHeader::where('id_kunjungan', $request->idkunjungan)->where('status_layanan', 2)->get();
        return view('kasir.detailbayar', compact([
            'datalayanan',
            'datalayanan2',
            'id_kunjungan'
        ]));
    }
    public function bayarlayanan(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        try {
            foreach ($data as $nama) {
                $index = $nama['name'];
                $value = $nama['value'];
                $dataSet[$index] = $value;
                if ($index == 'total_layanan') {
                    $arrayindex[] = $dataSet;
                }
            }
            $d = $arrayindex;
            return view('kasir.detailpembayaran', compact([
                'd'
            ]));
        } catch (\Exception $e) {
            echo 'Data tidak ditemukan';
        }
    }
    public function simpanpembayaran(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        try{

            foreach ($data as $nama) {
                $index = $nama['name'];
                $value = $nama['value'];
                $dataSet[$index] = $value;
                if ($index == 'idheader') {
                    $arrayindex[] = $dataSet;
                }
            }
        }catch(\Exception $e){
            $data = [
                'kode' => 502,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }

        foreach($arrayindex as $arr){
            try{
                LayananHeader::whereRaw('id = ?', array($arr['idheader']))->update(['status_layanan' => 2, 'status_retur' => 'CLS','status_pembayaran' => 1]);
            }catch(\Exception $e){
                $data = [
                    'kode' => 502,
                    'message' => $e->getMessage()
                ];
                echo json_encode($data);
                die;
            }
            try{
                LayananDetail::whereRaw('id_header = ?', array($arr['idheader']))->update(['status_layanan_detail' => 2]);
            }catch(\Exception $e){
                $data = [
                    'kode' => 502,
                    'message' => $e->getMessage()
                ];
                echo json_encode($data);
                die;
            }
        }
        $data = [
            'kode' => 200,
            'message' => 'Data Pembayaran Berhasil disimpan !'
        ];
        echo json_encode($data);
        die;

    }
}
