<p>Enlace para visualizar Nota de Abono:
<a target="_blank" href={{$data->ven_enlacefactura}}>Nota Abono</a></p>

<p>Código QR para Nota de Abono:</p>
<div class="title m-b-md">
    {!!QrCode::size(300)->generate("$data->ven_enlacefactura") !!}
 </div>





