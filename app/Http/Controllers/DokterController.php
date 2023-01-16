<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $dokters = Dokter::latest()
            ->where('nama', 'LIKE', "%{$request->search}%")
            ->orWhere('kode', 'LIKE', "%{$request->search}%")
            ->simplePaginate(20);
        $total_dokter = Dokter::count();
        return view('admin.dokter_index', compact([
            'dokters',
            'request',
            'total_dokter',
        ]));
    }
}
