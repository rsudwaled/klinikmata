<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Support\Arr;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use RealRashid\SweetAlert\Facades\Alert;
// use Spatie\Permission\Models\Role;
use App\Models\Pasien;

class PendaftaranController extends Controller
{
    public function indexPendaftaran(Request $request)
    {
        return view('Pendaftaran.index_pendaftaran');
    }
    public function dataPasienBaru(Request $request)
    {

        $pasiens = Pasien::get();
        return view('Pendaftaran.datapasienbaru',[
            'datapasien' => $pasiens
        ]);
    }
    public function formPendaftaran(Request $request)
    {
        $pasiens = Pasien::where('no_rm', $request->nomorrm)->first();
        return view('Pendaftaran.formpendaftaran',compact([
            'pasiens'
        ]));
    }
}
