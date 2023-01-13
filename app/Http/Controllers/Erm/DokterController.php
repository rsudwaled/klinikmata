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

class DokterController extends Controller
{
    public function indexDokter(Request $request)
    {
        return view('erm.index_dokter');
    }
    public function formPemeriksaan(Request $request)
    {
        return view('erm.form_dokter');
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
}
