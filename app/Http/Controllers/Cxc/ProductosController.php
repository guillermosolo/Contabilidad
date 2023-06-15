<?php

namespace App\Http\Controllers\Cxc;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cxc\ValidacionProductos;
use App\Models\Cxc\Productos;
use Illuminate\Http\Request;
use Exception;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Productos::orderBy('prod_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Productos::whereIn('prod_empresa', $emp)->whereIn('prod_terminal', $ter)->orderBy('prod_id')->get();
        }
        return view('cxc.productos.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cxc.productos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionProductos $request)
    {
        //dd($request->all());
     
        $detalle = Productos::create($request->all());

        if ($request->prod_padre1 >= $request->prod_padre ) {
           $detalle->prod_padre = $request->prod_padre1;
        
            } else if ($request->prod_padre1 <= $request->prod_padre) {
            $detalle->prod_padre = $request->prod_padre;
            }
        $detalle->save();

               
  


        return redirect('cxc/productos')->with('mensaje', 'Producto creado exitosamente.');
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
        $data = Productos::findOrFail($id);
        return view('cxc.productos.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionProductos $request, $id)
    {
        Productos::findOrFail($id)->update($request->all());
        return redirect('cxc/productos')->with('mensaje', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Productos::destroy($id);
        } catch (Exception $e) {
            return redirect('cxc/productos')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('cxc/productos')->with('mensaje', 'Producto eliminado correctamente.');
    }






    public function DescripcionProducto(request $request, $emp, $ter)
    {

        if ($request->ajax()) {

                $cta = Productos::where('prod_empresa', $emp)->where('prod_terminal', $ter)->where('prod_codigo', '<>', '')->get();

            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function ProductoAbuelo(request $request, $emp, $ter)
    {

        if ($request->ajax()) {

                $cta = Productos::where('prod_empresa', $emp)->where('prod_terminal', $ter)->where('prod_padre','LIKE','0%')->get();

            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function ProductoPadre(request $request, $prod)
    {

        if ($request->ajax()) {

        $cta = Productos::where('prod_padre', $prod)->orWhere('prod_codigo', [['=', ''], ['=', null]])->get();

        return response()->json($cta);

        } else {
            abort(404);
        }
    }








}
