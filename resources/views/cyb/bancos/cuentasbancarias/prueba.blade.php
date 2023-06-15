<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        td {
            font-size: 75%;
            border: none;
        }

        th {
            background-color: #292428;
            color: white;
            border: none;
            font-size: 0.9rem;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .text-right{
            text-align: right;
        }
    </style>
</head>

<body>
<header>
    @if($empresa == 'Todas las Empresas')
    <h3><center>Cuentas de {{$empresa}}</center></h3>
        @else
        <h3><center>Cuentas de la Empresa {{$empresa}}</center></h3>
        @endif
</header>
<main>
    <table class="table">
        <thead class='thead-dark'>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Número de Cuenta</th>
            <th scope="col">Tipo de Cuenta</th>
            <th scope="col">Banco</th>
            <th scope="col">Moneda</th>
            <th scope="col">Cuenta Contable</th>
            <th scope="col">Nombre de la Empresa</th>
            <th scope="col">Contacto</th>
            <th scope="col">Teléfono</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cuentasbancariass as $cuentasbancarias)
            <tr>
                <td scope="row">{{$cuentasbancarias['ctab_id']}}</td>
                <td>{{$cuentasbancarias['ctab_numero']}}</td>
                <td>{{$cuentasbancarias->Tipo->tcb_descripcion}}</td>
                <td>{{$cuentasbancarias->Banco->ban_siglas}}</td>
                <td>{{$cuentasbancarias->Moneda->mon_nombre}}</td>
                <td>{{$cuentasbancarias->Contable->cta_descripcion}}</td>
                <td>{{$cuentasbancarias->Empresa->emp_siglas}}</td>
                <td>{{$cuentasbancarias['ctab_contacto']}}</td>
                <td>{{$cuentasbancarias['ctab_telefono']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>
<script type="text/php">
        if (isset($pdf)) {
                $x = 700;
                $y = 595;
                $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
                $font = null;
                $size = 10;
                $color = array(0,0,0);
                $word_space = 0.0;  //  default
                $char_space = 0.0;  //  default
                $angle = 0.0;   //  default
                $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
            }
        </script>
</body>

</html>
