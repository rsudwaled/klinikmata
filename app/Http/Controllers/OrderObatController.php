<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class OrderObatController extends Controller
{
    public function index(Request $request)
    {
        $obats = Obat::latest()->get();
        return view('admin.orderobat_index', compact([
            'obats',
        ]));
    }
}
