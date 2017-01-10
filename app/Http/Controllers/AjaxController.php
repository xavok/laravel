<?php

namespace App\Http\Controllers;

use App\Models\OccupationSubtypes;
use Illuminate\Http\Request;

use App\Http\Requests;

class AjaxController extends Controller
{
    //
    public function occupationTypes(Request $request, $id){
        $types = OccupationSubtypes::where('occupation_id',$id)->get();
        return response()->json($types);
    }
}
