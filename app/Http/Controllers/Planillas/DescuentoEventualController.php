<?php

namespace App\Http\Controllers\Planillas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionDescuentoEventual;
use App\Models\Planilla\DescuentoEventual;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DescuentoEventualController extends Controller
{
    public function index()
    {
        $query  =   DescuentoEventual::with('Empleado')->join('empleados as e','e.empl_id','=','descuentoeventual.dee_empleado') ->orderBy('dee_id');
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas =  $query->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = $query->whereIn('empl_empresa', $emp)->whereIn('empl_terminal', $ter)->orderBy('empl_id')->where('empl_id', '>', 0)->get();
        }
        return  view('planillas.generacion.eventual.descuentos.index',compact('datas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('planillas.generacion.eventual.descuentos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ValidacionDescuentoEventual $request)
    {
        $data = $request->validated();
        $data['dee_fecha'] = Carbon::createFromFormat('d/m/Y', $data['dee_fecha'])->format('Y-m-d H:i:s');
        $data['dee_saldo_original'] = $data['dee_saldo'];
        DescuentoEventual::create($data);
        return redirect()->route('descuento-eventual')->with('mensaje', 'Descuento ingresado con exito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
