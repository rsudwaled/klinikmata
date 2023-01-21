<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $satuan = Supplier::get();
        return view('admin.supplier_index', compact([
            'satuan'
        ]));
    }
}
