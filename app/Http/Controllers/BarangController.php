<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Imports\BarangImport;
use App\Models\Barang;
use App\Models\SatuanBarang;
use App\Models\SatuanObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends APIController
{
    public function index()
    {
        $barangs = Barang::with(['user'])->latest()->get();
        $satuan = SatuanBarang::pluck('nama', 'id');
        return view('admin.barang_index', compact([
            'barangs',
            'satuan',
        ]));
    }
    public function show($id)
    {
        $item = Barang::find($id);
        return response()->json($item);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            "nama" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        $request['pic'] = Auth::user()->id;
        $request['kode'] = 'B' . str_pad(Barang::count() + 1, 6, '0', STR_PAD_LEFT);
        Barang::create($request->except('_token'));
        return response()->json($request);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            "nama" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        $request['pic'] = Auth::user()->id;
        if ($request->status == "true") {
            $request['status'] = 1;
        } else {
            $request['status'] = 0;
        }
        $item = Barang::find($id);
        $item->update($request->except('_token'));
        return response()->json($item);
    }
    public function import(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        // menangkap file excel
        $file = $request->file('file');
        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();
        // upload ke folder file_siswa di dalam folder public
        $file->move('storage', $nama_file);
        // import data
        Excel::import(new BarangImport, public_path('/storage/' . $nama_file));
        // notifikasi dengan session
        Alert::success('sukses', 'Data obat berhasil diimport');
        // alihkan halaman kembali
        return redirect()->back();
    }
}
