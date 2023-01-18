<?php

namespace App\Http\Controllers;

use App\Imports\TarifImport;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TarifController extends Controller
{
    public function index(Request $request)
    {
        $tarif = Tarif::get();
        return view('admin.tarif_index', compact([
            'tarif'
        ]));
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
        Excel::import(new TarifImport, public_path('/storage/' . $nama_file));

        // notifikasi dengan session
        Alert::success('sukses', 'Data Siswa Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect()->route('tarif.index');
    }
}
