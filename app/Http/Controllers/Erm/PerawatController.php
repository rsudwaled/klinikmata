<?php

namespace App\Http\Controllers\Erm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use App\Models\Icd10;
use App\Models\Icd9;
use App\Models\Dokter;
use App\Models\Kunjungan;

class PerawatController extends Controller
{
    public function indexPerawat(Request $request)
    {
        $kunjungan = Kunjungan::where('status', 1)->get();
        return view('erm.index_perawat', compact([
            'kunjungan'
        ]));
    }
    public function indexErmPerawat(Request $request)
    {
        // kodekunjungan
        // idkunjungan
        $kunjungan = Kunjungan::where('kode', $request->kodekunjungan)->first();
        return view('erm.index_erm_perawat',compact([
            'kunjungan'
        ]));
    }
    public function formCatatanMedis(Request $request)
    {
        $kunjungan = Kunjungan::where('kode', $request->kodekunjungan)->first();
        return view('erm.form_catatan_medis_perawat',compact([
            'kunjungan'
        ]));
    }
     public function formPemeriksaan(Request $request)
    {
        return view('erm.form_perawat');
    }
}
