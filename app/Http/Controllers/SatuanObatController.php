<?php

namespace App\Http\Controllers;

use App\Models\SatuanObat;
use Illuminate\Http\Request;

class SatuanObatController extends Controller
{
    public function index(Request $request)
    {
        $satuan = SatuanObat::get();
        return view('admin.satuan_obat_index', compact([
            'satuan'
        ]));
    }
}
