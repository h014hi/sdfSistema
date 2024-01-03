<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;

class UbigeoController extends Controller
{
    public function getDistricts($provinceId)
    {
        $distritos = District::where('province_id', $provinceId)->get();
        return response()->json($distritos);
    }
}
