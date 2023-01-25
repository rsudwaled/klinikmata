<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = Transaksi::get();
        return view('admin.transaksi_index', compact([
            'transaksi',
            'request',
        ]));
    }
}
