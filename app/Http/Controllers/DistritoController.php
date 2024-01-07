<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;

class DistritoController extends Controller
{
    public function getDistritos($id){
        $provincia = Province::find($id);
        return District::where('province_id',$provincia->id)->get();
    }
}
