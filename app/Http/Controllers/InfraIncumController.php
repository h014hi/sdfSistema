<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infra;
use App\Models\Infraccions;
use App\Models\Incum;
use App\Models\Incumplimiento;
use App\Models\Infra_Incum;

class InfraIncumController extends Controller
{
    public function getInfracciones($id){
        $infraccion = Infraccions::find($id);
        return Infra::where('infraccion_id',$infraccion->id)->get();
    }

    public function getIncumplimientos($id){
        $incumplimiento = Incumplimiento::find($id);
        return Incum::where('incumplimiento_id',$incumplimiento->id)->get();
    }

    public function store(Request $request)
    {
        $nuevo_infra_incum = new Infra_Incum;
        $nuevo_infra_incum->tipo = $request->input('seleccion');
        $nuevo_infra_incum->infracion_id = $request->input('infraccion');
        $nuevo_infra_incum->infra_id = $request->input('infra_sub');
        $nuevo_infra_incum->incumplimiento_id = $request->input('incumplimiento');
        $nuevo_infra_incum->incum_id = $request->input('incum_sub');
        $nuevo_infra_incum->save();

        return redirect()->back();
    }
}
