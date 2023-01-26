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
        $stok  =  StokObat::with(['supplier'])->find($id);
        return response()->json($stok);
    }
    public function store(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            "stok_in" =>  "required",
            "obat_id" =>  "required",
            "unit_id" =>  "required",
            "tgl_expire" =>  "required|date",
            "supplier_id" =>  "required",
            "invoice" =>  "required",
            "harga_beli" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        $request['pic'] = Auth::user()->id;
        $unit = Unit::find($request->unit_id);
        $request['transaksi_id'] = $unit->kode . now()->format('dm') . Transaksi::whereDate('created_at', now()->today())->count() + 1;
        $request['kode'] = $unit->kode . now()->format('dm') . StokObat::whereDate('created_at', now()->today())->count() + 1;

        StokObat::create($request->except('_token'));
        $obat  = Obat::find($request->obat_id);
        $ppn = $request->harga_beli * $request->ppn / 100;
        $pph = $request->harga_beli * $request->pph / 100;
        $diskon = $request->harga_beli * $request->diskon / 100;
        $total = $request->harga_beli + $ppn + $pph - $diskon;
        Transaksi::create([
            'kode' => $request->transaksi_id,
            'nama' => "PO OBAT " . $obat->nama,
            'kredit' => $total,
            'keterangan' => "PO OBAT " . $obat->nama,
            'pic' => $request->pic,
            'status' => 1,
        ]);
        return response()->json($request);
    }
}
