<?php

use Diglactic\Breadcrumbs\Breadcrumbs;


// Inicio
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Inicio', route('home'));
});

// Inicio > Terminal
Breadcrumbs::for('terminal', function ($trail) {
    $trail->parent('home');
    $trail->push('Terminal', route('terminal'));
});

// Inicio > Terminal > Crear
Breadcrumbs::for('terminal.crear', function ($trail) {
    $trail->parent('terminal');
    $trail->push('Crear Terminal', route('terminal.crear'));
});

// Inicio > Terminal > Editar:[terminal]
Breadcrumbs::for('terminal.editar', function ($trail, $data) {
    $trail->parent('terminal');
    $trail->push('Editar: '.$data->ter_nombre, route('terminal.editar', $data->ter_id));
});

// Inicio > Moneda
Breadcrumbs::for('moneda', function ($trail) {
    $trail->parent('home');
    $trail->push('Moneda', route('moneda'));
});

// Inicio > Moneda > Crear
Breadcrumbs::for('moneda.crear', function ($trail) {
    $trail->parent('moneda');
    $trail->push('Crear Moneda', route('moneda.crear'));
});

// Inicio > Moneda > Editar:[moneda]
Breadcrumbs::for('moneda.editar', function ($trail, $data) {
    $trail->parent('moneda');
    $trail->push('Editar: '.$data->mon_nombre, route('moneda.editar', $data->mon_id));
});

// Inicio > Régimen
Breadcrumbs::for('regimen', function ($trail) {
    $trail->parent('home');
    $trail->push('Régimen', route('regimen'));
});

// Inicio > Régimen > Crear
Breadcrumbs::for('regimen.crear', function ($trail) {
    $trail->parent('regimen');
    $trail->push('Crear Régimen', route('regimen.crear'));
});

// Inicio > Régimen > Editar:[regimen]
Breadcrumbs::for('regimen.editar', function ($trail, $data) {
    $trail->parent('regimen');
    $trail->push('Editar: '.$data->reg_descripcion, route('regimen.editar', $data->reg_id));
});

//Inicio > TiposRepresentante
Breadcrumbs::for('tiposrepresentante', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipo de Representante', route('tiposrepresentante'));
});

// Inicio > TiposRepresentante > Crear
Breadcrumbs::for('tiposrepresentante.crear', function ($trail) {
    $trail->parent('tiposrepresentante');
    $trail->push('Crear Tipo de Representante', route('tiposrepresentante.crear'));
});

// Inicio > TiposRepresentante > Editar:[tipoRepresentante]
Breadcrumbs::for('tiposrepresentante.editar', function ($trail, $data) {
    $trail->parent('tiposrepresentante');
    $trail->push('Editar: '.$data->trep_nombre, route('tiposrepresentante.editar', $data->trep_id));
});

// Inicio > Certificador
Breadcrumbs::for('certificador', function ($trail) {
    $trail->parent('home');
    $trail->push('Certificador', route('certificador'));
});

// Inicio > Certificador > Crear
Breadcrumbs::for('certificador.crear', function ($trail) {
    $trail->parent('certificador');
    $trail->push('Crear Certificador', route('certificador.crear'));
});

// Inicio > Certificador > Editar:[certificador]
Breadcrumbs::for('certificador.editar', function ($trail, $data) {
    $trail->parent('certificador');
    $trail->push('Editar: '.$data->cer_nombre, route('certificador.editar', $data->cer_id));
});

//Inicio > Bancos
Breadcrumbs::for('bancos', function ($trail) {
    $trail->parent('home');
    $trail->push('Banco', route('bancos'));
});

// Inicio > Bancos > Crear
Breadcrumbs::for('bancos.crear', function ($trail) {
    $trail->parent('bancos');
    $trail->push('Crear Banco', route('bancos.crear'));
});

// Inicio > Bancos > Editar
Breadcrumbs::for('bancos.editar', function ($trail, $data) {
    $trail->parent('bancos');
    $trail->push('Editar: '.$data->ban_nombre, route('bancos.editar', $data->ban_id));
});


//Inicio > TipoCombustible
Breadcrumbs::for('tipocombustible', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipo de Combustible', route('tipocombustible'));
});

// Inicio > TipoCombustible > Crear
Breadcrumbs::for('tipocombustible.crear', function ($trail) {
    $trail->parent('tipocombustible');
    $trail->push('Crear Tipo de Combustible', route('tipocombustible.crear'));
});

// Inicio > TipoCombustible > Editar
Breadcrumbs::for('tipocombustible.editar', function ($trail, $data) {
    $trail->parent('tipocombustible');
    $trail->push('Editar: '.$data->tco_nombre, route('tipocombustible.editar', $data->tco_id));
});

//Inicio > Representante
Breadcrumbs::for('representante', function ($trail) {
    $trail->parent('home');
    $trail->push('Representante', route('representante'));
});

// Inicio > representante > Crear
Breadcrumbs::for('representante.crear', function ($trail) {
    $trail->parent('representante');
    $trail->push('Crear Representante', route('representante.crear'));
});

// Inicio > representante > Editar
Breadcrumbs::for('representante.editar', function ($trail, $data) {
    $trail->parent('representante');
    $trail->push('Editar: '.$data->repr_nombre, route('representante.editar', $data->repr_id));
});


//Inicio > TipoPersona
Breadcrumbs::for('tipopersona', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipo de Cliente/Proveedor', route('tipopersona'));
});

// Inicio > TipoPersona > Crear
Breadcrumbs::for('tipopersona.crear', function ($trail) {
    $trail->parent('tipopersona');
    $trail->push('Crear Tipo de Cliente/Proveedor', route('tipopersona.crear'));
});

// Inicio > TipoPersona > Editar
Breadcrumbs::for('tipopersona.editar', function ($trail, $data) {
    $trail->parent('tipopersona');
    $trail->push('Editar: '.$data->tpp_nombre, route('tipopersona.editar', $data->tpp_id));
});

//Inicio > Frirmante
Breadcrumbs::for('firmante', function ($trail) {
    $trail->parent('home');
    $trail->push('Firmante', route('firmante'));
});

// Inicio > Firmante > Crear
Breadcrumbs::for('firmante.crear', function ($trail) {
    $trail->parent('firmante');
    $trail->push('Crear Firmante', route('firmante.crear'));
});

// Inicio > Firmante > Editar
Breadcrumbs::for('firmante.editar', function ($trail, $data) {
    $trail->parent('firmante');
    $trail->push('Editar: '.$data->fir_nombre, route('firmante.editar', $data->fir_id));
});

//Inicio > TipoContribuyente
Breadcrumbs::for('tipocontribuyente', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipo de Contribuyente', route('tipocontribuyente'));
});

// Inicio > TipoContribuyente > Crear
Breadcrumbs::for('tipocontribuyente.crear', function ($trail) {
    $trail->parent('tipocontribuyente');
    $trail->push('Crear Tipo de Contribuyente', route('tipocontribuyente.crear'));
});

// Inicio > TipoContribuyente > Editar
Breadcrumbs::for('tipocontribuyente.editar', function ($trail, $data) {
    $trail->parent('tipocontribuyente');
    $trail->push('Editar: '.$data->tpc_nombre, route('tipocontribuyente.editar', $data->tpc_id));
});

//Inicio > MovimientoBancario
Breadcrumbs::for('movimientobancario', function ($trail) {
    $trail->parent('home');
    $trail->push('Movimiento', route('movimientobancario'));
});

// Inicio > MovimientoBancario > Crear
Breadcrumbs::for('movimientobancario.crear', function ($trail) {
    $trail->parent('movimientobancario');
    $trail->push('Crear Movimiento', route('movimientobancario.crear'));
});

// Inicio > MovimientoBancario > Editar
Breadcrumbs::for('movimientobancario.editar', function ($trail, $data) {
    $trail->parent('movimientobancario');
    $trail->push('Editar: '.$data->movb_descripcion, route('movimientobancario.editar', $data->movb_id));
});
// Inicio >Concilacion Bancaria
Breadcrumbs::for('conciliaciones', function ($trail) {
    $trail->parent('home');
    $trail->push('Concilaciones Bancarias',route('conciliaciones'));
});
// Inicio >Concilacion Bancaria >Crear
Breadcrumbs::for('conciliaciones.crear', function ($trail) {
    $trail->parent('conciliaciones');
    $trail->push('Crear Concilaciones Bancarias',route('conciliaciones.crear'));
});
//Inicio > TipoPago
Breadcrumbs::for('tipopago', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipo de Pago', route('tipopago'));
});

// Inicio > TipoPago > Crear
Breadcrumbs::for('tipopago.crear', function ($trail) {
    $trail->parent('tipopago');
    $trail->push('Crear Tipo de Pago', route('tipopago.crear'));
});

// Inicio > TipoPago > Editar
Breadcrumbs::for('tipopago.editar', function ($trail, $data) {
    $trail->parent('tipopago');
    $trail->push('Editar: '.$data->tip_nombre, route('tipopago.editar', $data->tip_id));
});

//Inicio > TipoCompra
Breadcrumbs::for('tipocompra', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipo de Compra', route('tipocompra'));
});

// Inicio > TipoCompra > Crear
Breadcrumbs::for('tipocompra.crear', function ($trail) {
    $trail->parent('tipocompra');
    $trail->push('Crear Tipo de Compra', route('tipocompra.crear'));
});

// Inicio > TipoCompra > Editar
Breadcrumbs::for('tipocompra.editar', function ($trail, $data) {
    $trail->parent('tipocompra');
    $trail->push('Editar: '.$data->tipc_descripcion, route('tipocompra.editar', $data->tipc_id));
});

//Inicio > Categoria
Breadcrumbs::for('categoria', function ($trail) {
    $trail->parent('home');
    $trail->push('Categoría', route('categoria'));
});

// Inicio > Categoria > Crear
Breadcrumbs::for('categoria.crear', function ($trail) {
    $trail->parent('categoria');
    $trail->push('Crear Categoría', route('categoria.crear'));
});

// Inicio > Categoria > Editar
Breadcrumbs::for('categoria.editar', function ($trail, $data) {
    $trail->parent('categoria');
    $trail->push('Editar: '.$data->cat_descripcion, route('categoria.editar', $data->cat_id));
});

//Inicio > StatusActivos
Breadcrumbs::for('statusactivos', function ($trail) {
    $trail->parent('home');
    $trail->push('Status de Activo', route('statusactivos'));
});

// Inicio > StatusActivos > Crear
Breadcrumbs::for('statusactivos.crear', function ($trail) {
    $trail->parent('statusactivos');
    $trail->push('Crear Status de Activo', route('statusactivos.crear'));
});

// Inicio > StatusAcitivos > Editar
Breadcrumbs::for('statusactivos.editar', function ($trail, $data) {
    $trail->parent('statusactivos');
    $trail->push('Editar: '.$data->sta_descripcion, route('statusactivos.editar', $data->sta_id));
});

//Inicio > Propiedad
Breadcrumbs::for('propiedad', function ($trail) {
    $trail->parent('home');
    $trail->push('Propiedad', route('propiedad'));
});

// Inicio > Propiedad > Crear
Breadcrumbs::for('propiedad.crear', function ($trail) {
    $trail->parent('propiedad');
    $trail->push('Crear Propiedad', route('propiedad.crear'));
});

// Inicio > Propiedad > Editar
Breadcrumbs::for('propiedad.editar', function ($trail, $data) {
    $trail->parent('propiedad');
    $trail->push('Editar: '.$data->prop_nombre, route('propiedad.editar', $data->prop_id));
});

//Inicio > Paises
Breadcrumbs::for('paises', function ($trail) {
    $trail->parent('home');
    $trail->push('País', route('paises'));
});

// Inicio > Paises > Crear
Breadcrumbs::for('paises.crear', function ($trail) {
    $trail->parent('paises');
    $trail->push('Crear País', route('paises.crear'));
});

// Inicio > Paises > Editar
Breadcrumbs::for('paises.editar', function ($trail, $data) {
    $trail->parent('paises');
    $trail->push('Editar: '.$data->pai_descripcion, route('paises.editar', $data->pai_id));
});

//Inicio > Pueblo
Breadcrumbs::for('pueblo', function ($trail) {
    $trail->parent('home');
    $trail->push('Pueblo', route('pueblo'));
});

// Inicio > Pueblo > Crear
Breadcrumbs::for('pueblo.crear', function ($trail) {
    $trail->parent('pueblo');
    $trail->push('Crear Pueblo', route('pueblo.crear'));
});

// Inicio > Pueblo > Editar
Breadcrumbs::for('pueblo.editar', function ($trail, $data) {
    $trail->parent('pueblo');
    $trail->push('Editar: '.$data->pue_descripcion, route('pueblo.editar', $data->pue_id));
});

//Inicio > Académico
Breadcrumbs::for('academico', function ($trail) {
    $trail->parent('home');
    $trail->push('Nivel Académico', route('academico'));
});

// Inicio > Académico > Crear
Breadcrumbs::for('academico.crear', function ($trail) {
    $trail->parent('academico');
    $trail->push('Crear Nivel Académico', route('academico.crear'));
});

// Inicio > Académico > Editar
Breadcrumbs::for('academico.editar', function ($trail, $data) {
    $trail->parent('academico');
    $trail->push('Editar: '.$data->aca_descripcion, route('academico.editar', $data->aca_id));
});

//Inicio > Idioma
Breadcrumbs::for('idioma', function ($trail) {
    $trail->parent('home');
    $trail->push('Idioma', route('idioma'));
});

// Inicio > Idioma > Crear
Breadcrumbs::for('idioma.crear', function ($trail) {
    $trail->parent('idioma');
    $trail->push('Crear Idioma', route('idioma.crear'));
});

// Inicio > Idioma > Editar
Breadcrumbs::for('idioma.editar', function ($trail, $data) {
    $trail->parent('idioma');
    $trail->push('Editar: '.$data->idi_descripcion, route('idioma.editar', $data->idi_id));
});

//Inicio > Discapacidad
Breadcrumbs::for('discapacidad', function ($trail) {
    $trail->parent('home');
    $trail->push('Discapacidad', route('discapacidad'));
});

// Inicio > Discapacidad > Crear
Breadcrumbs::for('discapacidad.crear', function ($trail) {
    $trail->parent('discapacidad');
    $trail->push('Crear Discapacidad', route('discapacidad.crear'));
});

// Inicio > Discapacidad > Editar
Breadcrumbs::for('discapacidad.editar', function ($trail, $data) {
    $trail->parent('discapacidad');
    $trail->push('Editar: '.$data->dis_descripcion, route('discapacidad.editar', $data->dis_id));
});

//Inicio > Empresa
Breadcrumbs::for('empresa', function ($trail) {
    $trail->parent('home');
    $trail->push('Empresa', route('empresa'));
});

// Inicio > Empresa > Crear
Breadcrumbs::for('empresa.crear', function ($trail) {
    $trail->parent('empresa');
    $trail->push('Crear Empresa', route('empresa.crear'));
});

// Inicio > Empresa > Editar
Breadcrumbs::for('empresa.editar', function ($trail, $data) {
    $trail->parent('empresa');
    $trail->push('Editar: '.$data->emp_nombre, route('empresa.editar', $data->emp_id));
});

// Inicio > Empresa > Mostrar
Breadcrumbs::for('empresa.mostrar', function ($trail, $data) {
    $trail->parent('empresa');
    $trail->push('Ver: '.$data->emp_siglas, route('empresa.mostrar', $data->emp_id));
});

// Inicio > Empresa > Terminal
Breadcrumbs::for('empresa.terminal', function ($trail,$data) {
    $trail->parent('empresa');
    $trail->push('Asignar Terminales', route('empresa.terminal',$data->emp_id));
});

// Inicio > Empresa > Representante
Breadcrumbs::for('empresa.representante', function ($trail,$data) {
    $trail->parent('empresa');
    $trail->push('Representantes', route('empresa.representante',$data));
});

//Inicio > Empresa > Representante > Crear
Breadcrumbs::for('empresa.representante.crear', function ($trail,$data) {
    $trail->parent('empresa.representante',$data->emp_id);
    $trail->push('Crear Representantes y Contadores', route('empresa.representante.crear',$data->emp_id));
});

//Inicio > Empresa > Representante > Editar
Breadcrumbs::for('empresa.representante.editar', function ($trail,$data,$tip) {
    $trail->parent('empresa.representante',$data->rep_empresa);
    $trail->push('Editar: '.$tip->trep_nombre, route('empresa.representante.editar',[$data->rep_empresa,$data->rep_representante,$data->rep_tipo,$data->rep_inicio]));
});

//Inicio > Usuario
Breadcrumbs::for('usuario', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuario', route('usuario'));
});
// Inicio > Usuario > Crear
Breadcrumbs::for('usuario.crear', function ($trail) {
    $trail->parent('usuario');
    $trail->push('Crear Usuario', route('usuario.crear'));
});
// Inicio > Usuario > Editar
Breadcrumbs::for('usuario.editar', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Editar: '.$data->usu_nombre, route('usuario.editar', $data->id));
});

// Inicio > Usuario > Mostrar
Breadcrumbs::for('usuario.mostrar', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Ver: '.$data->usu_nombre, route('usuario.mostrar', $data->id));
});

//Inicio >Usuario >Editar >Contraseña
Breadcrumbs::for('usuario.editarC', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Editar contraseña del Usuario: '.$data->usu_nombre, route('usuario.editarC', $data->id));
});

//Inicio > Usuario > Roles
Breadcrumbs::for('usuario.roles', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Asignar roles al Usuario: '.$data->usu_nombre, route('usuario.roles', $data->id));
});

// Inicio > Usuario > Permisos
Breadcrumbs::for('usuario.asignarPermisos', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Asignar Permisos: '.$data->usu_nombre, route('usuario.permisos', $data->id));
});

// Inicio > Usuario > Terminal
Breadcrumbs::for('usuario.terminal', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Asignar Terminal: '.$data->usu_nombre, route('usuario.terminales', $data->id));
});

// Inicio > Usuario > Empresa
Breadcrumbs::for('usuario.empresa', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Asignar Empresa: '.$data->usu_nombre, route('usuario.empresas', $data->id));
});


//Inicio > Rol
Breadcrumbs::for('rol', function ($trail) {
    $trail->parent('home');
    $trail->push('Rol', route('rol'));
});
// Inicio > Rol > Crear
Breadcrumbs::for('rol.crear', function ($trail) {
    $trail->parent('rol');
    $trail->push('Crear Rol', route('rol.crear'));
});

// Inicio > Rol > Permisos
Breadcrumbs::for('rol.asignarPermisos', function ($trail, $data) {
    $trail->parent('rol');
    $trail->push('Asignar Permisos: '.$data->name, route('rol.asignarPermisos', $data->id));
});

//Inicio > OrdenFacturación
Breadcrumbs::for('ordenfacturacion', function ($trail) {
    $trail->parent('home');
    $trail->push('Orden de Facturación', route('ordenfacturacion'));
});

// Inicio > OrdenFacturacion > Crear
Breadcrumbs::for('ordenfacturacion.crear', function ($trail) {
    $trail->parent('ordenfacturacion');
    $trail->push('Crear Orden de Facturación', route('ordenfacturacion.crear'));
});

// Inicio > OrdenFacturacion > Editar
Breadcrumbs::for('ordenfacturacion.editar', function ($trail, $data) {
    $trail->parent('ordenfacturacion');
    $trail->push('Ver: '.$data->ordf_id, route('ordenfacturacion.editar', $data->ordf_id));
});

// Inicio > OrdenFacturacion > Editar
Breadcrumbs::for('ordenfacturacion.editar1', function ($trail, $data) {
    $trail->parent('ordenfacturacion');
    $trail->push('Ver: '.$data->ordf_id, route('ordenfacturacion.editar1', $data->ordf_id));
});

// Inicio > OrdenFacturacion > Mostrar
Breadcrumbs::for('ordenfacturacion.mostrar', function ($trail, $data) {
    $trail->parent('ordenfacturacion');
    $trail->push('Ver: '.$data->ordf_id, route('ordenfacturacion.mostrar', $data->ordf_id));
});

// Inicio > OrdenFacturacion > Crear Factura
/* Breadcrumbs::for('ordenfacturacion.factura.crear', function ($trail, $data) {
  $trail->parent('ordenfacturacion');
$trail->push('Ver: '.$data->ordf_id, route('ordenfacturacion.factura.crear', $data->ordf_id));
});*/



// Inicio > Activos
Breadcrumbs::for('activos', function ($trail) {
    $trail->parent('home');
    $trail->push('Activos', route('activos'));
});

// Inicio > Activos > Crear
Breadcrumbs::for('activos.crear', function ($trail) {
    $trail->parent('activos');
    $trail->push('Crear activo', route('activos.crear'));
});

// Inicio > Activos > Editar
Breadcrumbs::for('activos.editar', function ($trail, $data) {
    $trail->parent('activos');
    $trail->push('Editar: '.$data->act_descripcion, route('activos.editar', $data->act_id));
});

//Inicio > Activos > Propiedades
Breadcrumbs::for('activos.propiedades', function ($trail, $data) {
    $trail->parent('activos');
    $trail->push('Asignar Propiedad: '.$data->act_descripcion, route('activos.propiedades', $data->act_id));
});

// Inicio > Depreciaciones
Breadcrumbs::for('depreciaciones', function ($trail) {
    $trail->parent('home');
    $trail->push('Depreciaciones', route('depreciaciones'));
});

// Inicio > Depreciaciones > Mostrar
Breadcrumbs::for('depreciaciones.mostrar', function ($trail, $data){
    $trail->parent('depreciaciones');
    $trail->push('Mostrar Tabla: '.$data->act_descripcion, route('depreciaciones.mostrar', $data->act_id));
});

// Inicio > Amortizaciones
Breadcrumbs::for('amortizaciones', function ($trail) {
    $trail->parent('home');
    $trail->push('Amortizaciones', route('amortizaciones'));
});

// Inicio > Activos > Crear
Breadcrumbs::for('amortizaciones.crear', function ($trail) {
    $trail->parent('amortizaciones');
    $trail->push('Crear amortizacion', route('amortizaciones.crear'));
});

// Inicio > Amortizaciones > Mostrar
Breadcrumbs::for('amortizaciones.mostrar', function ($trail, $data){
    $trail->parent('amortizaciones');
    $trail->push('Mostrar Tabla: '.$data->cam_descripcion, route('amortizaciones.mostrar', $data->cam_id));
});


//Inicio > Facturación Cxc
Breadcrumbs::for('facturacion', function ($trail) {
    $trail->parent('home');
    $trail->push('Facturación', route('facturacion'));
});

// Inicio > Facturación Cxc > Crear
Breadcrumbs::for('facturacion.crear', function ($trail) {
    $trail->parent('facturacion');
    $trail->push('Crear Factura', route('facturacion.crear'));
});

// Inicio > Facturación cxc > Editar
Breadcrumbs::for('facturacion.editar', function ($trail, $data) {
    $trail->parent('facturacion');
    $trail->push('Editar: '.$data->ven_id, route('facturacion.editar', $data->ven_id));
});

// Inicio > Facturacion Cxc > Mostrar
Breadcrumbs::for('facturacion.mostrar', function ($trail, $data) {
    $trail->parent('facturacion');
    $trail->push('Ver: '.$data->ven_id, route('facturacion.mostrar', $data->ven_id));
});

// Inicio > Facturacion Cxc > PDF
Breadcrumbs::for('facturacion.pdf', function ($trail, $data) {
    $trail->parent('facturacion');
    $trail->push('PDF: '.$data->ven_id, route('facturacion.pdf', $data->ven_id));
});
// Inicio > Facturacion Cxc > Anular
Breadcrumbs::for('facturacion.anulacion', function ($trail, $data) {
    $trail->parent('facturacion');
    $trail->push('Anular: '.$data->ven_id, route('facturacion.anulacion', $data->ven_id));
});


//Inicio > Invoice Cxc
Breadcrumbs::for('invoice', function ($trail) {
    $trail->parent('home');
    $trail->push('Invoice', route('invoice'));
});

// Inicio > Invoice Cxc > Crear
Breadcrumbs::for('invoice.crear', function ($trail) {
    $trail->parent('invoice');
    $trail->push('Crear Invoice', route('invoice.crear'));
});

// Inicio > Invoice cxc > Editar
Breadcrumbs::for('invoice.editar', function ($trail, $data) {
    $trail->parent('invoice');
    $trail->push('Editar: '.$data->ven_id, route('invoice.editar', $data->ven_id));
});

// Inicio > Invoice Cxc > Mostrar
Breadcrumbs::for('invoice.mostrar', function ($trail, $data) {
    $trail->parent('invoice');
    $trail->push('Ver: '.$data->ven_id, route('invoice.mostrar', $data->ven_id));
});

// Inicio > InvoiceCxc > PDF
Breadcrumbs::for('invoice.pdf', function ($trail, $data) {
    $trail->parent('invoice');
    $trail->push('PDF: '.$data->ven_id, route('invoice.pdf', $data->ven_id));
});


// Inicio > Productos
Breadcrumbs::for('productos', function ($trail) {
    $trail->parent('home');
    $trail->push('Productos', route('productos'));
});

// Inicio > Productos > Crear
Breadcrumbs::for('productos.crear', function ($trail) {
    $trail->parent('productos');
    $trail->push('Crear productos', route('productos.crear'));
});

// Inicio > Productos > Editar
Breadcrumbs::for('productos.editar', function ($trail, $data) {
    $trail->parent('productos');
    $trail->push('Editar: '.$data->prod_desc_lg, route('productos.editar', $data->prod_id));
});

//Inicio > Proveedores
Breadcrumbs::for('proveedores', function ($trail) {
    $trail->parent('home');
    $trail->push('Proveedores', route('proveedores'));
});

//Inicio > Proveedores > Crear
Breadcrumbs::for('proveedores.crear', function ($trail) {
    $trail->parent('proveedores');
    $trail->push('Crear proveedor', route('proveedores.crear','0'));
});
// Inicio > Proveedores > Editar
Breadcrumbs::for('proveedores.editar', function ($trail, $data) {
    $trail->parent('proveedores');
    $trail->push('Editar: '.$data->Persona->per_nit, route('productos.editar', $data->pro_id));
});

//Inicio > Facturas
Breadcrumbs::for('facturas', function ($trail) {
    $trail->parent('home');
    $trail->push('Compras y Servicios', route('facturas'));
});

//Inicio > Facturas > Crear
Breadcrumbs::for('facturas.crear', function ($trail) {
    $trail->parent('facturas');
    $trail->push('Crear factura de Compras y Servicios', route('facturas.crear'));
});

// Inicio > Facturas > Mostrar
Breadcrumbs::for('facturas.mostrar', function ($trail, $data) {
    $trail->parent('facturas');
    $trail->push('Mostrar: '.$data->com_numDoc, route('facturas.mostrar', $data->com_id));
});

//Inicio > importacion
Breadcrumbs::for('importacion', function ($trail) {
    $trail->parent('home');
    $trail->push('Pólizas de Importación', route('importacion'));
});

//Inicio > importacion > Crear
Breadcrumbs::for('importacion.crear', function ($trail) {
    $trail->parent('importacion');
    $trail->push('Crear póliza de importación', route('importacion.crear'));
});

// Inicio > importacion > Mostrar
Breadcrumbs::for('importacion.mostrar', function ($trail, $data) {
    $trail->parent('importacion');
    $trail->push('Mostrar: '.$data->poim_dua, route('importacion.mostrar', $data->poim_id));
});

//Inicio > recibos
Breadcrumbs::for('recibos', function ($trail) {
    $trail->parent('home');
    $trail->push('Recibos', route('recibos'));
});

//Inicio > recibos > Crear
Breadcrumbs::for('recibos.crear', function ($trail) {
    $trail->parent('recibos');
    $trail->push('Crear Recibo', route('recibos.crear'));
});

// Inicio > recibos > Mostrar
Breadcrumbs::for('recibos.mostrar', function ($trail, $data) {
    $trail->parent('recibos');
    $trail->push('Mostrar: '.$data->rec_numDoc, route('recibos.mostrar', $data->rec_id));
});

//Inicio > Reportes(cxp) > recibidos
Breadcrumbs::for('reportescxp.docrecibidos', function ($trail) {
    $trail->parent('home');
    $trail->push('Documentos recibidos', route('cxp.reportes.recibidos'));
});

//Inicio > clientes
Breadcrumbs::for('clientes', function ($trail) {
    $trail->parent('home');
    $trail->push('Clientes', route('clientes'));
});

//Inicio > Clientes > Crear
Breadcrumbs::for('clientes.crear', function ($trail) {
    $trail->parent('clientes');
    $trail->push('Crear Cliente', route('clientes.crear','0'));
});
// Inicio > Clientes > Editar
Breadcrumbs::for('clientes.editar', function ($trail, $data) {
    $trail->parent('clientes');
    $trail->push('Editar: '.$data->Persona->per_nit, route('clientes.editar', $data->cli_id));
});




//Inicio > Cobros
Breadcrumbs::for('cobros', function ($trail) {
    $trail->parent('home');
    $trail->push('Cobros', route('cobros'));
});

// Inicio > Cobros > Crear
Breadcrumbs::for('cobros.crear', function ($trail) {
    $trail->parent('cobros');
    $trail->push('Crear Cobro', route('cobro.crear'));
});

//Inicio > Nota de abono
Breadcrumbs::for('nabono', function ($trail) {
    $trail->parent('home');
    $trail->push('Notas de Abono', route('nabono'));
});

// Inicio > Nota de abono > Crear
Breadcrumbs::for('nabono.crear', function ($trail) {
    $trail->parent('nabono');
    $trail->push('Crear Nota de Abono', route('nabono.crear'));
});

// Inicio > Nota de abono > Editar
Breadcrumbs::for('nabono.editar', function ($trail, $data) {
    $trail->parent('nabono');
    $trail->push('Editar: '.$data->ven_id, route('nabono.editar', $data->ven_id));
});

// Inicio > Nota de Abono > Mostrar
Breadcrumbs::for('nabono.mostrar', function ($trail, $data) {
    $trail->parent('nabono');
    $trail->push('Mostrar: '.$data->ven_id, route('nabono.mostrar', $data->ven_id));
});


//Inicio > Nota de crédito
Breadcrumbs::for('ncredito', function ($trail) {
    $trail->parent('home');
    $trail->push('ncredito', route('ncredito'));
});

// Inicio > Nota de Crédito > Crear
Breadcrumbs::for('ncredito.crear', function ($trail) {
    $trail->parent('ncredito');
    $trail->push('Crear Nota de Crédito', route('ncredito.crear'));
});

// Inicio > Nota de Crédito > Editar
Breadcrumbs::for('ncredito.editar', function ($trail, $data) {
    $trail->parent('ncredito');
    $trail->push('Editar: '.$data->ven_id, route('ncredito.editar', $data->ven_id));
});

// Inicio > Nota de Credito > Mostrar
Breadcrumbs::for('ncredito.mostrar', function ($trail, $data) {
    $trail->parent('ncredito');
    $trail->push('Mostrar: '.$data->ven_id, route('ncredito.mostrar', $data->ven_id));
});

//Inicio > Nota de débito
Breadcrumbs::for('ndebito', function ($trail) {
    $trail->parent('home');
    $trail->push('ndebito', route('ndebito'));
});

// Inicio > Nota de débito > Crear
Breadcrumbs::for('ndebito.crear', function ($trail) {
    $trail->parent('ndebito');
    $trail->push('Crear Nota de Débito', route('ndebito.crear'));
});

// Inicio > Nota de debito > Editar
Breadcrumbs::for('ndebito.editar', function ($trail, $data) {
    $trail->parent('ndebito');
    $trail->push('Editar: '.$data->ven_id, route('ndebito.editar', $data->ven_id));
});

// Inicio > Nota de debito > Mostrar
Breadcrumbs::for('ndebito.mostrar', function ($trail, $data) {
    $trail->parent('ndebito');
    $trail->push('Mostrar: '.$data->ven_id, route('ndebito.mostrar', $data->ven_id));
});
//Inicio > Empleados
Breadcrumbs::for('empleados', function ($trail) {
    $trail->parent('home');
    $trail->push('Empleados', route('empleados'));
 });
//Inicio > Empleados > Crear
Breadcrumbs::for('empleados.crear', function ($trail) {
    $trail->parent('empleados');
    $trail->push('Crear Empleado', route('empleados.crear','0'));
});
// Inicio > Empleados > Editar
Breadcrumbs::for('empleados.editar', function ($trail ,$data) {
    $trail->parent('empleados');
    $trail->push('Editar Empleado: '.$data->empl_id, route('empleados.editar',$data->empl_id));
});
// Inicio > PLanillas  Eventual
Breadcrumbs::for('planillas-eventual', function ($trail) {
    $trail->parent('home');
    $trail->push('Planilla Eventual', route('planillas-eventual'));
});
// Inicio > PLanillas Eventual > Generar
Breadcrumbs::for('planillas-eventual.crear', function ($trail) {
    $trail->parent('planillas-eventual');
    $trail->push('Generar Planilla Eventual', route('planillas-eventual.crear'));
});
// Inicio > PLanillas Mensual > Detalle
Breadcrumbs::for('planillas-eventual.ver', function ($trail,$data) {
    $trail->parent('planillas-eventual');
    $trail->push('Detalle Planilla: '.$data, route('planillas-eventual.show',$data));
});
// Inicio > PLanillas Eventual > Descuentos
Breadcrumbs::for('descuento-eventual', function ($trail) {
    $trail->parent('planillas-eventual');
    $trail->push('Descuentos', route('descuento-eventual'));
});
// Inicio > PLanillas Eventual > Descuentos >Crear
Breadcrumbs::for('descuento-eventual.crear', function ($trail) {
    $trail->parent('descuento-eventual');
    $trail->push('Crear Descuento', route('descuento-eventual.crear'));
});
// Inicio > PLanillas  Mensual
Breadcrumbs::for('planillas-mensual', function ($trail) {
    $trail->parent('home');
    $trail->push('Planilla Mensual', route('planillas-mensual'));
});
// Inicio > PLanillas Mensual > Generar
Breadcrumbs::for('planillas-mensual.crear', function ($trail) {
    $trail->parent('planillas-mensual');
    $trail->push('Generar Planilla Mensual', route('planillas-mensual.crear'));
});
// Inicio > PLanillas Mensual > Detalle
Breadcrumbs::for('planillas-mensual.show', function ($trail,$data) {
    $trail->parent('planillas-mensual');
    $trail->push('Detalle Planilla: '.$data, route('planillas-mensual.show',$data));
});
// Inicio > PLanillas  Especial
Breadcrumbs::for('planillas-especial', function ($trail) {
    $trail->parent('home');
    $trail->push('Planilla Especial', route('planillas-especial'));
});
// Inicio > PLanillas  Especial > Crear
Breadcrumbs::for('planillas-especial.crear', function ($trail) {
    $trail->parent('planillas-especial');
    $trail->push('Crear Planilla Especial', route('planillas-especial.crear'));
});
// Inicio > PLanillas  Especial > Ver
Breadcrumbs::for('planillas-especial.ver', function ($trail,$data) {
    $trail->parent('planillas-especial');
    $trail->push('Detalle Planilla: '.$data, route('planillas-especial.ver',$data));
});
// Inicio  > Planilla Eventual > Control de Seguridad
Breadcrumbs::for('control-seguridad', function ($trail) {
    $trail->parent('planillas-eventual');
    $trail->push('Control de Seguridad', route('control-seguridad'));
});
// Inicio  > Planilla Eventual > Control de Seguridad >Crear
Breadcrumbs::for('control-seguridad.crear', function ($trail) {
    $trail->parent('control-seguridad');
    $trail->push('Crear', route('control-seguridad.crear'));
});
// Inicio  > Planilla Eventual > Reporte Turnos
Breadcrumbs::for('reporte-turnos', function ($trail) {
    $trail->parent('planillas-eventual');
    $trail->push('Reporte Turnos', route('reporte-turnos'));
});
// Inicio  > Planilla Eventual >Reporte Turnos > Crear
Breadcrumbs::for('reporte-turnos.crear', function ($trail) {
    $trail->parent('reporte-turnos');
    $trail->push('Crear', route('reporte-turnos.crear'));
});
// Inicio  > Planilla Eventual >Reporte Turnos > Ver
Breadcrumbs::for('reporte-turnos.ver', function ($trail,$data) {
    $trail->parent('reporte-turnos');
    $trail->push('Ver reporte No.'.$data, route('reporte-turnos.ver',$data));
});
// Inicio  > Planilla Eventual > Reporte Barcos
Breadcrumbs::for('reporte-barcos', function ($trail) {
    $trail->parent('planillas-eventual');
    $trail->push('Reporte Barcos', route('reporte-barcos'));
});
// Inicio  > Planilla Eventual >Reporte Barcos > Crear
Breadcrumbs::for('reporte-barcos.crear', function ($trail) {
    $trail->parent('reporte-barcos');
    $trail->push('Crear', route('reporte-barcos.crear'));
});

// Inicio  > Planilla Mensual >Reporte Ausencia > Ver
Breadcrumbs::for('reporte-ausencia', function ($trail) {
    $trail->parent('planillas-mensual');
    $trail->push('Reportes de Ausencia', route('reporte-ausencia'));
});
// Inicio  > Planilla Mensual >Reporte Ausencia > Crear
Breadcrumbs::for('reporte-ausencia.crear', function ($trail) {
    $trail->parent('reporte-ausencia');
    $trail->push('Crear Reporte Ausencia', route('reporte-ausencia.crear'));
});

// Inicio  > Planilla Mensual >Reporte Reporte de Horas > Ver
Breadcrumbs::for('reporte-horae', function ($trail) {
    $trail->parent('planillas-mensual');
    $trail->push('Reportes de Horas Extras', route('reporte-horae'));
});
// Inicio  > Planilla Mensual >Reporte Reporte de Horas > Crear
Breadcrumbs::for('reporte-horae.crear', function ($trail) {
    $trail->parent('reporte-horae');
    $trail->push('Crear Reporte Hora Extra', route('reporte-horae.crear'));
});

// Inicio  > Desc
Breadcrumbs::for('descuento', function ($trail) {
    $trail->parent('home');
    $trail->push('Descuentos ', route('descuento'));
});
// Inicio  > Bono
Breadcrumbs::for('bonificacion', function ($trail) {
    $trail->parent('home');
    $trail->push('Bonificaciones', route('bonificacion'));
});
// Inicio  > Desc > Crear
Breadcrumbs::for('descuento.crear', function ($trail) {
    $trail->parent('descuento');
    $trail->push('Crear Descuentos', route('descuento.crear'));
});
// Inicio  > Bono > Crear
Breadcrumbs::for('bonificacion.crear', function ($trail) {
    $trail->parent('bonificacion');
    $trail->push('Crear  Bonificaciones', route('bonificacion.crear'));
});
// Inicio > PLanillas >Tipo Desc
Breadcrumbs::for('tipodesc', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipos de Descuentos y Bonificaciones', route('tipodesc'));
});
// Inicio > PLanillas >Tipo Desc> Crear
Breadcrumbs::for('tipodesc.crear', function ($trail) {
    $trail->parent('tipodesc');
    $trail->push('Crear Tipo de Descuentos o Bonificaciones', route('tipodesc.crear'));
});
// Inicio > PLanillas >Tipo Desc> Editar
Breadcrumbs::for('tipodesc.editar', function ($trail,$data) {
    $trail->parent('tipodesc');
    $trail->push('Editar: '.$data->tipd_id, route('tipodesc.editar', $data->tipd_id));
});
// Inicio > PLanillas Eventual > Validacion de Reportes
Breadcrumbs::for('reporte-turnos.validar-crear', function ($trail) {
    $trail->parent('planillas-eventual');
    $trail->push('Validacion de Reporte' ,route('reporte-turnos.validar-crear'));
});
// Inicio > Prestacion Laboral
Breadcrumbs::for('prestacion-laboral', function ($trail) {
    $trail->parent('home');
    $trail->push('Prestacion Laboral', route('prestacion-laboral'));
});
// Inicio > Reporte Estadistico
Breadcrumbs::for('reportes-estadistico', function ($trail) {
    $trail->parent('home');
    $trail->push('Reporte Estadistico', route('reportes-estadistico'));
});
// Inicio > Libro de Salarios
Breadcrumbs::for('libro-salarios', function ($trail) {
    $trail->parent('home');
    $trail->push('Libro de Salarios', route('libro-salarios'));
});


//INICIO >RETENCION
Breadcrumbs::for('retencion', function ($trail) {
    $trail->parent('home');
    $trail->push('retencion', route('retencion'));
});

// Inicio > Retenciones > Crear
Breadcrumbs::for('retencion.crear', function ($trail) {
    $trail->parent('retencion');
    $trail->push('Crear Retención', route('retencion.crear'));
});

// Inicio > Retenciones > Editar
Breadcrumbs::for('retencion.editar', function ($trail, $data) {
    $trail->parent('retencion');
    $trail->push('Editar: '.$data->docv_id, route('retencion.editar', $data->docv_id));
});

// Inicio > Retenciones> Mostrar
Breadcrumbs::for('retencion.mostrar', function ($trail, $data) {
    $trail->parent('retencion');
    $trail->push('Mostrar: '.$data->docv_id, route('retencion.mostrar', $data->docv_id));
});

//INICIO >RETENCION IVA
Breadcrumbs::for('retencionIVA', function ($trail) {
    $trail->parent('home');
    $trail->push('retencionIVA', route('retencionIVA'));
});

// Inicio > RetencionesIVA > Crear
Breadcrumbs::for('retencionIVA.crear', function ($trail) {
    $trail->parent('retencionIVA');
    $trail->push('Crear Retención de IVA', route('retencionIVA.crear'));
});

// Inicio > RetencionesIVA > Editar
Breadcrumbs::for('retencionIVA.editar', function ($trail, $data) {
    $trail->parent('retencionIVA');
    $trail->push('Editar: '.$data->docv_id, route('retencionIVA.editar', $data->docv_id));
});

// Inicio > RetencionesIVA> Mostrar
Breadcrumbs::for('retencionIVA.mostrar', function ($trail, $data) {
    $trail->parent('retencionIVA');
    $trail->push('Mostrar: '.$data->docv_id, route('retencionIVA.mostrar', $data->docv_id));
});

// Inicio > Cuentas Bancarias
Breadcrumbs::for('cuentasbancarias', function ($trail) {
    $trail->parent('home');
    $trail->push('Catalogo de Cuentas', route('cuentasbancarias'));
});
// Inicio > Cuentas Bancarias > Crear Cuentas Bancarias
Breadcrumbs::for('cuentasbancarias.crear', function ($trail) {
    $trail->parent('cuentasbancarias');
    $trail->push('Crear Cuenta Bancaria', route('cuentasbancarias.crear'));
});
// Incio > Cajas Chicas
Breadcrumbs::for('cajachica', function ($trail) {
    $trail->parent('home');
    $trail->push('Cajas Chicas', route('cajachica'));
});
// Incio > Cajas Chicas > Crear Caja Chica
Breadcrumbs::for('cajachica.crear', function ($trail) {
    $trail->parent('cajachica');
    $trail->push('Creacion de Cajas Chicas', route('cajachica.crear'));
});
// Incio > Cajas Chicas > Editar Caja Chica
Breadcrumbs::for('cajachica.editar', function ($trail,$data) {
    $trail->parent('cajachica');
    $trail->push('Editar Caja Chica: '.$data, route('cajachica.editar',$data));
});
// Inicio > Liquidación de Cajas Chicas
Breadcrumbs::for('liquidacion', function ($trail) {
    $trail->parent('home');
    $trail->push('Lista de Liquidaciones', route('liquidacion'));
});
// Inicio > Liquidación de Cajas Chicas > Crear Liquidación
Breadcrumbs::for('liquidacion.crear', function ($trail) {
    $trail->parent('liquidacion');
    $trail->push('Nueva Liquidación', route('liquidacion.crear'));
});
// Inicio > Liquidación de Cajas Chicas > Crear Detalle de Liquidación
Breadcrumbs::for('detalle.crear', function ($trail,$data) {
    $trail->parent('liquidacion');
    $trail->push('Detalle de liquidación', route('detalle.crear',$data));
});
// Inicio > Liquidación de Cajas Chicas > Editar Detalle
Breadcrumbs::for('detalle.lista', function ($trail,$data) {
    $trail->parent('liquidacion');
    $trail->push('Detalle de liquidación: '.$data, route('detalle.crear',$data));
});


// Inicio > Autorizaciones
Breadcrumbs::for('autorizar', function ($trail) {
    $trail->parent('home');
    $trail->push('Autorizaciones', route('autorizar'));
});
// Inicio > Busqueda de Empresa
Breadcrumbs::for('cuentasbancarias.catalogo', function ($trail) {
    $trail->parent('home');
    $trail->push('Seleccionar Empresa', route('cuentasbancarias.catalogo'));
});
// Inicio > Listado de Cuentas Bancarias por Empresa
Breadcrumbs::for('cuentasbancarias.imprimir', function ($trail) {
    $trail->parent('cuentasbancarias.catalogo');
    $trail->push('Imprimir Catalogos', route('cuentasbancarias.imprimir'));
});

Breadcrumbs::for('chequeater', function ($trail) {
    $trail->parent('home');
    $trail->push('Transferencias A terceros', route('chequeater'));
});
// Inicio > A Terceros > Crear A Terceros
Breadcrumbs::for('chequeater.crear', function ($trail) {
    $trail->parent('chequeater');
    $trail->push('Nueva Transferencia A Tercero', route('chequeater.crear'));
});
// Inicio > De Terceros
Breadcrumbs::for('chequedeter', function ($trail) {
    $trail->parent('home');
    $trail->push('Transferencias De terceros', route('chequedeter'));
});
// Inicio > De Terceros > Crear De Terceros
Breadcrumbs::for('chequedeter.crear', function ($trail) {
    $trail->parent('chequedeter');
    $trail->push('Nueva Transferencia De tercero', route('chequedeter.crear'));
});
// Inicio > Anticipos
Breadcrumbs::for('anticipos', function ($trail) {
    $trail->parent('home');
    $trail->push('Anticipos', route('anticipos'));
});
// Inicio > Anticipos > Crear Anticipos
Breadcrumbs::for('anticipos.crear', function ($trail) {
    $trail->parent('anticipos');
    $trail->push('Crear Anticipos', route('anticipos.crear'));
});
// Inicio > Anticipos > Crear Detalle de Anticipo
Breadcrumbs::for('anticipos.detalle', function ($trail, $data) {
    $trail->parent('anticipos');
    $trail->push('Crear Detalle de Anticipos ', route('anticipos.detalle', $data));
});
// Inicio > Anticipos > Ver Detalle
Breadcrumbs::for('anticipos.listadetalles', function ($trail, $data) {
    $trail->parent('anticipos');
    $trail->push('Detalles Anticipo: '.$data, route('anticipos.listadetalles', $data));
});
// Inicio > Anticipos > Liquidar
Breadcrumbs::for('liquidar', function ($trail) {
    $trail->parent('home');
    $trail->push('Liquidar Anticipos', route('liquidar'));
});
// Inicio > Anticipos > Liquidar > Ver detalles de Liquidación
Breadcrumbs::for('liquidar.anticipos', function ($trail, $data) {
    $trail->parent('liquidar');
    $trail->push('Liquidar Anticipos', route('liquidar.anticipos', $data));
});
// Inicio > Transferencias Internas
Breadcrumbs::for('internas', function ($trail) {
    $trail->parent('home');
    $trail->push('Transferencias Internas', route('internas'));
});
// Inicio > Transferencias Internas > Crear Transferencia Interna
Breadcrumbs::for('internas.crear', function ($trail) {
    $trail->parent('internas');
    $trail->push('Nueva Transferencia Interna', route('internas.crear'));
});
// Inicio > Transferencias Relacionadas
Breadcrumbs::for('relacionadas', function ($trail) {
    $trail->parent('home');
    $trail->push('Transferencias Relacionadas', route('relacionadas'));
});
// Inicio > Transferencias Relacionadas > Crear Transferencia Relacionada
Breadcrumbs::for('relacionadas.crear', function ($trail) {
    $trail->parent('relacionadas');
    $trail->push('Nueva Transferencia A Relacionados', route('relacionadas.crear'));
});

// Inicio > Transferencias Relacionadas > Crear Transferencia Relacionada
Breadcrumbs::for('derelacionadas.crear', function ($trail) {
    $trail->parent('relacionadas');
    $trail->push('Nueva Transferencia De Relacionados', route('derelacionadas.crear'));
});
// Inicio > Debitos
Breadcrumbs::for('debito', function ($trail) {
    $trail->parent('home');
    $trail->push('Débitos', route('debito'));
});
// Inicio > Debitos > Crear Nuevo Debito
Breadcrumbs::for('debito.crear', function ($trail) {
    $trail->parent('debito');
    $trail->push('Generar un nuevo Débito', route('debito.crear'));
});
// Inicio > Debitos
Breadcrumbs::for('credito', function ($trail) {
    $trail->parent('home');
    $trail->push('Créditos', route('credito'));
});
// Inicio > Debitos > Crear Nuevo Credito
Breadcrumbs::for('credito.crear', function ($trail) {
    $trail->parent('credito');
    $trail->push('Generar un nuevo Crédito', route('credito.crear'));
});


//Inicio > Poliza
Breadcrumbs::for('poliza', function ($trail) {
    $trail->parent('home');
    $trail->push('poliza', route('poliza'));
});

// Inicio > Poliza > Crear
Breadcrumbs::for('poliza.crear', function ($trail) {
    $trail->parent('poliza');
    $trail->push('Crear Poliza', route('poliza.crear'));
});

// Inicio > Poliza > Editar
Breadcrumbs::for('poliza.editar', function ($trail, $data) {
    $trail->parent('poliza');
    $trail->push('Editar: '.$data->pol_id, route('poliza.editar', $data->pol_id));
});

// Inicio > Nota de debito > Mostrar
Breadcrumbs::for('poliza.mostrar', function ($trail, $data) {
    $trail->parent('poliza');
    $trail->push('Mostrar: '.$data->pol_id, route('poliza.mostrar', $data->pol_id));
});







