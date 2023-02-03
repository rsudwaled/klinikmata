<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Models\Pasien;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravolt\Indonesia\Models\Provinsi;

class PasienController extends APIController
{
    public function index(Request $request)
    {
        $pasiens = Pasien::orderBy('id', 'desc')
            ->where('no_rm', 'LIKE', "%{$request->search}%")
            ->orWhere('nama', 'LIKE', "%{$request->search}%")
            ->orWhere('nik', 'LIKE', "%{$request->search}%")
            ->simplePaginate(20);
        $total_pasien = Pasien::count();
        $pasien_jkn = Pasien::where('no_bpjs', '!=', '')->count();
        $pasien_nik = Pasien::where('nik', '!=', '')->count();
        $pasien_laki = Pasien::where('sex', 'L')->count();
        $pasien_perempuan = Pasien::where('sex', 'P')->count();

        $provinsi = Provinsi::pluck('name', 'code');
        return view('admin.pasien_index', compact([
            'pasiens',
            'provinsi',
            'request',
            'total_pasien',
            'pasien_jkn',
            'pasien_nik',
            'pasien_laki',
            'pasien_perempuan',
        ]));
    }
    public function edit($id)
    {
        $pasien = Pasien::find($id);
        return response()->json($pasien);
    }
    public function store(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $request['no_rm'] = 'A' . str_pad(Pasien::count() + 1, 6, '0', STR_PAD_LEFT);
        $validator = Validator::make(request()->all(), [
            "nik" => "required|numeric|digits:16",
            "nama" =>  "required",
            "sex" =>  "required",
            "tempat_lahir" =>  "required",
            "tgl_lahir" =>  "required|date",
            "nohp" =>  "required",

            "provinsi" =>  "required",
            "kabupaten" =>  "required",
            "kecamatan" =>  "required",
            "desa" =>  "required",
            "alamat" =>  "required",

            "no_rm" =>  "required",
            "pic" => "required|numeric",

        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        Pasien::create($request->except('_token'));

        // $request['transaksi_id'] = 'DAFTAR' . now()->format('dm') . Transaksi::whereDate('created_at', now()->today())->count() + 1;
        // Transaksi::create([
        //     'kode' => $request->transaksi_id,
        //     'nama' => "Daftar Pasien Baru",
        //     'debit' => 60000,
        //     'keterangan' => "Daftar Pasien Baru " . $request->nama,
        //     'pic' => $request->pic,
        //     'status' => 0,
        // ]);
        return response()->json($request->all());
    }
    public function update(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $validator = Validator::make(request()->all(), [
            "id" => "required|numeric",
            "nik" => "required|numeric",
            "nama" =>  "required",
            "sex" =>  "required",
            "tempat_lahir" =>  "required",
            "tgl_lahir" =>  "required|date",
            "nohp" =>  "required",
            "pic" => "required|numeric",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }


        $pasien = Pasien::find($request->id);
        $pasien->update($request->except('_token'));
        return response()->json($pasien);
    }
}
