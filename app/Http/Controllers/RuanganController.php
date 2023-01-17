<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $ruangans = Ruangan::get();
        return view('admin.ruangan_index', compact([
            'ruangans'
        ]));
    }
}
