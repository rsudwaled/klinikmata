<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Models\Dokter;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravolt\Indonesia\Models\Provinsi;

class DokterController extends APIController
{
    public function index(Request $request)
    {
        $dokters = Dokter::latest()
            ->where('nama', 'LIKE', "%{$request->search}%")
            ->orWhere('kode', 'LIKE', "%{$request->search}%")
            ->simplePaginate(20);
        $total_dokter = Dokter::count();
        $provinsi = Provinsi::pluck('name', 'code');
        $poliklinik = Poliklinik::pluck('namasubspesialis', 'kodesubspesialis');

        return view('admin.dokter_index', compact([
            'dokters',
            'provinsi',
            'poliklinik',
            'request',
            'total_dokter',
        ]));
    }
    public function edit($id)
    {
        $dokter = Dokter::find($id);
        return response()->json($dokter);
    }
    public function store(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $validator = Validator::make(request()->all(), [
            "nik" =>  "required|numeric",
            "kode" => "required",
            "nama" =>  "required",
            "nohp" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        Dokter::create($request->except('_token'));
        return response()->json($request);
    }
    public function update(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $validator = Validator::make(request()->all(), [
            "nik" =>  "required|numeric",
            "kode" => "required",
            "nama" =>  "required",
            "nohp" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        $pasien = Dokter::find($request->id);
        $pasien->update($request->except('_token'));
        return response()->json($pasien);
    }
}
