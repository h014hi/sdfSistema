<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;

class DistritoController extends Controller
{
    public function getDistritos($id){
        return Province::find($id)->provincia;
    }
}
