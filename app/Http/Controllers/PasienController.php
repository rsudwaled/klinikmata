<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $pasiens = Pasien::orderBy('id', 'desc')
            ->where('no_rm', 'LIKE', "%{$request->search}%")
            ->orWhere('nama', 'LIKE', "%{$request->search}%")
            ->orWhere('nik', 'LIKE', "%{$request->search}%")
            ->simplePaginate(20);
        $total_pasien = Pasien::count();
        $pasien_jkn = Pasien::where('no_bpjs', '!=', '')->count();
        $pasien_nik = Pasien::where('nik', '!=', '')->count();
        $pasien_laki = Pasien::where('sex', 'L')->count();
        $pasien_perempuan = Pasien::where('sex', 'P')->count();
        return view('admin.pasien_index', compact([
            'pasiens',
            'request',
            'total_pasien',
            'pasien_jkn',
            'pasien_nik',
            'pasien_laki',
            'pasien_perempuan',
        ]));
    }
    public function edit($id)
    {
        $pasien = Pasien::find($id);
        return response()->json($pasien);
    }
    public function store(Request $request)
    {
        Pasien::create($request->except('_token'));
        return response()->json($request);
    }
    public function update(Request $request)
    {
        $pasien = Pasien::find($request->id);
        $pasien->update($request->except('_token'));
        return response()->json($pasien);
    }
}
