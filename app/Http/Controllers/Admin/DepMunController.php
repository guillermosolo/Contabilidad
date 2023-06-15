<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DepMun;
use Illuminate\Http\Request;

class DepMunController extends Controller
{
    public function getMunicipios(Request $request, $depto)
    {
        if ($request->ajax()){ 
            $municipios = DepMun::getMunicipios(substr($depto,0,strlen($depto)-2));
            return response()->json($municipios);
        } else {
            abort(404);
        }
    }
}
