<!DOCTYPE html>
<html lang="es">

<header>

    <style>
        * {
            padding: 0;
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }
        .header__div{
            margin-top: 86px;
        }
        .lugar{
            margin-left: 83px;
        }
        .beneficiario{
            margin-left: 94px;
            margin-top: 3px;
        }
        .total{
            margin-left: 60px;
            margin-top: 6px;
        }
        .negociable{
            margin-left: 60px;
            margin-top: 35px;
        }
    </style>
</header>

<body>
<div class="header__div">
    <div class="lugar">
        <table>
            <thead>
            <td style="width:420px">{{$data['lugar']}} {{$data['fecha']}}</td>
            <td style="width:50px"> {{Str::money($data['totalNumeros'],'') }}</td>
            </thead>
        </table>
    </div>
    <div class="beneficiario">
        {{mb_strtoupper($data['beneficiario'], 'utf-8')}}
    </div>
    <div class="total">
        {{$data['totalLetras']}}
    </div>
    <div class="negociable">
    @if($data['negociable']== 0)
        ***NO NEGOCIABLE***
    @else
    @endif
    </div>

</div>
</body>

</html>
