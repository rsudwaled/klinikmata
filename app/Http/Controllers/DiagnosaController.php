<?php

namespace App\Http\Controllers;

use App\Models\Icd10;
use App\Models\Icd9;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index_icd10(Request $request)
    {
        $icd = Icd10::where('diag', 'LIKE', "%{$request->search}%")
            // ->orWhere('nama', 'LIKE', "%{$request->search}%")
            ->simplePaginate(20);

        return view('admin.icd10_index', compact([
            'icd',
            'request',
        ]));
    }
    public function index_icd9(Request $request)
    {
        $icd = Icd9::where('diag', 'LIKE', "%{$request->search}%")
            // ->orWhere('nama', 'LIKE', "%{$request->search}%")
            ->simplePaginate(20);
        return view('admin.icd9_index', compact([
            'icd',
            'request',
        ]));
        // dd($icd10);
    }
}
