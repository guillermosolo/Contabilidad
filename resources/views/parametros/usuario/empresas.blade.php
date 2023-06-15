@extends("layout.layout")
@section("titulo")
Usuario
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('usuario.empresa',$data) }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/parametros/usuario/empresa.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/usuario')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Asignar Empresas a <small>{{$data->usu_nombre}}</small></h3>
                        <div class="card-tools">
                            <a href="{{route('usuario')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <input type="hidden" id="usuario" name="usuario" value="{{$data->id}}">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Empresa</th>
                                    <th class="width70 text-center">Asignar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emps as $emp)
                                <tr>
                                    <td>{{$emp->emp_nombre}}</td>
                                    <td align="center">
                                        <div class="icheck-midnightblue d-inline">
                                        <input type="checkbox" class="empresa" id="{{$emp->emp_nombre}}" value="{{$emp->emp_id}}" {{$data->Empresas->contains($emp->emp_id)?"checked":""}}>
                                        <label for="{{$emp->emp_nombre}}">
                                        </label>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
