<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $units = Unit::get();
        return view('admin.unit_index', compact([
            'units'
        ]));
    }
}
