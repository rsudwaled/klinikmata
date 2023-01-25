<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Kabupaten;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Provinsi;
use Laravolt\Indonesia\Models\Village;

class LaravoltController extends Controller
{
    public function get_provinsi(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $prov = Provinsi::orderby('name', 'asc')
            ->select('code', 'name')
            ->limit(5)->get();
        } else {
            $prov = Provinsi::orderby('name', 'asc')
            ->where('code',  $request->search)
            ->orWhere('name', 'like', '%' . $request->search . '%')
            ->select('code', 'name')
            ->limit(5)->get();
        }
        $response = array();
        foreach ($prov as $item) {
            $response[] = array(
                "id" => $item->code,
                "text" =>  $item->name
            );
        }
        return response()->json($response);
    }
    public function get_kabupaten(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $kab = Kabupaten::orderby('name', 'asc')
                ->where('province_code',  $request->code)
                ->select('code', 'name')
                ->limit(5)->get();
        } else {
            $kab = Kabupaten::orderby('name', 'asc')
                ->select('code', 'name')
                ->where('province_code',  $request->code)
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')
                ->limit(5)->get();
        }
        $response = array();
        foreach ($kab as $item) {
            $response[] = array(
                "id" => $item->code,
                "text" =>  $item->name
            );
        }
        return response()->json($response);
    }
    public function get_kecamatan(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $kec = Kecamatan::orderby('name', 'asc')
                ->where('city_code',  $request->code)
                ->select('code', 'name')
                ->limit(5)->get();
        } else {
            $kec = Kecamatan::orderby('name', 'asc')
                ->where('city_code',  $request->code)
                ->select('code', 'name')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')
                ->limit(5)->get();
        }
        $response = array();
        foreach ($kec as $item) {
            $response[] = array(
                "id" => $item->code,
                "text" =>  $item->name
            );
        }
        return response()->json($response);
    }
    public function get_desa(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $desa = Village::orderby('name', 'asc')
                ->where('district_code',  $request->code)
                ->select('code', 'name')
                ->limit(5)->get();
        } else {
            $desa = Village::orderby('name', 'asc')
                ->where('district_code',  $request->code)
                ->select('code', 'name')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')
                ->limit(5)->get();
        }
        $response = array();
        foreach ($desa as $item) {
            $response[] = array(
                "id" => $item->code,
                "text" =>  $item->name
            );
        }
        return response()->json($response);
    }
}
