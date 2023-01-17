<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index(Request $request)
    {
        // if (empty($request->search)) {
        //     $kunjungans = KunjunganDB::with(['pasien', 'unit', 'penjamin'])
        //         ->orderByDesc('tgl_masuk')
        //         ->paginate();
        // } else {
        //     $kunjungans = KunjunganDB::with(['pasien', 'unit', 'penjamin'])
        //         ->where('no_rm',  $request->search)
        //         ->orderByDesc('tgl_masuk')
        //         ->paginate();
        // }

        // $status_kunjungan = StatusKunjunganDB::pluck('status_kunjungan', 'id');
        // $alasan_masuk = AlasanMasukDB::pluck('alasan_masuk', 'id');
        // $alasan_pulang = AlasanPulangDB::pluck('alasan_pulang', 'kode');
        $kunjungans = Kunjungan::simplePaginate();

        return view('admin.kunjungan_index', [
            'request' => $request,
            'kunjungans' => $kunjungans,
        ]);
    }
}
