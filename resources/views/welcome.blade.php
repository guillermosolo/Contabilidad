@extends("layout.layout")

@section('titulo')
Inicio
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('home') }}
@endsection

@section('contenido')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <img src="{{asset("assets/img/construccion.jpg")}}" class="img-fluid float-right">
            </div>
        </div>
    </div>
</section>
@endsection
