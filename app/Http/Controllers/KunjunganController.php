<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KunjunganController extends APIController
{
    public function index(Request $request)
    {
        if (empty($request->search)) {
            $kunjungans = Kunjungan::with(['pasien'])
                ->orderByDesc('tgl_masuk')
                ->simplePaginate();
        } else {
            $kunjungans  = Kunjungan::with(['pasien'])
                ->whereHas('pasien', function ($q) use ($request) {
                    $value =  $request->search;
                    $q->where('no_rm', "LIKE", "%" . $value . "%")
                        ->orWhere('nama', "LIKE", "%" . $value . "%");
                })->simplePaginate();
        }
        $kunjungan_total = Kunjungan::count();
        $kunjungan_today = Kunjungan::whereDate('tgl_masuk', now())->count();
        return view('admin.kunjungan_index', compact([
            'request',
            'kunjungans',
            'kunjungan_total',
            'kunjungan_today'
        ]));
    }
    public function edit($id)
    {
        $kunjungan = Kunjungan::with(['pasien', 'dokter'])->find($id);
        return response()->json($kunjungan);
    }
    public function update(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $validator = Validator::make(request()->all(), [
            "id" => "required|numeric",
            "status" =>  "required",
            "pic" => "required|numeric",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        if ($request->status == "99") {
            $request['tgl_keluar'] = now();
        }
        $kunjungan = Kunjungan::find($request->id);
        $kunjungan->update([
            'pic' => $request->pic,
            'status' => $request->status,
            'tgl_keluar' => $request->tgl_keluar,
        ]);
        return response()->json($kunjungan);
    }
}
