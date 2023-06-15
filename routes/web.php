<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('seguridad/login','Seguridad\LoginController@index')->name('login');
Route::post('seguridad/login','Seguridad\LoginController@login')->name('login_post');
Route::get('seguridad/logout','Seguridad\LoginController@logout')->name('logout');

Route::get('/','HomeController@index')->name('home')->middleware(['auth']);

Route::get('admin/municipios/{depto}','Admin\DepMunController@getMunicipios')->name('municipios')->middleware(['auth']);

Route::get('contabilidad/ctaContable/{emp}/{ter}/{nivel1?}/{detalle}','Contabilidad\CuentaContableController@CuentaActivoGasto')->name('ctaActivoGasto')->middleware('auth');
Route::get('contabilidad/ctaExcenta/{emp}/{ter}','Contabilidad\CuentaContableController@CuentasExcentas')->name('ctaExcenta')->middleware('auth');
Route::get('contabilidad/ctaDepreciacion/{emp}/{ter}/{nivel1}/{detalle}','Contabilidad\CuentaContableController@CuentaDepreciacion')->name('ctaDepreciacion')->middleware('auth');
Route::get('contabilidad/ctaDepAcum/{emp}/{detalle}','Contabilidad\CuentaContableController@CuentaDepAcum')->name('ctaDepAcum')->middleware('auth');
Route::get('contabilidad/ctaAmortizacion/{emp}/{ter}/{detalle}','Contabilidad\CuentaContableController@CuentaAmortizacion')->name('ctaAmortizacion')->middleware('auth');
Route::get('contabilidad/ctaAmortAcum/{emp}/{detalle}','Contabilidad\CuentaContableController@CuentaAmortAcum')->name('ctaAmortAcum')->middleware('auth');

Route::get('contabilidad/ctaCuentaPorNivel/{emp}/{nivel?}/{detalle}','Contabilidad\CuentaContableController@CuentaPorNivel')->name('ctaPlanilla')->middleware('auth');

Route::get('cxc/notas/{emp}/{ter}/{cli}','Cxc\FacturacionController@Notas')->name('factura.notas')->middleware(['auth']);

Route::get('cxc/retencion/{emp}','Cxc\FacturacionController@Retencion')->name('factura.retencion')->middleware(['auth']);

Route::get('productos/descripcion/{emp}/{ter}','Cxc\ProductosController@DescripcionProducto')->name('productosdetalle')->middleware('auth');

Route::get('contabilidad/poliza/{emp}','Contabilidad\CuentaContableController@Poliza')->name('ctaPoliza')->middleware(['auth']);

Route::get('productos/abuelo/{emp}/{ter}','Cxc\ProductosController@ProductoAbuelo')->name('productosabuelo')->middleware('auth');

Route::get('productos/padre/{prod}','Cxc\ProductosController@ProductoPadre')->name('productospadre')->middleware('auth');

Route::get('cliente/documentos/{cli}','Cxc\ClientesController@ClientesDocumentos')->name('clientesdocumento')->middleware('auth');









Route::get('parametros/terminal','Parametros\TerminalController@index')->name('terminal')->middleware(['auth','can:ver parametros/terminal']);
Route::get('parametros/terminal/crear','Parametros\TerminalController@create')->name('terminal.crear')->middleware(['auth','can:crear parametros/terminal']);
Route::post('parametros/terminal','Parametros\TerminalController@store')->name('terminal.guardar')->middleware(['auth','can:crear parametros/terminal']);
Route::get('parametros/terminal/{id}/editar','Parametros\TerminalController@edit')->name('terminal.editar')->middleware(['auth','can:actualizar parametros/terminal']);
Route::put('parametros/terminal/{id}','Parametros\TerminalController@update')->name('terminal.actualizar')->middleware(['auth','can:actualizar parametros/terminal']);
Route::get('parametros/terminal/{id}/eliminar','Parametros\TerminalController@destroy')->name('terminal.eliminar')->middleware(['auth','can:eliminar parametros/terminal']);
Route::post('parametros/terminal/usuario','Parametros\TerminalController@asignaUsuario')->name('terminal.usuario')->middleware(['auth','can:actualizar parametros/usuario']);
Route::get('parametros/terminal/{id}/Auth','Parametros\TerminalController@TerminalesAuth')->name('terminal.terminalesAuth')->middleware(['auth']);
Route::get('parametros/terminal/cuentabancaria/{id}','Parametros\TerminalController@TerminalesCuentaBancariaAuth')->middleware(['auth'])->name('terminal.terminalesCuentasAuth');


Route::get('admin/moneda','Admin\MonedaController@index')->name('moneda')->middleware(['auth','can:ver admin/moneda']);
Route::get('admin/moneda/crear','Admin\MonedaController@create')->name('moneda.crear')->middleware(['auth','can:crear admin/moneda']);
Route::post('admin/moneda','Admin\MonedaController@store')->name('moneda.guardar')->middleware(['auth','can:crear admin/moneda']);
Route::get('admin/moneda/{id}/editar','Admin\MonedaController@edit')->name('moneda.editar')->middleware(['auth','can:actualizar admin/moneda']);
Route::put('admin/moneda/{id}','Admin\MonedaController@update')->name('moneda.actualizar')->middleware(['auth','can:actualizar admin/moneda']);
Route::get('admin/moneda/{id}/eliminar','Admin\MonedaController@destroy')->name('moneda.eliminar')->middleware(['auth','can:eliminar admin/moneda']);

Route::get('admin/regimen','Admin\RegimenController@index')->name('regimen')->middleware(['auth','can:ver admin/regimen']);
Route::get('admin/regimen/crear','Admin\RegimenController@create')->name('regimen.crear')->middleware(['auth','can:crear admin/regimen']);
Route::post('admin/regimen','Admin\RegimenController@store')->name('regimen.guardar')->middleware(['auth','can:crear admin/regimen']);
Route::get('admin/regimen/{id}/editar','Admin\RegimenController@edit')->name('regimen.editar')->middleware(['auth','can:actualizar admin/regimen']);
Route::put('admin/regimen/{id}','Admin\RegimenController@update')->name('regimen.actualizar')->middleware(['auth','can:actualizar admin/regimen']);
Route::get('admin/regimen/{id}/eliminar','Admin\RegimenController@destroy')->name('regimen.eliminar')->middleware(['auth','can:eliminar admin/regimen']);

Route::get('admin/tiposrepresentante','Admin\TiposRepresentanteController@index')->name('tiposrepresentante')->middleware(['auth','can:ver admin/tiposrepresentante']);
Route::get('admin/tiposrepresentante/crear','Admin\TiposRepresentanteController@create')->name('tiposrepresentante.crear')->middleware(['auth','can:crear admin/tiposrepresentante']);
Route::post('admin/tiposrepresentante','Admin\TiposRepresentanteController@store')->name('tiposrepresentante.guardar')->middleware(['auth','can:crear admin/tiposrepresentante']);
Route::get('admin/tiposrepresentante/{id}/editar','Admin\TiposRepresentanteController@edit')->name('tiposrepresentante.editar')->middleware(['auth','can:actualizar admin/tiposrepresentante']);
Route::put('admin/tiposrepresentante/{id}','Admin\TiposRepresentanteController@update')->name('tiposrepresentante.actualizar')->middleware(['auth','can:actualizar admin/tiposrepresentante']);
Route::get('admin/tiposrepresentante/{id}/eliminar','Admin\TiposRepresentanteController@destroy')->name('tiposrepresentante.eliminar')->middleware(['auth','can:eliminar admin/tiposrepresentante']);

Route::get('admin/certificador','Admin\CertificadorController@index')->name('certificador')->middleware(['auth','can:ver admin/certificador']);
Route::get('admin/certificador/crear','Admin\CertificadorController@create')->name('certificador.crear')->middleware(['auth','can:crear admin/certificador']);
Route::post('admin/certificador','Admin\CertificadorController@store')->name('certificador.guardar')->middleware(['auth','can:crear admin/certificador']);
Route::get('admin/certificador/{id}/editar','Admin\CertificadorController@edit')->name('certificador.editar')->middleware(['auth','can:actualizar admin/certificador']);
Route::put('admin/certificador/{id}','Admin\CertificadorController@update')->name('certificador.actualizar')->middleware(['auth','can:actualizar admin/certificador']);
Route::get('admin/certificador/{id}/eliminar','Admin\CertificadorController@destroy')->name('certificador.eliminar')->middleware(['auth','can:eliminar admin/certificador']);

Route::get('admin/bancos','Admin\BancosController@index')->name('bancos')->middleware(['auth','can:ver admin/bancos']);
Route::get('admin/bancos/crear','Admin\BancosController@create')->name('bancos.crear')->middleware(['auth','can:crear admin/bancos']);
Route::post('admin/bancos','Admin\BancosController@store')->name('bancos.guardar')->middleware(['auth','can:crear admin/bancos']);
Route::get('admin/bancos/{id}/editar','Admin\BancosController@edit')->name('bancos.editar')->middleware(['auth','can:actualizar admin/bancos']);
Route::put('admin/bancos/{id}','Admin\BancosController@update')->name('bancos.actualizar')->middleware(['auth','can:actualizar admin/bancos']);
Route::get('admin/bancos/{id}/eliminar','Admin\BancosController@destroy')->name('bancos.eliminar')->middleware(['auth','can:eliminar admin/bancos']);


Route::get('admin/tipocombustible','Admin\TipoCombustibleController@index')->name('tipocombustible')->middleware(['auth','can:ver admin/tipocombustible']);
Route::get('admin/tipocombustible/crear','Admin\TipoCombustibleController@create')->name('tipocombustible.crear')->middleware(['auth','can:crear admin/tipocombustible']);
Route::post('admin/tipocombustible','Admin\TipoCombustibleController@store')->name('tipocombustible.guardar')->middleware(['auth','can:crear admin/tipocombustible']);
Route::get('admin/tipocombustible/{id}/editar','Admin\TipoCombustibleController@edit')->name('tipocombustible.editar')->middleware(['auth','can:actualizar admin/tipocombustible']);
Route::put('admin/tipocombustible/{id}','Admin\TipoCombustibleController@update')->name('tipocombustible.actualizar')->middleware(['auth','can:actualizar admin/tipocombustible']);
Route::get('admin/tipocombustible/{id}/eliminar','Admin\TipoCombustibleController@destroy')->name('tipocombustible.eliminar')->middleware(['auth','can:eliminar admin/tipocombustible']);

Route::get('admin/representante','Admin\RepresentanteController@index')->name('representante')->middleware(['auth','can:ver admin/representante']);
Route::get('admin/representante/crear','Admin\RepresentanteController@create')->name('representante.crear')->middleware(['auth','can:crear admin/representante']);
Route::post('admin/representante','Admin\RepresentanteController@store')->name('representante.guardar')->middleware(['auth','can:crear admin/representante']);
Route::get('admin/representante/{id}/editar','Admin\RepresentanteController@edit')->name('representante.editar')->middleware(['auth','can:actualizar admin/representante']);
Route::put('admin/representante/{id}','Admin\RepresentanteController@update')->name('representante.actualizar')->middleware(['auth'],'can:actualizar admin/representante');
Route::get('admin/representante/{id}/eliminar','Admin\RepresentanteController@destroy')->name('representante.eliminar')->middleware(['auth','can:eliminar admin/representante']);

Route::get('admin/firmante','Admin\FirmanteController@index')->name('firmante')->middleware(['auth','can:ver admin/firmante']);
Route::get('admin/firmante/crear','Admin\FirmanteController@create')->name('firmante.crear')->middleware(['auth','can:crear admin/firmante']);
Route::post('admin/firmante','Admin\FirmanteController@store')->name('firmante.guardar')->middleware(['auth','can:crear admin/firmante']);
Route::get('admin/firmante/{id}/editar','Admin\FirmanteController@edit')->name('firmante.editar')->middleware(['auth','can:actualizar admin/firmante']);
Route::put('admin/firmante/{id}','Admin\FirmanteController@update')->name('firmante.actualizar')->middleware(['auth','can:actualizar admin/firmante']);
Route::get('admin/firmante/{id}/eliminar','Admin\FirmanteController@destroy')->name('firmante.eliminar')->middleware(['auth','can:eliminar admin/firmante']);

Route::get('admin/tipopersona','Admin\TipoPersonaController@index')->name('tipopersona')->middleware(['auth','can:ver admin/tipopersona']);
Route::get('admin/tipopersona/crear','Admin\TipoPersonaController@create')->name('tipopersona.crear')->middleware(['auth','can:crear admin/tipopersona']);
Route::post('admin/tipopersona','Admin\TipoPersonaController@store')->name('tipopersona.guardar')->middleware(['auth','can:crear admin/tipopersona']);
Route::get('admin/tipopersona/{id}/editar','Admin\TipoPersonaController@edit')->name('tipopersona.editar')->middleware(['auth','can:actualizar admin/tipopersona']);
Route::put('admin/tipopersona/{id}','Admin\TipoPersonaController@update')->name('tipopersona.actualizar')->middleware(['auth','can:actualizar admin/tipopersona']);
Route::get('admin/tipopersona/{id}-{tipo}/eliminar','Admin\TipoPersonaController@destroy')->name('tipopersona.eliminar')->middleware(['auth','can:eliminar admin/tipopersona']);

Route::get('admin/tipocontribuyente','Admin\TipoContribuyenteController@index')->name('tipocontribuyente')->middleware(['auth','can:ver admin/tipocontribuyente']);
Route::get('admin/tipocontribuyente/crear','Admin\TipoContribuyenteController@create')->name('tipocontribuyente.crear')->middleware(['auth','can:crear admin/tipocontribuyente']);
Route::post('admin/tipocontribuyente','Admin\TipoContribuyenteController@store')->name('tipocontribuyente.guardar')->middleware(['auth','can:crear admin/tipocontribuyente']);
Route::get('admin/tipocontribuyente/{id}/editar','Admin\TipoContribuyenteController@edit')->name('tipocontribuyente.editar')->middleware(['auth','can:actualizar admin/tipocontribuyente']);
Route::put('admin/tipocontribuyente/{id}','Admin\TipoContribuyenteController@update')->name('tipocontribuyente.actualizar')->middleware(['auth'],'can:actualizar admin/tipocontribuyente');
Route::get('admin/tipocontribuyente/{id}/eliminar','Admin\TipoContribuyenteController@destroy')->name('tipocontribuyente.eliminar')->middleware(['auth','can:eliminar admin/tipocontribuyente']);

Route::get('admin/movimientobancario','Admin\MovimientoBancarioController@index')->name('movimientobancario')->middleware(['auth','can:ver admin/movimientobancario']);
Route::get('admin/movimientobancario/crear','Admin\MovimientoBancarioController@create')->name('movimientobancario.crear')->middleware(['auth','can:crear admin/movimientobancario']);
Route::post('admin/movimientobancario','Admin\MovimientoBancarioController@store')->name('movimientobancario.guardar')->middleware(['auth','can:crear admin/movimientobancario']);
Route::get('admin/movimientobancario/{id}/editar','Admin\MovimientoBancarioController@edit')->name('movimientobancario.editar')->middleware(['auth','can:actualizar admin/movimientobancario']);
Route::put('admin/movimientobancario/{id}','Admin\MovimientoBancarioController@update')->name('movimientobancario.actualizar')->middleware(['auth','can:actualizar admin/movimientobancario']);
Route::get('admin/movimientobancario/{id}/eliminar','Admin\MovimientoBancarioController@destroy')->name('movimientobancario.eliminar')->middleware(['auth','can:eliminar admin/movimientobancario']);

Route::get('admin/tipopago','Admin\TipoPagoController@index')->name('tipopago')->middleware(['auth','can:ver admin/tpipopago']);
Route::get('admin/tipopago/crear','Admin\TipoPagoController@create')->name('tipopago.crear')->middleware(['auth','can:crear admin/tipopago']);
Route::post('admin/tipopago','Admin\TipoPagoController@store')->name('tipopago.guardar')->middleware(['auth','can:crear admin/tipopago']);
Route::get('admin/tipopago/{id}/editar','Admin\TipoPagoController@edit')->name('tipopago.editar')->middleware(['auth','can:actualizar admin/tipopago']);
Route::put('admin/tipopago/{id}','Admin\TipoPagoController@update')->name('tipopago.actualizar')->middleware(['auth','can:actualizar admin/tipopago']);
Route::get('admin/tipopago/{id}/eliminar','Admin\TipoPagoController@destroy')->name('tipopago.eliminar')->middleware(['auth','can:eliminar admin:tipopago']);

Route::get('admin/tipocompra','Admin\TipoCompraController@index')->name('tipocompra')->middleware(['auth','can:ver admin/tipocompra']);
Route::get('admin/tipocompra/crear','Admin\TipoCompraController@create')->name('tipocompra.crear')->middleware(['auth','can:crear admin/tipocompra']);
Route::post('admin/tipocompra','Admin\TipoCompraController@store')->name('tipocompra.guardar')->middleware(['auth','can:crear admin/tipocompra']);
Route::get('admin/tipocompra/{id}/editar','Admin\TipoCompraController@edit')->name('tipocompra.editar')->middleware(['auth','can:actualizar admin/tipocompra']);
Route::put('admin/tipocompra/{id}','Admin\TipoCompraController@update')->name('tipocompra.actualizar')->middleware(['auth','can:actualizar admin/tipocompra']);
Route::get('admin/tipocompra/{id}/eliminar','Admin\TipoCompraController@destroy')->name('tipocompra.eliminar')->middleware(['auth','can:eliminar admin/tipocompra']);

Route::get('admin/categoria','Admin\CategoriaController@index')->name('categoria')->middleware(['auth','can:ver admin/categoria']);
Route::get('admin/categoria/crear','Admin\CategoriaController@create')->name('categoria.crear')->middleware(['auth','can:crear admin/categoria']);
Route::post('admin/categoria','Admin\CategoriaController@store')->name('categoria.guardar')->middleware(['auth','can:crear admin/categoria']);
Route::get('admin/categoria/{id}/editar','Admin\CategoriaController@edit')->name('categoria.editar')->middleware(['auth','can:actualizar admin/categoria']);
Route::put('admin/categoria/{id}','Admin\CategoriaController@update')->name('categoria.actualizar')->middleware(['auth','can:actualizar admin/categoria']);
Route::get('admin/categoria/{id}-{tipo}/eliminar','Admin\CategoriaController@destroy')->name('categoria.eliminar')->middleware(['auth','can:eliminar admin/categoria']);

Route::get('admin/statusactivos','Admin\StatusActivosController@index')->name('statusactivos')->middleware(['auth','can:ver admin/statusactivos']);
Route::get('admin/statusactivos/crear','Admin\StatusActivosController@create')->name('statusactivos.crear')->middleware(['auth','can:crear admin/statusactivos']);
Route::post('admin/statusactivos','Admin\StatusActivosController@store')->name('statusactivos.guardar')->middleware(['auth','can:crear admin/statusactivos']);
Route::get('admin/statusactivos/{id}/editar','Admin\StatusActivosController@edit')->name('statusactivos.editar')->middleware(['auth','can:actualizar admin/statusactivos']);
Route::put('admin/statusactivos/{id}','Admin\StatusActivosController@update')->name('statusactivos.actualizar')->middleware(['auth','can:actualizar admin/statusactivos']);
Route::get('admin/statusactivos/{id}/eliminar','Admin\StatusActivosController@destroy')->name('statusactivos.eliminar')->middleware(['auth','can:eliminar admin/statusactivos']);

Route::get('admin/propiedad','Admin\PropiedadController@index')->name('propiedad')->middleware(['auth','can:ver admin/propiedad']);
Route::get('admin/propiedad/crear','Admin\PropiedadController@create')->name('propiedad.crear')->middleware(['auth','can:crear admin/propiedad']);
Route::post('admin/propiedad','Admin\PropiedadController@store')->name('propiedad.guardar')->middleware(['auth','can:crear admin/propiedad']);
Route::get('admin/propiedad/{id}/editar','Admin\PropiedadController@edit')->name('propiedad.editar')->middleware(['auth','can:actualizar admin/propiedad']);
Route::put('admin/propiedad/{id}','Admin\PropiedadController@update')->name('propiedad.actualizar')->middleware(['auth','can:actualizar admin/propiedad']);
Route::get('admin/propiedad/{id}/eliminar','Admin\PropiedadController@destroy')->name('propiedad.eliminar')->middleware(['auth','can:eliminar admin/propiedad']);

Route::get('admin/paises','Admin\PaisesController@index')->name('paises')->middleware(['auth','can:ver admin/paises']);
Route::get('admin/paises/crear','Admin\PaisesController@create')->name('paises.crear')->middleware(['auth','can:crear admin/paises']);
Route::post('admin/paises','Admin\PaisesController@store')->name('paises.guardar')->middleware(['auth','can:crear admin/paises']);
Route::get('admin/paises/{id}/editar','Admin\PaisesController@edit')->name('paises.editar')->middleware(['auth','can:actualizar admin/paises']);
Route::put('admin/paises/{id}','Admin\PaisesController@update')->name('paises.actualizar')->middleware(['auth','can:actualizar admin/paises']);
Route::get('admin/paises/{id}/eliminar','Admin\PaisesController@destroy')->name('paises.eliminar')->middleware(['auth','can:eliminar admin/paises']);

Route::get('admin/pueblo','Admin\PuebloController@index')->name('pueblo')->middleware(['auth','can:ver admin/pueblo']);
Route::get('admin/pueblo/crear','Admin\PuebloController@create')->name('pueblo.crear')->middleware(['auth','can:crear admin/pueblo']);
Route::post('admin/pueblo','Admin\PuebloController@store')->name('pueblo.guardar')->middleware(['auth','can:crear admin/pueblo']);
Route::get('admin/pueblo/{id}/editar','Admin\PuebloController@edit')->name('pueblo.editar')->middleware(['auth','can:actualizar admin/pueblo']);
Route::put('admin/pueblo/{id}','Admin\PuebloController@update')->name('pueblo.actualizar')->middleware(['auth','can:actualizar admin/pueblo']);
Route::get('admin/pueblo/{id}/eliminar','Admin\PuebloController@destroy')->name('pueblo.eliminar')->middleware(['auth','can:eliminar admin/pueblo']);

Route::get('admin/academico','Admin\AcademicoController@index')->name('academico')->middleware(['auth','can:ver admin/academico']);
Route::get('admin/academico/crear','Admin\AcademicoController@create')->name('academico.crear')->middleware(['auth','can:crear admin/academico']);
Route::post('admin/academico','Admin\AcademicoController@store')->name('academico.guardar')->middleware(['auth','can:crear admin/academico']);
Route::get('admin/academico/{id}/editar','Admin\AcademicoController@edit')->name('academico.editar')->middleware(['auth','can:actualizar admin/academico']);
Route::put('admin/academico/{id}','Admin\AcademicoController@update')->name('academico.actualizar')->middleware(['auth','can:actualizar admin/academico']);
Route::get('admin/academico/{id}/eliminar','Admin\AcademicoController@destroy')->name('academico.eliminar')->middleware(['auth','can:eliminar admin/academico']);

Route::get('admin/idioma','Admin\IdiomaController@index')->name('idioma')->middleware(['auth','can:ver admin/idioma']);
Route::get('admin/idioma/crear','Admin\IdiomaController@create')->name('idioma.crear')->middleware(['auth','can:crear admin/idioma']);
Route::post('admin/idioma','Admin\IdiomaController@store')->name('idioma.guardar')->middleware(['auth','can:crear admin/idioma']);
Route::get('admin/idioma/{id}/editar','Admin\IdiomaController@edit')->name('idioma.editar')->middleware(['auth','can:actualizar admin/idioma']);
Route::put('admin/idioma/{id}','Admin\IdiomaController@update')->name('idioma.actualizar')->middleware(['auth','can:actualizar admin/idioma']);
Route::get('admin/idioma/{id}/eliminar','Admin\IdiomaController@destroy')->name('idioma.eliminar')->middleware(['auth','can:eliminar admin/idioma']);

Route::get('admin/discapacidad','Admin\DiscapacidadController@index')->name('discapacidad')->middleware(['auth','can:ver admin/discapacidad']);
Route::get('admin/discapacidad/crear','Admin\DiscapacidadController@create')->name('discapacidad.crear')->middleware(['auth','can:crear admin/discapacidad']);
Route::post('admin/discapacidad','Admin\DiscapacidadController@store')->name('discapacidad.guardar')->middleware(['auth','can:crear admin/discapacidad']);
Route::get('admin/discapacidad/{id}/editar','Admin\DiscapacidadController@edit')->name('discapacidad.editar')->middleware(['auth','can:actualizar admin/discapacidad']);
Route::put('admin/discapacidad/{id}','Admin\DiscapacidadController@update')->name('discapacidad.actualizar')->middleware(['auth','can:actualizar admin/discapacidad']);
Route::get('admin/discapacidad/{id}/eliminar','Admin\DiscapacidadController@destroy')->name('discapacidad.eliminar')->middleware(['auth','can:eliminar admin/discapacidad']);

Route::get('parametros/empresa','Parametros\EmpresaController@index')->name('empresa')->middleware(['auth','can:ver parametros/empresa']);
Route::get('parametros/empresa/crear','Parametros\EmpresaController@create')->name('empresa.crear')->middleware(['auth','can:crear parametros/empresa']);
Route::post('parametros/empresa','Parametros\EmpresaController@store')->name('empresa.guardar')->middleware(['auth','can:crear parametros/empresa']);
Route::get('parametros/empresa/{id}/editar','Parametros\EmpresaController@edit')->name('empresa.editar')->middleware(['auth','can:actualizar parametros/empresa']);
Route::put('parametros/empresa/{id}','Parametros\EmpresaController@update')->name('empresa.actualizar')->middleware(['auth','can:actualizar parametros/empresa']);
Route::get('parametros/empresa/{id}/eliminar','Parametros\EmpresaController@destroy')->name('empresa.eliminar')->middleware(['auth','can:eliminar parametros/empresa']);
Route::get('parametros/empresa/{id}/mostrar','Parametros\EmpresaController@show')->name('empresa.mostrar')->middleware(['auth','can:ver parametros/empresa']);
Route::get('parametros/empresa/{id}/terminal','Parametros\EmpresaController@terminal')->name('empresa.terminal')->middleware(['auth','can:actualizar parametros/empresa']);
Route::post('parametros/empresa/terminal','Parametros\EmpresaController@guardarTerminal')->name('empresa.asignarTerminal')->middleware(['auth','can:actualizar parametros/empresa']);
Route::get('parametros/empresa/{id}/representante','Parametros\EmpresaController@representante')->name('empresa.representante')->middleware(['auth','can:actualizar parametros/empresa']);
Route::get('parametros/empresa/{id}/representante/crear','Parametros\EmpresaController@crearRepresentante')->name('empresa.representante.crear')->middleware(['auth','can:actualizar parametros/empresa']);
Route::post('parametros/empresa/representante','Parametros\EmpresaController@guardarRepresentante')->name('empresa.asignarRepresentante')->middleware(['auth','can:actualizar parametros/empresa']);
Route::get('parametros/empresa/{id}/representante/{representante}-{tipo}-{inicio}/editarRep','Parametros\EmpresaController@editarRepresentante')->name('empresa.representante.editar')->middleware(['auth','can:actualizar parametros/empresa']);
Route::put('parametros/empresa/{id}/representante','Parametros\EmpresaController@actualizarRepresentante')->name('empresa.representante.actualizar')->middleware(['auth','can:actualizar paramentros/empresa']);
Route::post('parametros/empresa/usuario','Parametros\EmpresaController@asignaUsuario')->name('empresa.usuario')->middleware(['auth','can:actualizar parametros/usuario']);


Route::get('parametros/usuario','Parametros\UsuarioController@index')->name('usuario')->middleware(['auth','can:ver parametros/usuario']);
Route::get('parametros/usuario/crear','Parametros\UsuarioController@create')->name('usuario.crear')->middleware(['auth','can:crear parametros/usuario']);
Route::post('parametros/usuario','Parametros\UsuarioController@store')->name('usuario.guardar')->middleware(['auth','can:crear parametros/usuario']);
Route::get('parametros/usuario/{id}/editar','Parametros\UsuarioController@edit')->name('usuario.editar')->middleware(['auth','can:actualizar parametros/usuario']);
Route::put('parametros/usuario/{id}','Parametros\UsuarioController@update')->name('usuario.actualizar')->middleware(['auth','can:actualizar parametros/usuario']);
Route::get('parametros/usuario/{id}/eliminar','Parametros\UsuarioController@destroy')->name('usuario.eliminar')->middleware(['auth','can:eliminar parametros/usuario']);
Route::get('parametros/usuario/{id}/editarC','Parametros\UsuarioController@editC')->name('usuario.editarC')->middleware(['auth','can:actualizar parametros/usuario']);
Route::post('parametros/usuario/{id}','Parametros\UsuarioController@updateC')->name('usuario.actualizarC')->middleware(['auth','can:actualizar parametros/usuario']);
Route::get('parametros/usuario/{id}/roles','Parametros\UsuarioController@roles')->name('usuario.roles')->middleware(['auth','can:actualizar parametros/usuario']);
Route::get('parametros/usuario/{id}/permisos','Parametros\UsuarioController@permisos')->name('usuario.permisos')->middleware(['auth','can:actualizar parametros/usuario']);
Route::get('parametros/usuario/{id}/empresas','Parametros\UsuarioController@empresas')->name('usuario.empresas')->middleware(['auth','can:actualizar parametros/usuario']);
Route::get('parametros/usuario/{id}/terminales','Parametros\UsuarioController@terminales')->name('usuario.terminales')->middleware(['auth','can:actualizar parametros/usuario']);
Route::get('parametros/usuario/{id}/mostrar','Parametros\UsuarioController@show')->name('usuario.mostrar')->middleware(['auth','can:ver parametros/usuario']);


Route::get('parametros/rol','Parametros\RolController@index')->name('rol')->middleware(['auth','can:ver parametros/rol']);
Route::get('parametros/rol/crear','Parametros\RolController@create')->name('rol.crear')->middleware(['auth','can:crear parametros/rol']);
Route::post('parametros/rol','Parametros\RolController@store')->name('rol.guardar')->middleware(['auth','can:crear parametros/rol']);
Route::get('parametros/rol/{id}/eliminar','Parametros\RolController@destroy')->name('rol.eliminar')->middleware(['auth','can:eliminar parametros/rol']);
Route::get('parametros/rol/{id}/asignarPermisos','Parametros\RolController@asignarPermisos')->name('rol.asignarPermisos')->middleware(['auth','can:actualizar parametros/rol']);
Route::post('parametros/rol/permisoGuardar','Parametros\RolController@guardarPermisos')->name('rol.permisoGuardar')->middleware(['auth','can:actualizar parametros/rol']);
Route::post('parametros/rol/rolGuardar','Parametros\RolController@guardarRol')->name('rol.rolGuardar')->middleware(['auth','can:actualizar parametros/usuario']);
Route::post('parametros/rol/permisoUsuario','Parametros\RolController@guardarPermisosDirectos')->name('rol.permisoUsuario')->middleware(['auth','can:actualizar parametros/usuario']);


Route::get('cxc/ventas/ordenfacturacion','Cxc\OrdenFacturacionController@index')->name('ordenfacturacion')->middleware(['auth','can:ver cxc/ventas/ordenfacturacion']);
Route::get('cxc/ventas/ordenfacturacion/crear','Cxc\OrdenFacturacionController@create')->name('ordenfacturacion.crear')->middleware(['auth','can:crear cxc/ventas/ordenfacturacion']);
Route::post('cxc/ventas/ordenfacturacion','Cxc\OrdenFacturacionController@store')->name('ordenfacturacion.guardar')->middleware(['auth','can:crear cxc/ventas/ordenfacturacion']);
Route::get('cxc/ventas/ordenfacturacion/{id}/editar','Cxc\OrdenFacturacionController@edit')->name('ordenfacturacion.editar')->middleware(['auth','can:actualizar cxc/ventas/ordenfacturacion']);
Route::put('cxc/ventas/ordenfacturacion/{id}','Cxc\OrdenFacturacionController@update')->name('ordenfacturacion.actualizar')->middleware(['auth','can:actualizar cxc/ventas/ordenfacturacion']);
Route::get('cxc/ventas/ordenfacturacion/{id}/eliminar','Cxc\OrdenFacturacionController@destroy')->name('ordenfacturacion.eliminar')->middleware(['auth','can:eliminar  cxc/ventas/ordenfacturacion']);
Route::get('cxc/ventas/ordenfacturacion/{id}/mostrar','Cxc\OrdenFacturacionController@show')->name('ordenfacturacion.mostrar')->middleware(['auth','can:ver cxc/ventas/ordenfacturacion']);
Route::get('cxc/ventas/ordenfacturacion/{id}/factura/crear','Cxc\OrdenFacturacionController@crearFactura')->name('ordenfacturacion.factura.crear')->middleware(['auth','can:crear cxc/ventas/facturacion']);
Route::put('cxc/ventas/ordenfacturacion/{id}','Cxc\OrdenFacturacionController@CrearFacura')->name('ordenfacturacion.CrearFacura')->middleware(['auth','can:crear cxc/ventas/facturacion']);
Route::get('cxc/ventas/ordenfacturacion/{id}/editar1','Cxc\OrdenFacturacionController@edit1')->name('ordenfacturacion.editar1')->middleware(['auth','can:actualizar cxc/ventas/ordenfacturacion']);
Route::get('cxc/ventas/ordenfacturacion/{id}','Cxc\OrdenFacturacionController@update1')->name('ordenfacturacion.actualizar1')->middleware(['auth','can:actualizar1 cxc/ventas/ordenfacturacion']);
Route::get('cxc/ventas/ordenfacturacion/{id}/pdf','Cxc\OrdenFacturacionController@FacturaPDF')->name('ordenfacturacion.pdf')->middleware(['auth','can:ver cxc/ventas/ordenfacturacion']);
Route::get('cxc/ventas/ordenfacturacion/{id}/anulacion','Cxc\OrdenFacturacionController@Anular')->name('ordenfacturacion.anulacion')->middleware(['auth','can:anular cxc/ventas/ordenfacturacion']);
Route::put('cxc/ventas/ordenfacturacion/{id}/cancelar','Cxc\OrdenFacturacionController@Cancelar')->name('ordenfacturacion.cancelar')->middleware(['auth','can:eliminar cxc/ventas/ordenfacturacion']);



Route::get('activos/activo','Activos\ActivosController@index')->name('activos')->middleware(['auth','can:ver activos/activo']);
Route::get('activos/activo/crear','Activos\ActivosController@create')->name('activos.crear')->middleware(['auth','can:crear activos/activo']);
Route::post('activos/activo','Activos\ActivosController@store')->name('activos.guardar')->middleware(['auth','can:crear activos/activo']);
Route::get('activos/activo/{id}/editar','Activos\ActivosController@edit')->name('activos.editar')->middleware(['auth','can:actualizar activos/activo']);
Route::put('activos/activo/{id}','Activos\ActivosController@update')->name('activos.actualizar')->middleware(['auth','can:actualizar activos/activo']);
Route::get('activos/activo/{id}/eliminar','Activos\ActivosController@destroy')->name('activos.eliminar')->middleware(['auth','can:eliminar activos/activo']);
Route::get('activos/activo/{id}/propiedades','Activos\ActivosController@propiedades')->name('activos.propiedades')->middleware(['auth','can:actualizar activos/activo']);
Route::put('activos/activo/{id}/propiedades/actualizar','Activos\ActivosController@actualizarProp')->name('activos.actualizarProp')->middleware(['auth','can:actualizar activos/activo']);
Route::get('activos/activo/{id}propiedades/{prop}/eliminar/{val}','Activos\ActivosController@eliminarProp')->name('activos.eliminarProp')->middleware(['auth','can:actualizar activos/activo']);
Route::get('activos/listaActivos/{emp}','Activos\ActivosController@listaActivos')->name('activos.listaActivos')->middleware(['auth']);

Route::get('activos/amortizacion','Activos\AmortizacionesController@index')->name('amortizaciones')->middleware(['auth','can:ver activos/amortizacion']);
Route::get('activos/amortizacion/crear','Activos\AmortizacionesController@create')->name('amortizaciones.crear')->middleware(['auth','can:crear activos/amortizacion']);
Route::post('activos/amortizacion','Activos\AmortizacionesController@store')->name('amortizaciones.guardar')->middleware(['auth','can:crear activos/amortizacion']);
Route::get('activos/amortizacion/{id}/editar','Activos\AmortizacionesController@edit')->name('amortizaciones.editar')->middleware(['auth','can:actualizar activos/amortizacion']);
Route::put('activos/amortizacion/{id}','Activos\AmortizacionesController@update')->name('amortizaciones.actualizar')->middleware(['auth','can:actualizar activos/amortizacion']);
Route::get('activos/amortizacion/{id}/eliminar','Activos\AmortizacionesController@destroy')->name('amortizaciones.eliminar')->middleware(['auth','can:eliminar activos/amortizacion']);
Route::get('activos/amortizacion/{id}/propiedades','Activos\AmortizacionesController@propiedades')->name('amortizaciones.propiedades')->middleware(['auth','can:actualizar activos/amortizacion']);
Route::get('activos/amortizacion/{id}/mostrar','Activos\AmortizacionesController@show')->name('amortizaciones.mostrar')->middleware(['auth','can:ver activos/amortizacion']);

Route::get('activos/depreciacion','Activos\DepreciacionesController@index')->name('depreciaciones')->middleware(['auth','can:ver activos/depreciacion']);
Route::get('activos/depreciacion/{id}/mostrar','Activos\DepreciacionesController@show')->name('depreciaciones.mostrar')->middleware(['auth','can:ver activos/depreciacion']);

Route::get('cxc/ventas/facturacion','Cxc\FacturacionController@index')->name('facturacion')->middleware(['auth','can:ver cxc/ventas/facturacion']);
Route::get('cxc/ventas/facturacion/crear','Cxc\FacturacionController@create')->name('facturacion.crear')->middleware(['auth','can:crear cxc/ventas/facturacion']);
Route::post('cxc/ventas/facturacion','Cxc\FacturacionController@store')->name('facturacion.guardar')->middleware(['auth','can:crear cxc/ventas/facturacion']);
Route::get('cxc/ventas/facturacion/{id}/editar','Cxc\FacturacionController@edit')->name('facturacion.editar')->middleware(['auth','can:actualizar cxc/ventas/facturacion']);
Route::put('cxc/ventas/facturacion/{id}','Cxc\FacturacionController@update')->name('facturacion.actualizar')->middleware(['auth','can:actualizar cxc/ventas/facturacion']);
Route::get('cxc/ventas/facturacion/{id}/eliminar','Cxc\FacturacionController@destroy')->name('facturacion.eliminar')->middleware(['auth','can:eliminar  cxc/ventas/facturacion ']);
Route::get('cxc/ventas/facturacion/{id}/mostrar','Cxc\FacturacionController@show')->name('facturacion.mostrar')->middleware(['auth','can:ver cxc/ventas/facturacion']);
Route::get('cxc/ventas/facturacion/pdf','Cxc\FacturacionController@FacturaPDF')->name('facturacion.pdf')->middleware(['auth','can:ver cxc/ventas/facturacion']);
Route::post('cxc/ventas/facturacion/cancelar/{id}','Cxc\FacturacionController@Cancelar')->name('facturacion.cancelar')->middleware(['auth','can:eliminar cxc/ventas/facturacion']);
Route::get('cxc/ventas/facturacion/{id}/anulacion','Cxc\FacturacionController@Anular')->name('facturacion.anulacion')->middleware(['auth','can:anular cxc/ventas/facturacion']);
Route::get('cxc/ventas/facturacion/vista','Cxc\FacturacionController@Vista')->name('facturacion.vista')->middleware(['auth','can:crear cxc/ventas/facturacion']);




//Invoice
Route::get('cxc/ventas/invoice','Cxc\InvoiceController@index')->name('invoice')->middleware(['auth','can:ver cxc/ventas/invoice']);
Route::get('cxc/ventas/invoice/crear','Cxc\InvoiceController@create')->name('invoice.crear')->middleware(['auth','can:crear cxc/ventas/invoice']);
Route::post('cxc/ventas/invoice','Cxc\InvoiceController@store')->name('invoice.guardar')->middleware(['auth','can:crear cxc/ventas/invoice']);
Route::get('cxc/ventas/invoice/{id}/editar','Cxc\InvoiceController@edit')->name('invoice.editar')->middleware(['auth','can:actualizar cxc/ventas/invoice']);
Route::put('cxc/ventas/invoice/{id}','Cxc\InvoiceController@update')->name('invoice.actualizar')->middleware(['auth','can:actualizar cxc/ventas/invoice']);
Route::get('cxc/ventas/invoice/{id}/eliminar','Cxc\InvoiceController@destroy')->name('invoice.eliminar')->middleware(['auth','can:eliminar  cxc/ventas/invoice ']);
Route::get('cxc/ventas/invoice/{id}/mostrar','Cxc\InvoiceController@show')->name('invoice.mostrar')->middleware(['auth','can:ver cxc/ventas/invoice']);
Route::get('cxc/ventas/invoice/pdf','Cxc\InvoiceController@FacturaPDF')->name('invoice.pdf')->middleware(['auth','can:ver cxc/ventas/invoice']);
Route::get('cxc/ventas/invoice/anular','Cxc\InvoiceController@Anulacion')->name('invoice.anular')->middleware(['auth','can:anular cxc/ventas/invoice']);





Route::get('cxc/productos','Cxc\ProductosController@index')->name('productos')->middleware(['auth','can:ver cxc/productos']);
Route::get('cxc/productos/crear','Cxc\ProductosController@create')->name('productos.crear')->middleware(['auth','can:crear cxc/productos']);
Route::post('cxc/productos','Cxc\ProductosController@store')->name('productos.guardar')->middleware(['auth','can:crear cxc/productos']);
Route::get('cxc/productos/{id}/editar','Cxc\ProductosController@edit')->name('productos.editar')->middleware(['auth','can:actualizar cxc/productos']);
Route::put('cxc/productos/{id}','Cxc\ProductosController@update')->name('productos.actualizar')->middleware(['auth','can:actualizar cxc/productos']);
Route::get('cxc/productos/{id}/eliminar','Cxc\ProductosController@destroy')->name('productos.eliminar')->middleware(['auth','can:eliminar  cxc/productos']);
Route::get('cxc/productos/terminales','Parametros\TerminalController@Terminales')->name('listaTerminales')->middleware(['auth','can:ver cxc/productos']);


Route::get('cxp/proveedores','cxp\ProveedorController@index')->name('proveedores')->middleware(['auth','can:ver cxp/proveedores']);
Route::get('cxp/proveedores/crear/{id}','cxp\ProveedorController@create')->name('proveedores.crear')->middleware(['auth','can:crear cxp/proveedores']);
Route::post('cxp/proveedores','cxp\ProveedorController@store')->name('proveedores.guardar')->middleware(['auth','can:crear cxp/proveedores']);
Route::get('cxp/proveedores/{id}/editar','cxp\ProveedorController@edit')->name('proveedores.editar')->middleware(['auth','can:actualizar cxp/proveedores']);
Route::put('cxp/proveedores/{id}','cxp\ProveedorController@update')->name('proveedores.actualizar')->middleware(['auth','can:actualizar cxp/proveedores']);
Route::get('cxp/proveedores/{id}/eliminar','cxp\ProveedorController@destroy')->name('proveedores.eliminar')->middleware(['auth','can:eliminar cxp/proveedores']);

Route::get('cxp/facturas','cxp\FacturasController@index')->name('facturas')->middleware(['auth','can:ver cxp/facturas']);
Route::get('cxp/facturas/crear','cxp\FacturasController@create')->name('facturas.crear')->middleware(['auth','can:crear cxp/facturas']);
Route::post('cxp/facturas','cxp\FacturasController@store')->name('facturas.guardar')->middleware(['auth','can:crear cxp/facturas']);
Route::get('cxp/facturas/{id}/mostrar','cxp\FacturasController@show')->name('facturas.mostrar')->middleware(['auth','can:ver cxp/facturas']);
Route::put('cxp/facturas/{id}','cxp\FacturasController@update')->name('facturas.actualizar')->middleware(['auth','can:actualizar cxp/facturas']);
Route::get('cxp/facturas/{id}/eliminar','cxp\FacturasController@destroy')->name('facturas.eliminar')->middleware(['auth','can:eliminar cxp/facturas']);



Route::get('cxp/importacion','cxp\ImportacionController@index')->name('importacion')->middleware(['auth','can:ver cxp/importacion']);
Route::get('cxp/importacion/crear','cxp\ImportacionController@create')->name('importacion.crear')->middleware(['auth','can:crear cxp/importacion']);
Route::post('cxp/importacion','cxp\ImportacionController@store')->name('importacion.guardar')->middleware(['auth','can:crear cxp/importacion']);
Route::get('cxp/importacion/{id}/editar','cxp\ImportacionController@show')->name('importacion.mostrar')->middleware(['auth','can:ver cxp/importacion']);
Route::put('cxp/importacion/{id}','cxp\ImportacionController@update')->name('importacion.actualizar')->middleware(['auth','can:actualizar cxp/importacion']);
Route::get('cxp/importacion/{id}/eliminar','cxp\ImportacionController@destroy')->name('importacion.eliminar')->middleware(['auth','can:eliminar cxp/importacion']);

Route::get('cxp/recibos','cxp\RecibosController@index')->name('recibos')->middleware(['auth','can:ver cxp/recibos']);
Route::get('cxp/recibos/crear','cxp\RecibosController@create')->name('recibos.crear')->middleware(['auth','can:crear cxp/recibos']);
Route::post('cxp/recibos','cxp\RecibosController@store')->name('recibos.guardar')->middleware(['auth','can:crear cxp/recibos']);
Route::get('cxp/recibos/{id}/editar','cxp\RecibosController@show')->name('recibos.mostrar')->middleware(['auth','can:ver cxp/recibos']);
Route::put('cxp/recibos/{id}','cxp\RecibosController@update')->name('recibos.actualizar')->middleware(['auth','can:actualizar cxp/recibos']);
Route::get('cxp/recibos/{id}/eliminar','cxp\RecibosController@destroy')->name('recibos.eliminar')->middleware(['auth','can:eliminar cxp/recibos']);

Route::get('cxp/reportes/recibidos','cxp\ReportesController@recibidos')->name('cxp.reportes.recibidos')->middleware(['auth','can:ver cxp/reportes/recibidos']);
Route::post('cxp/reportes/recibidos','cxp\ReportesController@generar_recibidos')->name('cxp.reportes.recibidos.generar')->middleware(['auth','can:ver cxp/reportes/recibidos']);
Route::get('cxp/reportes/recibidos/excel/{empresas}','cxp\ReportesController@exportarRecibidosExcel')->name('cxp.reportes.recibidos.excel')->middleware(['auth','can:ver cxp/reportes/recibidos']);
Route::get('cxp/reportes/recibidos/pdf/{empresas}','cxp\ReportesController@exportarRecibidosPDF')->name('cxp.reportes.recibidos.pdf')->middleware(['auth','can:ver cxp/reportes/recibidos']);


Route::get('cxc/clientes','Cxc\ClientesController@index')->name('clientes')->middleware(['auth','can:ver cxc/clientes']);
Route::get('cxc/clientes/crear/{id}','Cxc\ClientesController@create')->name('clientes.crear')->middleware(['auth','can:crear cxc/clientes']);
Route::post('cxc/clientes','Cxc\ClientesController@store')->name('clientes.guardar')->middleware(['auth','can:crear cxc/clientes']);
Route::get('cxc/clientes/{id}/editar','Cxc\ClientesController@edit')->name('clientes.editar')->middleware(['auth','can:actualizar cxc/clientes']);
Route::put('cxc/clientes/{id}','Cxc\ClientesController@update')->name('clientes.actualizar')->middleware(['auth','can:actualizar cxc/clientes']);
Route::get('cxc/clientes/{id}/eliminar','Cxc\ClientesController@destroy')->name('clientes.eliminar')->middleware(['auth','can:eliminar cxc/clientes']);

Route::get('cxc/ventas/cobros','Cxc\CobrosController@index')->name('cobros')->middleware(['auth','can:ver cxc/ventas/cobros']);
Route::get('cxc/ventas/cobros/crear/{id}','Cxc\CobrosController@create')->name('cobros.crear')->middleware(['auth','can:crear cxc/ventas/cobros']);
Route::post('cxc/ventas/cobros','Cxc\CobrosController@store')->name('cobros.guardar')->middleware(['auth','can:crear cxc/ventas/cobros']);
Route::get('cxc/ventas/cobros/{id}/editar','Cxc\CobrosController@edit')->name('cobros.editar')->middleware(['auth','can:actualizar cxc/ventas/cobros']);
Route::put('cxc/ventas/cobros/{id}','Cxc\CobrosController@update')->name('cobros.actualizar')->middleware(['auth','can:actualizar cxc/ventas/cobros']);
Route::get('cxc/ventas/cobros/{id}/eliminar','Cxc\CobrosController@destroy')->name('cobros.eliminar')->middleware(['auth','can:eliminar cxc/ventas/cobros']);

Route::get('cxc/ventas/documentos/nabono','Cxc\NabonoController@index')->name('nabono')->middleware(['auth','can:ver cxc/ventas/documentos/nabono']);
Route::get('cxc/ventas/documentos/nabono/crear','Cxc\NabonoController@create')->name('nabono.crear')->middleware(['auth','can:crear cxc/ventas/documentos/nabono']);
Route::post('cxc/ventas/documentos/nabono','Cxc\NabonoController@store')->name('nabono.guardar')->middleware(['auth','can:crear cxc/ventas/documentos/nabono']);
Route::get('cxc/ventas/documentos/nabono/{id}/editar','Cxc\NabonoController@edit')->name('nabono.editar')->middleware(['auth','can:actualizar cxc/ventas/documentos/nabono']);
Route::put('cxc/ventas/documentos/nabono/{id}','Cxc\NabonoController@update')->name('nabono.actualizar')->middleware(['auth','can:actualizar cxc/ventas/documentos/nabono']);
Route::get('cxc/ventas/documentos/nabono/{id}/eliminar','Cxc\NabonoController@destroy')->name('nabono.eliminar')->middleware(['auth','can:eliminar  cxc/ventas/documentos/nabono ']);
Route::get('cxc/ventas/documentos/nabono/{id}/mostrar','Cxc\NabonoController@show')->name('nabono.mostrar')->middleware(['auth','can:ver cxc/ventas/documentos/nabono']);

Route::get('cxc/ventas/documentos/ncredito','Cxc\NcreditoController@index')->name('ncredito')->middleware(['auth','can:ver cxc/ventas/documentos/ncredito']);
Route::get('cxc/ventas/documentos/ncredito/crear','Cxc\NcreditoController@create')->name('ncredito.crear')->middleware(['auth','can:crear cxc/ventas/documentos/ncredito']);
Route::post('cxc/ventas/documentos/ncredito','Cxc\NcreditoController@store')->name('ncredito.guardar')->middleware(['auth','can:crear cxc/ventas/documentos/ncredito']);
Route::get('cxc/ventas/documentos/ncredito/{id}/editar','Cxc\NcreditoController@edit')->name('ncredito.editar')->middleware(['auth','can:actualizar cxc/ventas/documentos/ncredito']);
Route::put('cxc/ventas/documentos/ncredito/{id}','Cxc\NcreditoController@update')->name('ncredito.actualizar')->middleware(['auth','can:actualizar cxc/ventas/documentos/ncredito']);
Route::get('cxc/ventas/documentos/ncredito/{id}/eliminar','Cxc\NcreditoController@destroy')->name('ncredito.eliminar')->middleware(['auth','can:eliminar  cxc/ventas/documentos/ncredito ']);
Route::get('cxc/ventas/documentos/ncredito/{id}/mostrar','Cxc\NcreditoController@show')->name('ncredito.mostrar')->middleware(['auth','can:ver cxc/ventas/documentos/ncredito']);
Route::get('cxc/ventas/documentos/ncredito/vista','Cxc\NcreditoController@Vista')->name('ncredito.vista')->middleware(['auth','can:crear cxc/ventas/documentos/ncredito']);


Route::get('cxc/ventas/documentos/ndebito','Cxc\NdebitoController@index')->name('ndebito')->middleware(['auth','can:ver cxc/ventas/documentos/ndebito']);
Route::get('cxc/ventas/documentos/ndebito/crear','Cxc\NdebitoController@create')->name('ndebito.crear')->middleware(['auth','can:crear cxc/ventas/documentos/ndebito']);
Route::post('cxc/ventas/documentos/ndebito','Cxc\NdebitoController@store')->name('ndebito.guardar')->middleware(['auth','can:crear cxc/ventas/documentos/ndebito']);
Route::get('cxc/ventas/documentos/ndebito/{id}/editar','Cxc\NdebitoController@edit')->name('ndebito.editar')->middleware(['auth','can:actualizar cxc/ventas/documentos/ndebito']);
Route::put('cxc/ventas/documentos/ndebito/{id}','Cxc\NdebitoController@update')->name('ndebito.actualizar')->middleware(['auth','can:actualizar cxc/ventas/documentos/ndebito']);
Route::get('cxc/ventas/documentos/ndebito/{id}/eliminar','Cxc\NdebitoController@destroy')->name('ndebito.eliminar')->middleware(['auth','can:eliminar  cxc/ventas/documentos/ndebito']);
Route::get('cxc/ventas/documentos/ndebito/{id}/mostrar','Cxc\NdebitoController@show')->name('ndebito.mostrar')->middleware(['auth','can:ver cxc/ventas/documentos/ndebito']);
Route::get('cxc/ventas/documentos/ndebito/vista','Cxc\NdebitoController@Vista')->name('ndebito.vista')->middleware(['auth','can:crear cxc/ventas/documentos/ndebito']);





Route::get('cxc/ventas/documentos/retencion','Cxc\RetencionesController@index')->name('retencion')->middleware(['auth','can:ver cxc/ventas/documentos/retencion']);
Route::get('cxc/ventas/documentos/retencion/crear','Cxc\RetencionesController@create')->name('retencion.crear')->middleware(['auth','can:crear cxc/ventas/documentos/retencion']);
Route::post('cxc/ventas/documentos/retencion','Cxc\RetencionesController@store')->name('retencion.guardar')->middleware(['auth','can:crear cxc/ventas/documentos/retencion']);
Route::get('cxc/ventas/documentos/retencion/{id}/editar','Cxc\RetencionesController@edit')->name('retencion.editar')->middleware(['auth','can:actualizar cxc/ventas/documentos/retencion']);
Route::put('cxc/ventas/documentos/retencion/{id}','Cxc\RetencionesController@update')->name('retencion.actualizar')->middleware(['auth','can:actualizar cxc/ventas/documentos/retencion']);
Route::get('cxc/ventas/documentos/retencion/{id}/eliminar','Cxc\RetencionesController@destroy')->name('retencion.eliminar')->middleware(['auth','can:eliminar  cxc/ventas/documentos/retencion']);
Route::get('cxc/ventas/documentos/retencion/{id}/mostrar','Cxc\RetencionesController@show')->name('retencion.mostrar')->middleware(['auth','can:ver cxc/ventas/documentos/retencion']);

//Retencion IVA
Route::get('cxc/ventas/documentos/retencionIVA','Cxc\RetencionesIVAController@index')->name('retencionIVA')->middleware(['auth','can:ver cxc/ventas/documentos/retencionIVA']);
Route::get('cxc/ventas/documentos/retencionIVA/crear','Cxc\RetencionesIVAController@create')->name('retencionIVA.crear')->middleware(['auth','can:crear cxc/ventas/documentos/retencionIVA']);
Route::post('cxc/ventas/documentos/retencionIVA','Cxc\RetencionesIVAController@store')->name('retencionIVA.guardar')->middleware(['auth','can:crear cxc/ventas/documentos/retencionIVA']);
Route::get('cxc/ventas/documentos/retencionIVA/{id}/editar','Cxc\RetencionesIVAController@edit')->name('retencionIVA.editar')->middleware(['auth','can:actualizar cxc/ventas/documentos/retencionIVA']);
Route::put('cxc/ventas/documentos/retencionIVA/{id}','Cxc\RetencionesIVAController@update')->name('retencionIVA.actualizar')->middleware(['auth','can:actualizar cxc/ventas/documentos/retencionIVA']);
Route::get('cxc/ventas/documentos/retencionIVA/{id}/eliminar','Cxc\RetencionesIVAController@destroy')->name('retencionIVA.eliminar')->middleware(['auth','can:eliminar  cxc/ventas/documentos/retencionIVA']);
Route::get('cxc/ventas/documentos/retencionIVA/{id}/mostrar','Cxc\RetencionesIVAController@show')->name('retencionIVA.mostrar')->middleware(['auth','can:ver cxc/ventas/documentos/retencionIVA']);



//Modulo de Planillas
Route::prefix('/planillas')->namespace('Planillas')->middleware('auth')->group(function () {
    Route::prefix('/empleados')->group(function () {
        //Catalogo de empleados
        Route::get('', 'EmpleadoController@index')->name('empleados')->middleware(['can:ver planillas/empleados']);
        Route::get('/get/{empresa}/{terminal}/{tipo}', 'EmpleadoController@getEmpleados')->name('empleados.get');
        Route::get('/crear', 'EmpleadoController@create')->name('empleados.crear')->middleware(['can:crear planillas/empleados']);
        Route::post('', 'EmpleadoController@store')->name('empleados.guardar')->middleware(['can:crear planillas/empleados']);
        Route::post('/ext', 'EmpleadoController@storeEmpleadoExt')->name('empleados.guardarEmpleadoExt')->middleware(['can:crear planillas/empleados']);
        Route::get('/{id}/editar', 'EmpleadoController@edit')->name('empleados.editar')->middleware(['can:actualizar planillas/empleados']);
        Route::put('/{id}', 'EmpleadoController@update')->name('empleados.actualizar')->middleware(['can:actualizar planillas/empleados']);
        Route::post('/ext-empleado/{id}', 'EmpleadoController@storeExt')->name('empleados.guardarExt')->middleware(['can:actualizar planillas/empleados']);
        Route::get('/{id}/eliminar', 'EmpleadoController@destroy')->name('empleados.eliminar')->middleware(['can:eliminar planillas/empleados']);
        Route::get('/{id}/eliminar-ext', 'EmpleadoController@destroyExt')->name('empleados.eliminarExt')->middleware(['can:eliminar planillas/empleados']);
    });
    Route::prefix('/generacion')->group(function () {
        //Catalogo de generacion de planillas
        Route::prefix('/mensual')->group(function () {
            Route::get('', 'PlanillaMensualController@index')->name('planillas-mensual')->middleware(['can:ver planillas/generacion/mensual']);
            Route::get('/crear', 'PlanillaMensualController@create')->name('planillas-mensual.crear')->middleware(['can:crear planillas/generacion/mensual']);
            Route::get('/detalle/{id}', 'PlanillaMensualController@show')->name('planillas-mensual.show')->middleware(['can:crear planillas/generacion/mensual']);
            Route::post('', 'PlanillaMensualController@store')->name('planillas-mensual.guardar')->middleware(['can:crear planillas/generacion']);
            Route::get('/excel/{id}', 'PlanillaMensualController@exportarPlanillaMensualExcel')->name('planillas-mensual.excel')->middleware(['can:crear planillas/generacion/mensual']);
            Route::get('/pdf/{id}', 'PlanillaMensualController@exportarPlanillaMensualPDF')->name('planillas-mensual.pdf')->middleware(['can:crear planillas/generacion/mensual']);
            Route::get('/{id}/eliminar-planilla', 'PlanillaMensualController@destroy')->name('planillas-mensual.eliminar')->middleware(['can:eliminar planillas/generacion/mensual']);
            Route::prefix('/reporte-ausencia')->group(function () {
                Route::get('', 'ReporteAusenciaController@index')->name('reporte-ausencia')->middleware(['can:ver planillas/generacion/mensual']);
                Route::get('/crear', 'ReporteAusenciaController@create')->name('reporte-ausencia.crear')->middleware(['can:crear planillas/generacion/mensual']);
                Route::post('', 'ReporteAusenciaController@store')->name('reporte-ausencia.guardar')->middleware(['can:crear planillas/generacion/mensual']);
            });
            Route::prefix('/reporte-horas-extra')->group(function () {
                Route::get('', 'ReporteHoraExtraController@index')->name('reporte-horae')->middleware(['can:ver planillas/generacion/mensual']);
                Route::get('/crear', 'ReporteHoraExtraController@create')->name('reporte-horae.crear')->middleware(['can:crear planillas/generacion/mensual']);
                Route::post('', 'ReporteHoraExtraController@store')->name('reporte-horae.guardar')->middleware(['can:crear planillas/generacion/mensual']);
            });
        });
        Route::prefix('/eventual')->group(function () {
            Route::get('', 'PlanillaEventualController@index')->name('planillas-eventual')->middleware(['can:ver planillas/generacion/eventual']);
            Route::get('/get/turnos/{empresa}/{terminal}/{fecha}', 'PlanillaEventualController@getPlanillasTurnos')->name('planillas-eventual.turnos')->middleware(['can:ver planillas/generacion/eventual']);
            Route::get('/get/barcos/{empresa}/{terminal}/{fecha}', 'PlanillaEventualController@getPlanillasBarcos')->name('planillas-eventual.barcos')->middleware(['can:ver planillas/generacion/eventual']);
            Route::get('/detalle/{id}', 'PlanillaEventualController@show')->name('planillas-eventual.show')->middleware(['can:crear planillas/generacion/mensual']);
            Route::get('/crear', 'PlanillaEventualController@create')->name('planillas-eventual.crear')->middleware(['can:crear planillas/generacion/eventual']);
            Route::get('/generar/{planilla}', 'PlanillaEventualController@generate')->name('planillas-eventual.generar')->middleware(['can:crear planillas/generacion/eventual']);
            Route::get('/ver/{id}', 'PlanillaEventualController@show')->name('planillas-eventual.ver')->middleware(['can:ver planillas/generacion/eventual']);
            Route::get('/validar', 'PlanillaEventualController@validar')->name('planillas-eventual.validar')->middleware(['can:ver planillas/generacion/eventual']);
            Route::get('/septimo/{empleado}/{planilla}/{tipo}', 'PlanillaEventualController@septimoSet')->name('planillas-eventual.septimo')->middleware(['can:crear planillas/generacion/eventual']);
            Route::get('/insert-planilla', 'PlanillaEventualController@insertPlanilla')->name('planillas-eventual.insert')->middleware(['can:crear planillas/generacion/eventual']);
            Route::get('/excel/{id}', 'PlanillaEventualController@exportarExcel')->name('planillas-eventual.excel')->middleware(['can:ver planillas/generacion/eventual']);
            Route::get('/pdf/{id}', 'PlanillaEventualController@exportarPDF')->name('planillas-eventual.pdf')->middleware(['can:ver planillas/generacion/eventual']);
            Route::get('/finiquito/{id}', 'PlanillaEventualController@imprimirFiniquito')->name('planillas-eventual.finiquito')->middleware(['can:ver planillas/generacion/eventual']);
            Route::post('', 'PlanillaEventualController@store')->name('planillas-eventual.guardar')->middleware(['can:crear planillas/generacion/eventual']);
            Route::get('/{id}/eliminar-planilla', 'PlanillaEventualController@destroy')->name('planillas-eventual.eliminar')->middleware(['can:eliminar planillas/generacion/eventual']);
            Route::prefix('/descuentos')->group(function () {
                Route::get('', 'DescuentoEventualController@index')->name('descuento-eventual')->middleware(['can:ver planillas/generacion/eventual']);
                Route::get('/crear', 'DescuentoEventualController@create')->name('descuento-eventual.crear')->middleware(['can:crear planillas/generacion/eventual']);
                Route::post('', 'DescuentoEventualController@store')->name('descuento-eventual.guardar')->middleware(['can:crear planillas/generacion/eventual']);
            });
            Route::prefix('/reporte-turnos')->group(function () {
                //Reporte de turnos
                Route::get('', 'ReporteTurnosController@index')->name('reporte-turnos')->middleware(['can:ver planillas/generacion/eventual']);
                Route::get('/crear', 'ReporteTurnosController@create')->name('reporte-turnos.crear')->middleware(['can:crear planillas/generacion/eventual']);
                Route::post('', 'ReporteTurnosController@store')->name('reporte-turnos.guardar')->middleware(['can:crear planillas/generacion/eventual']);
                Route::post('/asignar', 'ReporteTurnosController@asignar')->name('reporte-turnos.asignar')->middleware(['can:crear planillas/generacion/eventual']);
                Route::post('/especifico', 'ReporteTurnosController@asignarEmpleados')->name('reporte-turnos.asignar-empleado')->middleware(['can:crear planillas/generacion/eventual']);
                Route::get('/ver/{id}', 'ReporteTurnosController@show')->name('reporte-turnos.ver')->middleware(['can:ver planillas/generacion/eventual']);
            });
            Route::prefix('/reporte-barcos')->group(function () {
                //Reporte de turnos
                Route::get('', 'ReporteBarcosController@index')->name('reporte-barcos')->middleware(['can:ver planillas/generacion/eventual']);
                Route::get('/crear', 'ReporteBarcosController@create')->name('reporte-barcos.crear')->middleware(['can:crear planillas/generacion/eventual']);
                Route::post('', 'ReporteBarcosController@store')->name('reporte-barcos.guardar')->middleware(['can:crear planillas/generacion/eventual']);
            });
        });
        Route::prefix('/especial')->group(function () {
            Route::get('', 'PlanillaEspecialController@index')->name('planillas-especial')->middleware(['can:ver planillas/generacion/planilla-especial']);
            Route::get('/crear', 'PlanillaEspecialController@create')->name('planillas-especial.crear')->middleware(['can:crear planillas/generacion/planilla-especial']);
            Route::post('', 'PlanillaEspecialController@store')->name('planillas-especial.guardar')->middleware(['can:crear planillas/generacion/planilla-especial']);
            Route::get('ver/{id}', 'PlanillaEspecialController@show')->name('planillas-especial.ver')->middleware(['can:ver planillas/generacion/planilla-especial']);
            Route::get('excel/{id}', 'PlanillaEspecialController@exportarExcel')->name('planillas-especial.excel')->middleware(['can:ver planillas/generacion/planilla-especial']);
            Route::get('pdf/{id}', 'PlanillaEspecialController@exportarPDF')->name('planillas-especial.pdf')->middleware(['can:ver planillas/generacion/planilla-especial']);
            Route::get('/{id}/eliminar-planilla', 'PlanillaMensualController@destroy')->name('planillas-especial.eliminar')->middleware(['can:eliminar planillas/generacion/especial']);
        });

    });
    Route::prefix('/bonificaciones')->group(function () {
        //Bonificaciones y descuentos
        Route::get('', 'DescBonoController@index')->name('bonificacion')->middleware(['can:ver planillas/bonificaciones']);
        Route::get('/crear', 'DescBonoController@create')->name('bonificacion.crear')->middleware(['can:crear planillas/bonificaciones']);
        Route::post('', 'DescBonoController@store')->name('bonificacion.guardar')->middleware(['can:crear planillas/bonificaciones']);
        Route::post('/bonificacion-empleados', 'DescBonoController@setEmpleados')->name('bonificacionE.guardar')->middleware(['can:crear planillas/bonificaciones']);
    });
    Route::prefix('/descuentos')->group(function () {
        Route::get('', 'DescBonoController@index')->name('descuento')->middleware(['can:ver planillas/descuentos']);
        Route::get('/crear', 'DescBonoController@create')->name('descuento.crear')->middleware(['can:crear planillas/bonificaciones']);
        Route::post('', 'DescBonoController@store')->name('descuento.guardar')->middleware(['can:crear planillas/descuentos']);
        Route::post('/descuento-empleados', 'DescBonoController@setEmpleados')->name('descuentoE.guardar')->middleware(['can:crear planillas/descuentos']);

    });
    Route::prefix('/tipo-descuentos')->group(function () {
        //Tipos de descuentos y bonificaciones
        Route::get('', 'TipoDescController@index')->name('tipodesc')->middleware(['can:ver planillas/tipo-descuentos']);
        Route::get('/crear', 'TipoDescController@create')->name('tipodesc.crear')->middleware(['can:crear planillas/tipo-descuentos']);
        Route::post('', 'TipoDescController@store')->name('tipodesc.guardar')->middleware(['can:crear planillas/tipo-descuentos']);
        Route::get('/{id}/editar', 'TipoDescController@edit')->name('tipodesc.editar')->middleware(['can:actualizar planillas/tipo-descuentos']);
        Route::put('/{id}', 'TipoDescController@update')->name('tipodesc.actualizar')->middleware(['can:actualizar planillas/tipo-descuentos']);
        Route::get('/{id}/eliminar', 'TipoDescController@destroy')->name('tipodesc.eliminar')->middleware(['can:eliminar planillas/tipo-descuentos']);
    });
    Route::prefix('/prestaciones-laboral')->group(function () {
        //Prestaciones Laborales
        Route::get('', 'PrestacionesLaboralesController@create')->name('prestacion-laboral')->middleware(['can:ver planillas/prestaciones-laboral']);
        Route::post('', 'PrestacionesLaboralesController@store')->name('prestacion-laboral.guardar')->middleware(['can:crear planillas/prestaciones-laboral']);
        Route::get('/pdf/{datas}', 'PrestacionesLaboralesController@exportarPDF')->name('prestacion-laboral.pdf')->middleware(['can:crear planillas/prestaciones-laboral']);
    });
    Route::prefix('/reportes')->group(function () {
        //Reportes
        Route::prefix('/reportes-estadistico')->group(function () {
            Route::get('', 'ReporteEstadisticoController@create')->name('reportes-estadistico')->middleware(['can:ver planillas/reportes/reportes-estadistico']);
            Route::post('/guardar', 'ReporteEstadisticoController@store')->name('reportes-estadistico.guardar')->middleware(['can:crear planillas/reportes/reportes-estadistico']);
            Route::get('/excel/{datas}', 'ReporteEstadisticoController@exportarExcel')->name('reportes-estadistico.excel')->middleware(['can:crear planillas/reportes/reportes-estadistico']);
        });
        Route::prefix('/libro-salarios')->group(function () {
            Route::get('', 'ReporteLibroSalariosController@create')->name('libro-salarios')->middleware(['can:ver planillas/reportes/libro-salarios']);
            Route::post('/guardar', 'ReporteLibroSalariosController@store')->name('libro-salarios.guardar')->middleware(['can:crear planillas/reportes/libro-salarios']);
        });
        Route::get('/planilla-igss', 'ReportesController@indexLibroSalarios')->name('planilla-igss')->middleware(['can:crear planillas/reportes/planilla-igss']);
    });


});

//Cuentas bancarias y catalogos
Route::get('cyb/bancos/cuentasbancarias/crear', 'cyb\CuentasBancariasController@create')->name('cuentasbancarias.crear')->middleware(['auth', 'can:crear cyb/bancos/cuentasbancarias']);
Route::get('cyb/bancos/cuentasbancarias', 'cyb\CuentasBancariasController@index')->name('cuentasbancarias')->middleware(['auth', 'can:ver cyb/bancos/cuentasbancarias']);
Route::post('cyb/bancos/cuentasbancarias', 'cyb\CuentasBancariasController@store')->name('cuentasbancarias.guardar')->middleware(['auth', 'can:crear cyb/bancos/cuentasbancarias']);
Route::get('cyb/bancos/catalogo', 'cyb\CuentasBancariasController@show')->name('cuentasbancarias.catalogo')->middleware(['auth', 'can:ver cyb/bancos/cuentasbancarias']);
Route::get('cyb/bancos/catalogo/imprimir', 'cyb\CuentasBancariasController@imprimir')->name('cuentasbancarias.imprimir')->middleware(['auth', 'can:ver cyb/bancos/cuentasbancarias']);
Route::get('cyb/bancos/cuentasbancarias/editar/{id}', 'cyb\CuentasBancariasController@edit')->name('cuentasbancarias.editar')->middleware(['auth', 'can:actualizar cyb/bancos/cuentasbancarias']);
Route::put('cyb/bancos/cuentasbancarias/{id}', 'cyb\CuentasBancariasController@update')->name('cuentasbancarias.actualizar')->middleware(['auth', 'can:actualizar cyb/bancos/cuentasbancarias']);
Route::get('cyb/bancos/cuentasbancarias/eliminar/{id}', 'cyb\CuentasBancariasController@destroy' )->name('cuentasbancarias.eliminar')->middleware(['auth', 'can:eliminar cyb/bancos/cuentasbancarias']);
Route::get('cyb/bancos/cuentasbancarias/PDF/{dato?}', 'cyb\PDFController@PDFCB')->name('cbpdf')->middleware(['auth', 'can:ver cyb/bancos/cuentasbancarias']);
Route::get('cyb/bancos/cuentasbancarias/EXCEL/{dato?}', 'cyb\EXCELController@EXCELCB')->name('cbexcel')->middleware(['auth', 'can:ver cyb/bancos/cuentasbancarias']);

//Anticipos
Route::get('cyb/bancos/anticipos/crear', 'cyb\AnticiposController@index')->name('anticipos')->middleware(['auth', 'can:ver cyb/bancos/anticipos/crear']);
Route::get('cyb/bancos/anticipos/crear/nuevo', 'cyb\AnticiposController@create')->name('anticipos.crear')->middleware(['auth', 'can:crear cyb/bancos/anticipos/crear']);
Route::post('cyb/bancos/anticipos/crear', 'cyb\AnticiposController@store')->name('anticipos.guardar')->middleware(['auth', 'can:crear cyb/bancos/anticipos/crear']);
Route::get('cyb/bancos/anticipos/crear/nuevodetalle/{id}', 'cyb\AnticiposController@antdetalle')->name('anticipos.detalle')->middleware(['auth', 'can:crear cyb/bancos/anticipos/crear']);
Route::post('cyb/bancos/anticipos/crear/detalle', 'cyb\AnticiposController@storedetalle')->name('anticipos.guardardetalle')->middleware(['auth', 'can:crear cyb/bancos/anticipos/crear']);
Route::get('cyb/bancos/anticipos/crear/detalles/{id}', 'cyb\AnticiposController@listadetalle')->name('anticipos.listadetalles')->middleware(['auth', 'can:crear cyb/bancos/anticipos/crear']);

Route::get('cyb/bancos/anticipos/liquidar', 'cyb\AnticiposController@show')->name('liquidar')->middleware(['auth', 'can:ver cyb/bancos/anticipos/liquidar']);
Route::get('cyb/bancos/anticipos/liquidar/detalles/{id}', 'cyb\AnticiposController@masterdetalles')->name('liquidar.anticipos')->middleware(['auth', 'can:ver cyb/bancos/anticipos/liquidar']);
Route::get('cyb/bancos/anticipos/liquidar/revision/{detalle}/{cambiar}', 'cyb\AnticiposController@detalleEstado')->name('detalle.estado')->middleware(['auth', 'can:ver cyb/bancos/anticipos/liquidar']);
Route::get('cyb/bancos/anticipo/liquidar/anticipo/{liquidacion}/{cambiar}', 'cyb\AnticiposController@antLiquidar')->name('autorizar.anticipos')->middleware(['auth', 'can:ver cyb/bancos/anticipos/liquidar']);
Route::get('cyb/bancos/anticipo/liquidar/PDF', 'cyb\PDFController@liquidAnticipo')->name('anticipopdf')->middleware(['auth', 'can:ver cyb/bancos/anticipos/liquidar']);


//Cajas chicas
Route::get('cyb/cajas/responsables', 'cyb\CajaChicaController@index')->name('cajachica')->middleware(['auth', 'can:ver cyb/cajas/responsables']);
Route::get('cyb/cajas/responsables/crear', 'cyb\CajaChicaController@create')->name('cajachica.crear')->middleware(['auth', 'can:crear cyb/cajas/responsables']);
Route::post('cyb/cajas/responsables', 'cyb\CajaChicaController@store')->name('cajachica.guardar')->middleware(['auth', 'can:crear cyb/cajas/responsables']);
Route::get('cyb/cajas/responsables/editar{id}', 'cyb\CajaChicaController@edit')->name('cajachica.editar')->middleware(['auth', 'can:actualizar cyb/cajas/responsables']);
Route::put('cyb/cajas/responsables/{id}', 'cyb\CajaChicaController@update')->name('cajachica.actualizar')->middleware(['auth', 'can:actualizar cyb/cajas/responsables']);
Route::get('cyb/cajas/responsables/eliminar/{id}', 'cyb\CajaChicaController@destroy' )->name('cajachica.eliminar')->middleware(['auth', 'can:eliminar cyb/cajas/responsables']);
Route::get('cyb/cajas/responsables/PDF', 'cyb\PDFController@PDFCC')->name('ccpdf')->middleware(['auth', 'can:ver cyb/cajas/responsables']);
Route::get('cyb/cajas/responsables/EXCEL', 'cyb\EXCELController@EXCELCC')->name('ccexcel')->middleware(['auth', 'can:ver cyb/cajas/responsables']);
Route::get('contabilidad/ctaCuentaCajaChica/{emp}/{nivel?}/{detalle}','Contabilidad\CuentaContableController@CuentaCajaChica')->name('cuentas.cajachica')->middleware('auth');


//liquidar cajas
Route::get('cyb/cajas/liquidaciones', 'cyb\LiquidacionController@index')->name('liquidacion')->middleware(['auth', 'can:ver cyb/cajas/liquidaciones']);
Route::get('cyb/cajas/liquidaciones/crear', 'cyb\LiquidacionController@create')->name('liquidacion.crear')->middleware(['auth', 'can:crear cyb/cajas/liquidaciones']);
Route::post('cyb/cajas/liquidaciones/nueva', 'cyb\LiquidacionController@store')->name('crearliquidacion')->middleware(['auth']);
Route::get('cyb/cajas/liquidaciones/nueva/{id}', 'cyb\LiquidacionController@show')->name('detalle.crear')->middleware(['auth', 'can:crear cyb/cajas/liquidaciones']);
Route::get('cyb/cajas/liquidaciones/detalles/{id}', 'cyb\LiquidacionController@indexdetalle')->name('detalle.lista')->middleware(['auth', 'can:crear cyb/cajas/liquidaciones']);
Route::post('cyb/cajas/Liquidaciones', 'cyb\LiquidacionController@storedetalle')->name('detalle.guardar')->middleware(['auth', 'can:crear cyb/cajas/liquidaciones']);
Route::get('cyb/cajas/liquidaciones/eliminar/{id}', 'cyb\LiquidacionController@destroy')->name('liquidacion.eliminar')->middleware(['auth', 'can:eliminar cyb/cajas/liquidaciones']);
Route::get('cyb/cajas/liquidaciones/EXCEL/{id}', 'cyb\EXCELController@EXCELDLCC')->name('dlccexcel')->middleware(['auth', 'can:ver cyb/cajas/liquidaciones']);
Route::get('cyb/cajas/liquidaciones/PDF/{id}', 'cyb\PDFController@detalleLiquidacion')->name('pdfDetalleLiquidacion')->middleware(['auth', 'can:ver cyb/cajas/liquidaciones']);

//autorizar liquidaciones
Route::get('cyb/bancos/autorizacion', 'cyb\CajaChicaController@indexAutorizar')->name('autorizar')->middleware(['auth', 'can:ver cyb/bancos/autorizacion']);
Route::get('cyb/bancos/autorizacion/detalles/{id}', 'cyb\CajaChicaController@masterdetalles')->name('autorizar.detalles')->middleware(['auth', 'can:ver cyb/bancos/autorizacion']);
Route::get('cyb/bancos/autorizacion/revision/{detalle}/{cambiar}', 'cyb\LiquidacionController@cambiarestatus')->name('autorizar.status')->middleware(['auth', 'can:ver cyb/bancos/autorizacion']);
Route::get('cyb/bancos/autorizacion/liquidacion/{liquidacion}/{cambiar}', 'cyb\LiquidacionController@liquidar')->name('autorizar.liquidacion')->middleware(['auth', 'can:ver cyb/bancos/autorizacion']);
Route::get('cyb/bancos/autorizacion/PDF', 'cyb\PDFController@liquidCajaChica')->name('cajaspdf')->middleware(['auth', 'can:ver cyb/bancos/autorizacion']);


//Transferencias a terceros
Route::get('cyb/bancos/transferencias/a-terceros', 'cyb\ChequeController@indexAter')->name('chequeater')->middleware(['auth', 'can:ver cyb/bancos/transferencias/a-terceros']);
Route::get('cyb/bancos/transferencias/a-terceros/crear', 'cyb\ChequeController@createAter')->name('chequeater.crear')->middleware(['auth', 'can:ver cyb/bancos/transferencias/a-terceros']);
Route::post('cyb/bancos/transferencias/a-terceros', 'cyb\ChequeController@storeAter')->name('chequeater.nuevo')->middleware(['auth', 'can:ver cyb/bancos/transferencias/a-terceros']);
Route::get('cyb/bancos/transferencias/a-terceros/editar/{id}', 'cyb\ChequeController@editAter')->name('chequeater.editar')->middleware(['auth', 'can:ver cyb/bancos/transferencias/a-terceros']);
Route::get('cyb/cajas/tranferencias/a-terceros/ChequePDF/{tipo}/{id}', 'cyb\PDFController@chequePDF')->name('chequepdf')->middleware(['auth']);

Route::get('cyb/cajas/tranferencias/a-terceros/BanruralPDF/{id}', 'cyb\PDFController@ChequeBanrural')->name('banruralpdf')->middleware(['auth', 'can:ver cyb/cajas/tranferencias/a-terceros']);
Route::get('cyb/cajas/tranferencias/a-terceros/IndustrialPDF/{id}', 'cyb\PDFController@ChequeIndustrial')->name('industrialpdf')->middleware(['auth', 'can:ver cyb/cajas/tranferencias/a-terceros']);
Route::get('cyb/cajas/tranferencias/a-terceros/InterPDF/{id}', 'cyb\PDFController@ChequeInter')->name('Interpdf')->middleware(['auth', 'can:ver cyb/cajas/tranferencias/a-terceros']);

//Transferencias de terceros
Route::get('cyb/bancos/transferencias/de-terceros', 'cyb\ChequeController@indexdeter')->name('chequedeter')->middleware(['auth', 'can:ver cyb/bancos/transferencias/de-terceros']);
Route::get('cyb/bancos/transferencias/de-terceros/crear', 'cyb\ChequeController@createdeter')->name('chequedeter.crear')->middleware(['auth', 'can:crear cyb/bancos/transferencias/de-terceros']);
Route::post('cyb/bancos/transferencias/de-terceros', 'cyb\ChequeController@storedeter')->name('chequedeter.guardar')->middleware(['auth', 'can:crear cyb/bancos/transferencias/de-terceros']);


//tranferencias internas
Route::get('cyb/bancos/transferencias/internas', 'cyb\ChequeController@indexinter')->name('internas')->middleware(['auth', 'can:ver cyb/bancos/transferencias/internas']);
Route::get('cyb/bancos/transferencias/internas/crear', 'cyb\ChequeController@internas')->name('internas.crear')->middleware(['auth', 'can:crear cyb/bancos/transferencias/internas']);
Route::post('cyb/bancos/transferencias/internas', 'cyb\ChequeController@createinter')->name('internas.guardar')->middleware(['auth', 'can:crear cyb/bancos/transferencias/internas']);


//Transferencias relacionadas
Route::get('cyb/bancos/transferencias/relacionadas', 'cyb\ChequeController@indexrel')->name('relacionadas')->middleware(['auth', 'can:ver cyb/bancos/transferencias/relacionadas']);
Route::get('cyb/bancos/transferencias/relacionadas/nueva', 'cyb\ChequeController@relacion')->name('relacionadas.crear')->middleware(['auth', 'can:crear cyb/bancos/transferencias/relacionadas']);
Route::post('cyb/bancos/transferencias/relacionadas/crearnueva', 'cyb\ChequeController@storerelacion')->name('relacionadas.guardar')->middleware(['auth', 'can:crear cyb/bancos/transferencias/relacionadas']);
Route::get('cyb/bancos/transferencias/filtro/{id}', 'cyb\ChequeController@getCuenta')->name('relacionadas.filtro');
Route::get('cyb/bancos/transferencias/relacionadas/nuevade', 'cyb\ChequeController@derelacion')->name('derelacionadas.crear')->middleware(['auth', 'can:crear cyb/bancos/transferencias/relacionadas']);
Route::post('cyb/bancos/transferencias/relacionadas/crearnuevade', 'cyb\ChequeController@storederel')->name('derelacionadas.guardar')->middleware(['auth', 'can:crear cyb/bancos/transferencias/relacionadas']);
Route::get('cyb/bancos/transferencias/relacionadas/index', 'cyb\ChequeController@indexderel')->name('derelacionadas')->middleware(['auth', 'can:ver cyb/bancos/transferencias/relacionadas']);


//debitos
Route::get('cyb/bancos/debitos', 'cyb\TransaccionesController@indexdeb')->name('debito')->middleware(['auth', 'can:ver cyb/bancos/debitos']);
Route::get('cyb/bancos/debitos/crear', 'cyb\TransaccionesController@createdeb')->name('debito.crear')->middleware(['auth', 'can:crear cyb/bancos/debitos']);
Route::post('cyb/bancos/debitos', 'cyb\TransaccionesController@storedeb')->name('debito.guardar')->middleware(['auth', 'can:crear cyb/bancos/debitos']);

//creditos
Route::get('cyb/bancos/creditos', 'cyb\TransaccionesController@indexcre')->name('credito')->middleware(['auth', 'can:ver cyb/bancos/creditos']);
Route::get('cyb/bancos/creditos/crear', 'cyb\TransaccionesController@createcre')->name('credito.crear')->middleware(['auth', 'can:crear cyb/bancos/creditos']);
Route::post('cyb/bancos/creditos', 'cyb\TransaccionesController@storecre')->name('credito.guardar')->middleware(['auth', 'can:crear cyb/bancos/creditos']);

//conciliaciones
Route::get('cyb/bancos/conciliaciones', 'cyb\ConciliacionesController@index')->name('conciliaciones')->middleware(['auth', 'can:ver cyb/bancos/conciliaciones']);
Route::get('cyb/bancos/conciliaciones/crear', 'cyb\ConciliacionesController@create')->name('conciliaciones.crear')->middleware(['auth', 'can:crear cyb/bancos/conciliaciones']);
Route::post('cyb/bancos/conciliaciones/generar/{id}', 'cyb\TransaccionesController@generarConciliacion')->name('conciliaciones.import')->middleware(['auth', 'can:crear cyb/bancos/conciliaciones']);
Route::get('cyb/bancos/autorizacion/autorizar/{transaccion}/{cambiar}', 'cyb\TransaccionesController@autorizar')->name('conciliaciones.autorizar')->middleware(['auth', 'can:crear cyb/bancos/conciliaciones']);
Route::get('cyb/bancos/conciliaciones/PDF', 'cyb\PDFController@conciliadospdf')->name('liquidpdf')->middleware(['auth', 'can:ver cyb/bancos/autorizacion']);
Route::get('cyb/bancos/conciliaciones/sin-excel/{id}', 'cyb\TransaccionesController@validarSinExcel')->name('conciliaciones.autorizarsinexel')->middleware(['auth', 'can:ver cyb/bancos/conciliaciones']);
Route::post('cyb/bancos/conciliaciones/crear/nuevo', 'cyb\ConciliacionesController@store')->name('conciliaciones.guardar')->middleware(['auth']);
Route::get('cyb/bancos/conciliaciones/filtro/{id}', 'cyb\ConciliacionesController@getCuenta')->name('conciliaciones.filtro')->middleware(['auth']);
Route::get('cyb/bancos/conciliaciones/generar/conciliacion/{id}', 'cyb\TransaccionesController@createConcilacion')->name('conciliaciones.generarExcel')->middleware(['auth']);
Route::get('cyb/bancos/conciliaciones/conciliar/{conciliacion}/{cambiar}', 'cyb\ConciliacionesController@ConciConciliar')->name('conciliar.estado')->middleware(['auth', 'can:ver cyb/bancos/conciliaciones']);
Route::get('cyb/bancos/conciliaciones/detalles/{id}', 'cyb\ConciliacionesController@DetallesConciliacion')->name('detallesdeconciliaciones')->middleware(['auth', 'can:ver cyb/bancos/conciliaciones']);




Route::get('prueba/{data?}/{tipo}', 'cyb\ChequePDFController@pdfCheque')->name('pdfcheque')->middleware(['auth']);
Route::get('cyb/bancos/transferencias/a-terceros/{id}', 'cyb\ChequeController@destroyCHTB' )->name('eliminarTranferencias')->middleware(['auth', 'can:eliminar cyb/bancos/transferencias/a-terceros']);



//Contabilidad//Polizas
Route::get('contabilidad/poliza','Contabilidad\PolizaController@index')->name('poliza')->middleware(['auth','can:ver contabilidad/poliza']);
Route::get('contabilidad/poliza/crear','Contabilidad\PolizaController@create')->name('poliza.crear')->middleware(['auth','can:crear contabilidad/poliza']);
Route::post('contabilidad/poliza','Contabilidad\PolizaController@store')->name('poliza.guardar')->middleware(['auth','can:crear contabilidad/poliza']);
Route::get('contabilidad/poliza/{id}/editar','Contabilidad\PolizaController@edit')->name('poliza.editar')->middleware(['auth','can:actualizar contabilidad/poliza']);
Route::put('contabilidad/polizas/{id}','Contabilidad\PolizaController@update')->name('poliza.actualizar')->middleware(['auth','can:actualizar contabilidad/polizas']);
Route::get('contabilidad/poliza/{id}/eliminar','Contabilidad\PolizaController@destroy')->name('poliza.eliminar')->middleware(['auth','can:eliminar contabilidad/poliza']);



?>
