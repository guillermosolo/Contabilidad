<p>Enlace para visualizar Nota de Crédito:
<a target="_blank" href={{$data->ven_enlacefactura}}>Nota de Crédito</a></p>

<p>Código QR para Nota de Crédito:</p>
 
<div class="title m-b-md">
    {!!QrCode::size(300)->generate("$data->ven_enlacefactura") !!}
 </div>





