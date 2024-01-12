<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fracum;
use App\Models\FracumFather;
use App\Models\FracumSon;


class fracumController extends Controller
{
    public function getFracums($id){
        $fracumf= FracumFather::find($id);
        return FracumSon::where('fracumfather_id',$fracumf->id)->get();
    }
    /*
    public function getIncumplimientos($id){
        $incumplimiento = Incumplimiento::find($id);
        return Incum::where('incumplimiento_id',$incumplimiento->id)->get();
    }

    public function store(Request $request)
    {


        return redirect()->back();
    }*/
}
