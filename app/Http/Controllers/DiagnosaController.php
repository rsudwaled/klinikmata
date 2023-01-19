<?php

namespace App\Http\Controllers;

use App\Models\Icd10;
use App\Models\Icd9;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index_icd10(Request $request)
    {
        $icd = Icd10::simplePaginate(20);
        if (isset($request->kode)) {
            $icd = Icd10::where('diag', 'LIKE', "%{$request->kode}%")
                ->simplePaginate(20);
        }
        if (isset($request->nama)) {
            $icd = Icd10::where('nama', 'LIKE', "%{$request->nama}%")
                ->simplePaginate(20);
        }

        $total_icd = Icd10::count();

        return view('admin.icd10_index', compact([
            'icd',
            'request',
            'total_icd',
        ]));
    }
    public function index_icd9(Request $request)
    {
        $icd = Icd9::simplePaginate(20);
        if (isset($request->kode)) {
            $icd = Icd9::where('diag', 'LIKE', "%{$request->kode}%")
                ->simplePaginate(20);
        }
        if (isset($request->nama)) {
            $icd = Icd9::where('nama_panjang', 'LIKE', "%{$request->nama}%")
                ->simplePaginate(20);
        }

        $total_icd = Icd9::count();
        return view('admin.icd9_index', compact([
            'icd',
            'request',
            'total_icd',

        ]));
    }
}
