<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Models\KategoriObat;
use App\Models\Obat;
use App\Models\StokObat;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StokObatController extends APIController
{
    public function index(Request $request)
    {
        $stoks = StokObat::get();
        $obats = Obat::with('satuan')->get(['nama', 'id', 'satuan_id']);
        $kategori = KategoriObat::pluck('nama', 'id');
        $supplier = Supplier::pluck('nama', 'id');
        $units = Unit::pluck('nama', 'id');
        return view('admin.stok_obat_index', compact([
            'stoks',
            'obats',
            'request',
            'kategori',
            'supplier',
            'units',
        ]));
    }
    public function edit($id)
    {
        $stok  =  StokObat::find($id);
        return response()->json($stok);
    }
    public function store(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $unit = Unit::find($request->unit_id);
        $request['transaksi_id'] = $unit->kode . now()->format('dm') . Transaksi::whereDate('created_at', now()->today())->count() + 1;
        $request['kode'] = $unit->kode . now()->format('dm') . StokObat::whereDate('created_at', now()->today())->count() + 1;
        $validator = Validator::make(request()->all(), [
            "kode" =>  "required",
            "stok_in" =>  "required",
            "obat_id" =>  "required",
            "kategori_id" =>  "required",
            "unit_id" =>  "required",
            "tgl_expire" =>  "required|date",
            "transaksi_id" =>  "required",
            "supplier_id" =>  "required",
            "invoice" =>  "required",
            "harga_beli" =>  "required",
            "pic" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        StokObat::create($request->except('_token'));
        Transaksi::create([
            'kode' => $request->transaksi_id,
            'nama' => "PO OBAT ",
            'kredit' => $request->harga_beli,
            'keterangan' => "PO OBAT ",
            'pic' => $request->pic,

        ]);
        return response()->json($request);
    }
}
