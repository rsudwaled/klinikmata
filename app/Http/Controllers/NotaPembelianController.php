<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Models\Barang;
use App\Models\NotaPembelian;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotaPembelianController extends APIController
{
    public function index(Request $request)
    {
        $nota = NotaPembelian::get();
        $barang = Barang::pluck('nama', 'id');
        $supplier = Supplier::pluck('nama', 'id');
        $unit = Unit::pluck('nama', 'id');
        return view('admin.nota_pembelian', compact([
            'request',
            'nota',
            'barang',
            'supplier',
            'unit',
        ]));
    }
    public function show($id)
    {
        $item = NotaPembelian::find($id);
        return response()->json($item);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            "supplier_id" =>  "required",
            "tanggal_faktur" =>  "required|date",
            "nomor_faktur" =>  "required",
            "barang_id" =>  "required",
            "jumlah" =>  "required",
            "harga_beli" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        $request['pic'] = Auth::user()->id;
        $request['kode'] = "NPB" . now()->format('dm') . NotaPembelian::whereDate('created_at', now()->today())->count() + 1;
        NotaPembelian::create($request->except('_token'));
        return response()->json($request);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            "supplier_id" =>  "required",
            "tanggal_faktur" =>  "required|date",
            "nomor_faktur" =>  "required",
            "barang_id" =>  "required",
            "jumlah" =>  "required",
            "harga_beli" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        $request['pic'] = Auth::user()->id;
        NotaPembelian::find($id)->update($request->except('_token'));
        return response()->json($request);
    }
}
