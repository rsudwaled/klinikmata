<?php

namespace App\Http\Controllers\Pendaftaran;

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

class PendaftaranController extends Controller
{
    public function indexPendaftaran(Request $request)
    {
        return view('Pendaftaran.index_pendaftaran');
    }
    public function dataPasienBaru(Request $request)
    {
        return view('Pendaftaran.datapasienbaru',[
            'datapasien' => DB::select('Select * from pasiens')
        ]);
    }
    public function formPendaftaran(Request $request)
    {
        return view('Pendaftaran.formpendaftaran',[
            'datapasien' => DB::select('Select * from pasiens where no_rm = ?',[$request->nomorrm])
        ]);
    }
}
