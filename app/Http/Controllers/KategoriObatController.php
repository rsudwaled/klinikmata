<?php

namespace App\Http\Controllers;

use App\Models\KategoriObat;
use Illuminate\Http\Request;

class KategoriObatController extends Controller
{
    public function index(Request $request)
    {
        $satuan = KategoriObat::get();
        return view('admin.kategori_obat_index', compact([
            'satuan'
        ]));
    }
}
