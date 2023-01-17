<?php

namespace App\Http\Controllers;

use App\Models\Poliklinik;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    public function index(Request $request)
    {
        $polikliniks = Poliklinik::get();
        return view('admin.poliklinik_index',compact([
            'polikliniks'
        ]));
    }
}
