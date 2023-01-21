<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Imports\ObatImport;
use App\Models\Obat;
use App\Models\SatuanObat;
use App\Models\StokObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ObatController extends APIController
{
    public function index(Request $request)
    {
        $obats = Obat::latest()->get();
        $satuan = SatuanObat::pluck('nama','id');
        return view('admin.obat_index', compact([
            'obats',
            'satuan',
        ]));
    }
    public function edit($id)
    {
        $obat = Obat::find($id);
        return response()->json($obat);
    }
    public function store(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $obat_count = Obat::count();
        $kode = 'OB' . str_pad($obat_count + 1, 4, '0', STR_PAD_LEFT);
        $request['kode'] = $kode;
        $validator = Validator::make(request()->all(), [
            "nama" =>  "required",
            "satuan_id" => "required",
            "jenis" =>  "required",
            "kode" =>  "required",
            "pic" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        Obat::create($request->except('_token'));
        return response()->json($request);
    }
    public function update(Request $request)
    {
        $request['pic'] = Auth::user()->id;
        $validator = Validator::make(request()->all(), [
            "nama" =>  "required",
            "satuan_id" => "required",
            "jenis" =>  "required",
            "kode" =>  "required",
            "pic" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        if ($request->status == "true") {
            $request['status'] = 1;
        } else {
            $request['status'] = 0;
        }
        $pasien = Obat::find($request->id);
        $pasien->update($request->except('_token'));
        return response()->json($pasien);
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
        Excel::import(new ObatImport, public_path('/storage/' . $nama_file));

        // notifikasi dengan session
        Alert::success('sukses', 'Data obat berhasil diimport');

        // alihkan halaman kembali
        return redirect()->route('obat.index');
    }
}
