<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoliklinikController extends APIController
{
    public function index(Request $request)
    {
        $polikliniks = Poliklinik::get();
        return view('admin.poliklinik_index', compact([
            'polikliniks'
        ]));
    }
    public function show($id)
    {
        $dokter = Poliklinik::find($id);
        return response()->json($dokter);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            "kodepoli" =>  "required",
            "namapoli" =>  "required",
            "kodesubspesialis" =>  "required",
            "namasubspesialis" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        if ($request->status == "true") {
            $request['status'] = 1;
        } else {
            $request['status'] = 0;
        }

        Poliklinik::create($request->except('_token'));
        return response()->json($request->all());
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            "kodepoli" =>  "required",
            "namapoli" =>  "required",
            "kodesubspesialis" =>  "required",
            "namasubspesialis" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), null, 400);
        }
        if ($request->status == "true") {
            $request['status'] = 1;
        } else {
            $request['status'] = 0;
        }
        $item = Poliklinik::find($id);
        $item->update($request->except('_token'));
        return response()->json($item);
    }
}
