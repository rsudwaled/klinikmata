<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JadwalDokterController extends APIController
{
    public function index(Request $request)
    {
        $jadwals = JadwalDokter::get();
        $polikliniks = Poliklinik::get();
        $dokters = Dokter::get();
        return view('admin.jadwaldokter_index', compact([
            'jadwals',
            'request',
            'polikliniks',
            'dokters'
        ]));
    }
    public function edit($id)
    {
        $jadwal = JadwalDokter::find($id);
        return response()->json($jadwal);
    }
    public function store(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $validator = Validator::make(request()->all(), [
            "pic" => "required|numeric",
            "kodedokter" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        if ($request->libur == "true") {
            $request['libur'] = 1;
        } else {
            $request['libur'] = 0;
        }
        $poli = Poliklinik::where('kodesubspesialis', $request->kodesubspesialis)->first();
        $request['kodepoli'] = $poli->kodepoli;
        $request['namapoli'] = $poli->namapoli;
        $request['namasubspesialis'] = $poli->namasubspesialis;

        $dokter = Dokter::where('kode', $request->kodedokter)->first();
        $request['namadokter'] = $dokter->nama;
        $request['kodedokter_jkn'] = $dokter->kode_jkn;

        JadwalDokter::create($request->except('_token'));
        return response()->json($request);
    }

    public function update(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $validator = Validator::make(request()->all(), [
            "id" => "required|numeric",
            "pic" => "required|numeric",
            "kodedokter" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        if ($request->libur == "true") {
            $request['libur'] = 1;
        } else {
            $request['libur'] = 0;
        }

        $poli = Poliklinik::where('kodesubspesialis', $request->kodesubspesialis)->first();
        $request['kodepoli'] = $poli->kodepoli;
        $request['namapoli'] = $poli->namapoli;
        $request['namasubspesialis'] = $poli->namasubspesialis;

        $dokter = Dokter::where('kode', $request->kodedokter)->first();
        $request['namadokter'] = $dokter->nama;
        $request['kodedokter_jkn'] = $dokter->kode_jkn;

        $jadwal = JadwalDokter::find($request->id);
        $jadwal->update($request->except('_token'));
        return response()->json($jadwal);
    }
}
