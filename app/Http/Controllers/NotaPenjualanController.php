<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Models\Barang;
use App\Models\NotaPenjualan;
use App\Models\Pasien;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotaPenjualanController extends APIController
{
    public function index(Request $request)
    {
        $nota = NotaPenjualan::with(['pasien', 'barang'])->get();
        $barang = Barang::pluck('nama', 'id');
        $pasien = Pasien::pluck('nama', 'id');
        $unit = Unit::pluck('nama', 'id');
        return view('admin.nota_penjualan', compact([
            'request',
            'nota',
            'barang',
            'pasien',
            'unit',
        ]));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            "tanggal_faktur" => "required|date",
            "nomor_faktur" => "required",
            "barang_id" => "required",
            "jumlah" => "required|numeric",
            "harga_jual" => "required|numeric",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        $request['pic'] = Auth::user()->id;
        $request['kode'] = "NPJ" . now()->format('dm') . str_pad(NotaPenjualan::whereDate('created_at', now()->today())->count() + 1, 4, '0', STR_PAD_LEFT);
        NotaPenjualan::create($request->except('_token'));
        return response()->json($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
