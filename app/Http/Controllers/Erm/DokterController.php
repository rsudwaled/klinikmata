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

class DokterController extends Controller
{
    public function indexDokter(Request $request)
    {
        $kunjungan = Kunjungan::where('status', 1)->get();
        return view('erm.index_dokter',compact([
            'kunjungan'
        ]));
    }
    public function formPemeriksaan(Request $request)
    {
        $Icd10 = Icd10::get();
        $Icd9 = Icd9::get();
        return view('erm.form_dokter',compact([
            'Icd10',
            'Icd9',
        ]));
    }
    public function formTindakan(Request $request)
    {
        return view('erm.form_tindakan');
    }
    public function orderFarmasi(Request $request)
    {
        return view('erm.form_order_farmasi');
    }
    public function orderPenunjang(Request $request)
    {
        return view('erm.form_order_penunjang');
    }
    public function formCatatanMedis(Request $request)
    {
        return view('erm.form_catatan_medis');
    }
}
