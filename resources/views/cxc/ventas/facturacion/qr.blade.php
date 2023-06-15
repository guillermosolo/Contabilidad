



<p>Enlace para visualizar factura:
<a target="_blank" href={{$data->ven_enlacefactura}}>Factura</a></p>

<p>Código QR para descargar Factura:</p>
<div class="title m-b-md">
    {!!QrCode::size(300)->generate("$data->ven_enlacefactura") !!}
 </div>





