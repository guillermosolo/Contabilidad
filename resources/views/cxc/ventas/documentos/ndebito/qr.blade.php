<p>Enlace para visualizar Nota de Débito:
<a target="_blank" href={{$data->ven_enlacefactura}}>Nota Débito</a></p>

<p>Código QR para Nota de Débito:</p>
<div class="title m-b-md">
    {!!QrCode::size(300)->generate("$data->ven_enlacefactura") !!}
 </div>





