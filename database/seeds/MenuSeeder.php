<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            [
                'men_id'=>1,
                'men_padre' => 0,
                'men_nombre' => 'Parámetros de Empresas',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-cog',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>2,
                'men_padre' => 1,
                'men_nombre' => 'Empresas',
                'men_url' => 'parametros/empresa',
                'men_orden' => 1,
                'men_icono' => 'fas fa-city',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>3,
                'men_padre' => 1,
                'men_nombre' => 'Usuarios',
                'men_url' => 'parametros/usuario',
                'men_orden' => 2,
                'men_icono' => 'fas fa-users',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>4,
                'men_padre' => 0,
                'men_nombre' => 'Caja y Bancos',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-money-bill-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>5,
                'men_padre' => 4,
                'men_nombre' => 'Caja Chica',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-cash-register',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>6,
                'men_padre' => 5,
                'men_nombre' => 'Responsable',
                'men_url' => 'cyb/cajas/responsables',
                'men_orden' => 1,
                'men_icono' => 'fas fa-user-check',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>7,
                'men_padre' => 5,
                'men_nombre' => 'Liquidación',
                'men_url' => 'cyb/cajas/liquidaciones',
                'men_orden' => 2,
                'men_icono' => 'fas fa-coins',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>8,
                'men_padre' => 5,
                'men_nombre' => 'Autorización',
                'men_url' => 'cyb/bancos/autorizacion',
                'men_orden' => 3,
                'men_icono' => 'fas fa-clipboard-check',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>9,
                'men_padre' => 4,
                'men_nombre' => 'Bancos',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-piggy-bank',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>10,
                'men_padre' => 9,
                'men_nombre' => 'Cuentas Bancarias',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-money-check-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>11,
                'men_padre' => 10,
                'men_nombre' => 'Apertura de cuentas',
                'men_url' => 'cyb/bancos/cuentasbancarias',
                'men_orden' => 1,
                'men_icono' => 'fas fa-credit-card',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>12,
                'men_padre' => 10,
                'men_nombre' => 'Impresión de Catálogos',
                'men_url' => 'cyb/bancos/catalogo',
                'men_orden' => 2,
                'men_icono' => 'fas fa-print',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>13,
                'men_padre' => 9,
                'men_nombre' => 'Anticipos',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-money-check',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>14,
                'men_padre' => 13,
                'men_nombre' => 'Crear',
                'men_url' => 'cyb/bancos/anticipos/crear',
                'men_orden' => 1,
                'men_icono' => 'fas fa-folder-plus',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>15,
                'men_padre' => 13,
                'men_nombre' => 'Liquidar',
                'men_url' => 'cyb/bancos/anticipos/liquidar',
                'men_orden' => 2,
                'men_icono' => 'fas fa-folder-minus',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>16,
                'men_padre' => 9,
                'men_nombre' => 'Transferencias',
                'men_url' => '#',
                'men_orden' => 3,
                'men_icono' => 'fas fa-exchange-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>17,
                'men_padre' => 16,
                'men_nombre' => 'Internas',
                'men_url' => 'cyb/bancos/transferencias/internas',
                'men_orden' => 1,
                'men_icono' => 'fas fa-compress-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>18,
                'men_padre' => 16,
                'men_nombre' => 'A/De Relacionadas',
                'men_url' => 'cyb/bancos/transferencias/relacionadas',
                'men_orden' => 2,
                'men_icono' => 'fas fa-people-arrows',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>19,
                'men_padre' => 16,
                'men_nombre' => 'De Terceros',
                'men_url' => 'cyb/bancos/transferencias/de-terceros',
                'men_orden' => 3,
                'men_icono' => 'fas fa-arrow-left',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>20,
                'men_padre' => 16,
                'men_nombre' => 'A Terceros',
                'men_url' => 'cyb/bancos/transferencias/a-terceros',
                'men_orden' => 4,
                'men_icono' => 'fas fa-arrow-right',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>21,
                'men_padre' => 9,
                'men_nombre' => 'Conciliación Bancaria',
                'men_url' => '#',
                'men_orden' => 4,
                'men_icono' => 'fas fa-clipboard-list',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>22,
                'men_padre' => 21,
                'men_nombre' => 'Débitos',
                'men_url' => 'cyb/bancos/debitos',
                'men_orden' => 1,
                'men_icono' => 'fas fa-hand-holding-usd',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>23,
                'men_padre' => 21,
                'men_nombre' => 'Créditos',
                'men_url' => 'cyb/bancos/creditos',
                'men_orden' => 2,
                'men_icono' => 'fas fa-file-invoice-dollar',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>24,
                'men_padre' => 21,
                'men_nombre' => 'Conciliación',
                'men_url' => 'cyb/bancos/conciliaciones',
                'men_orden' => 3,
                'men_icono' => 'fas fa-clipboard-list',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>25,
                'men_padre' => 0,
                'men_nombre' => 'Cuentas por Cobrar',
                'men_url' => '#',
                'men_orden' => 3,
                'men_icono' => 'fas fa-file-invoice',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>26,
                'men_padre' => 25,
                'men_nombre' => 'Clientes',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-user-tag',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>27,
                'men_padre' => 26,
                'men_nombre' => 'Catálogo de Clientes',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-print',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>28,
                'men_padre' => 27,
                'men_nombre' => 'General',
                'men_url' => 'cxc/clientes',
                'men_orden' => 1,
                'men_icono' => 'fas fa-id-card',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>29,
                'men_padre' => 27,
                'men_nombre' => 'Por Empresa',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-address-card',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>30,
                'men_padre' => 25,
                'men_nombre' => 'Ventas',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-shopping-basket',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>31,
                'men_padre' => 30,
                'men_nombre' => 'Orden de Facturación',
                'men_url' => 'cxc/ventas/ordenfacturacion',
                'men_orden' => 1,
                'men_icono' => 'fas fa-file-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>32,
                'men_padre' => 30,
                'men_nombre' => 'Facturación',
                'men_url' => 'cxc/ventas/facturacion',
                'men_orden' => 2,
                'men_icono' => 'fas fa-file-invoice',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>33,
                'men_padre' => 30,
                'men_nombre' => 'Documentos',
                'men_url' => '#',
                'men_orden' => 3,
                'men_icono' => 'fas fa-file',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>34,
                'men_padre' => 33,
                'men_nombre' => 'Nota de Crédito',
                'men_url' => 'cxc/ventas/documentos/ncredito',
                'men_orden' => 1,
                'men_icono' => 'fas fa-file-upload',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>35,
                'men_padre' => 33,
                'men_nombre' => 'Nota de Débito',
                'men_url' => 'cxc/ventas/documentos/ndebito',
                'men_orden' => 2,
                'men_icono' => 'fas fa-file-download',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>36,
                'men_padre' => 33,
                'men_nombre' => 'Nota de Abono',
                'men_url' => 'cxc/ventas/documentos/nabono',
                'men_orden' => 3,
                'men_icono' => 'fas fa-receipt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>37,
                'men_padre' => 30,
                'men_nombre' => 'Cobros',
                'men_url' => '#',
                'men_orden' => 4,
                'men_icono' => 'fas fa-money-bill-wave',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>38,
                'men_padre' => 30,
                'men_nombre' => 'Reportes',
                'men_url' => '#',
                'men_orden' => 5,
                'men_icono' => 'fas fa-print',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>39,
                'men_padre' => 38,
                'men_nombre' => 'Facturas Emitidas',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-file-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>40,
                'men_padre' => 38,
                'men_nombre' => 'Facturas Por Artículo',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'far fa-file-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>41,
                'men_padre' => 38,
                'men_nombre' => 'Resumen de Clientes',
                'men_url' => '#',
                'men_orden' => 3,
                'men_icono' => 'fas fa-user-tag',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>42,
                'men_padre' => 38,
                'men_nombre' => 'Pendientes de Cobro',
                'men_url' => '#',
                'men_orden' => 4,
                'men_icono' => 'fas fa-file-invoice-dollar',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>43,
                'men_padre' => 0,
                'men_nombre' => 'Cuentas por Pagar',
                'men_url' => '#',
                'men_orden' => 4,
                'men_icono' => 'fas fa-file-invoice-dollar',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>44,
                'men_padre' => 43,
                'men_nombre' => 'Proveedores',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-user-tie',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>45,
                'men_padre' => 44,
                'men_nombre' => 'Catálogo de Proveedores',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-print',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>46,
                'men_padre' => 45,
                'men_nombre' => 'General',
                'men_url' => 'cxp/proveedores',
                'men_orden' => 1,
                'men_icono' => 'fas fa-id-card',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>47,
                'men_padre' => 45,
                'men_nombre' => 'Por Empresa',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-address-card',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>48,
                'men_padre' => 44,
                'men_nombre' => 'Facturas de Compras',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-file-invoice-dollar',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>49,
                'men_padre' => 48,
                'men_nombre' => 'Compras y Servicios',
                'men_url' => 'cxp/facturas',
                'men_orden' => 1,
                'men_icono' => 'fas fa-shopping-cart',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>50,
                'men_padre' => 48,
                'men_nombre' => 'Póliza de Importación',
                'men_url' => 'cxp/importacion',
                'men_orden' => 2,
                'men_icono' => 'fas fa-file-invoice',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>51,
                'men_padre' => 48,
                'men_nombre' => 'Recibo',
                'men_url' => 'cxp/recibos',
                'men_orden' => 3,
                'men_icono' => 'fas fa-receipt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>52,
                'men_padre' => 44,
                'men_nombre' => 'Reportes',
                'men_url' => '#',
                'men_orden' => 3,
                'men_icono' => 'fas fa-print',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>53,
                'men_padre' => 52,
                'men_nombre' => 'Documentos Recibidos',
                'men_url' => 'cxp/reportes/recibidos',
                'men_orden' => 1,
                'men_icono' => 'fas fa-file-import',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>54,
                'men_padre' => 52,
                'men_nombre' => 'Resumen de Proveedores',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-user-tie',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>55,
                'men_padre' => 52,
                'men_nombre' => 'Estado de Cuenta de Proveedor',
                'men_url' => '#',
                'men_orden' => 3,
                'men_icono' => 'fas fa-file-invoice',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>56,
                'men_padre' => 52,
                'men_nombre' => 'Pendientes de Pago',
                'men_url' => '#',
                'men_orden' => 4,
                'men_icono' => 'fas fa-file-invoice-dollar',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>57,
                'men_padre' => 0,
                'men_nombre' => 'Activos, Depreciaciones y Amortizaciones',
                'men_url' => '#',
                'men_orden' => 5,
                'men_icono' => 'fas fa-laptop-house',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],/* [
                'men_id'=>58,
                'men_padre' => 57,
                'men_nombre' => 'Categorías',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-indent',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], */[
                'men_id'=>59,
                'men_padre' => 57,
                'men_nombre' => 'Activos',
                'men_url' => 'activos/activo',
                'men_orden' => 2,
                'men_icono' => 'fas fa-home',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>60,
                'men_padre' => 57,
                'men_nombre' => 'Depreciaciones',
                'men_url' => 'activos/depreciacion',
                'men_orden' => 3,
                'men_icono' => 'fas fa-sort-numeric-down-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>61,
                'men_padre' => 57,
                'men_nombre' => 'Amortizaciones',
                'men_url' => 'activos/amortizacion',
                'men_orden' => 4,
                'men_icono' => 'fas fa-sort-amount-down-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>62,
                'men_padre' => 57,
                'men_nombre' => 'Reportes',
                'men_url' => '#',
                'men_orden' => 5,
                'men_icono' => 'fas fa-print',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>63,
                'men_padre' => 62,
                'men_nombre' => 'Tabla de Depreciaciones',
                'men_url' => '',
                'men_orden' => 1,
                'men_icono' => 'fas fa-table',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>64,
                'men_padre' => 62,
                'men_nombre' => 'Tabla de Amortizaciones',
                'men_url' => '',
                'men_orden' => 2,
                'men_icono' => 'fas fa-table',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>65,
                'men_padre' => 62,
                'men_nombre' => 'Gastos por Activos',
                'men_url' => '',
                'men_orden' => 3,
                'men_icono' => 'fas fa-wrench',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>66,
                'men_padre' => 0,
                'men_nombre' => 'Planillas',
                'men_url' => '#',
                'men_orden' => 6,
                'men_icono' => 'fas fa-address-card',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>67,
                'men_padre' => 66,
                'men_nombre' => 'Catálogo de Empleados',
                'men_url' => 'planillas/empleados',
                'men_orden' => 1,
                'men_icono' => 'fas fa-restroom',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'men_id'=>68,
                'men_padre' => 66,
                'men_nombre' => 'Generación de Planillas',
                'men_url' => 'planillas/generacion',
                'men_orden' => 2,
                'men_icono' => 'fas fa-cogs',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'men_id'=>125,
                'men_padre' => 68,
                'men_nombre' => 'Planilla Mensual',
                'men_url' => 'planillas/generacion/mensual',
                'men_orden' => 1,
                'men_icono' => 'fas fa-calendar-times',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'men_id'=>126,
                'men_padre' => 68,
                'men_nombre' => 'Planilla Eventual',
                'men_url' => 'planillas/generacion/eventual',
                'men_orden' => 2,
                'men_icono' => 'fas fa-money-bill-wave',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'men_id'=>127,
                'men_padre' => 68,
                'men_nombre' => 'Planilla Especial',
                'men_url' => 'planillas/generacion/especial',
                'men_orden' => 3,
                'men_icono' => 'fas fa-money-check-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'men_id'=>128,
                'men_padre' => 66,
                'men_nombre' => 'Bonificaciones',
                'men_url' => 'planillas/bonificaciones',
                'men_orden' => 3,
                'men_icono' => 'fas fa-money-bill-wave',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'men_id'=>129,
                'men_padre' => 66,
                'men_nombre' => 'Descuentos',
                'men_url' => 'planillas/descuentos',
                'men_orden' => 4,
                'men_icono' => 'fas fa-file-invoice',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'men_id'=>130,
                'men_padre' => 66,
                'men_nombre' => 'Tipo Bonificacion o Descuento',
                'men_url' => 'planillas/tipo-descuentos',
                'men_orden' => 5,
                'men_icono' => 'fas fa-bars',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'men_id'=>69,
                'men_padre' => 66,
                'men_nombre' => 'Prestaciones Laborales',
                'men_url' => 'planillas/prestaciones-laboral',
                'men_orden' => 6,
                'men_icono' => 'fas fa-coins',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'men_id'=>70,
                'men_padre' => 66,
                'men_nombre' => 'Reportes',
                'men_url' => '#',
                'men_orden' => 7,
                'men_icono' => 'fas fa-print',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>71,
                'men_padre' => 70,
                'men_nombre' => 'Planilla IGSS',
                'men_url' => 'planillas/reportes/planilla-igss',
                'men_orden' => 1,
                'men_icono' => 'fas fa-file-medical',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>72,
                'men_padre' => 70,
                'men_nombre' => 'Reporte Estadístico',
                'men_url' => 'planillas/reportes/reportes-estadistico',
                'men_orden' => 2,
                'men_icono' => 'fas fa-chart-area',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>73,
                'men_padre' => 70,
                'men_nombre' => 'Libro de Salarios',
                'men_url' => 'planillas/reportes/libro-salarios',
                'men_orden' => 3,
                'men_icono' => 'fas fa-book-open',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>74,
                'men_padre' => 0,
                'men_nombre' => 'Contabilidad',
                'men_url' => '#',
                'men_orden' => 7,
                'men_icono' => 'fas fa-book',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>75,
                'men_padre' => 74,
                'men_nombre' => 'Catálogo de Cuentas Contables',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-stream',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>76,
                'men_padre' => 74,
                'men_nombre' => 'Libro Diario',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-feather-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>77,
                'men_padre' => 76,
                'men_nombre' => 'Póliza Manual',
                'men_url' => 'contabilidad/poliza',
                'men_orden' => 1,
                'men_icono' => 'fas fa-file-signature',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>78,
                'men_padre' => 76,
                'men_nombre' => 'Partida de Cierre',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-window-close',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>79,
                'men_padre' => 76,
                'men_nombre' => 'Regularización de IVA',
                'men_url' => '#',
                'men_orden' => 3,
                'men_icono' => 'fas fa-balance-scale-right',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>80,
                'men_padre' => 76,
                'men_nombre' => 'Regularización Relacionadas',
                'men_url' => '#',
                'men_orden' => 4,
                'men_icono' => 'fas fa-balance-scale-left',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>81,
                'men_padre' => 76,
                'men_nombre' => 'Póliza de Reserva Legal',
                'men_url' => '#',
                'men_orden' => 5,
                'men_icono' => 'fas fa-file-code',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>82,
                'men_padre' => 76,
                'men_nombre' => 'Cálculo de ISR',
                'men_url' => '#',
                'men_orden' => 6,
                'men_icono' => 'far fa-file-code',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>83,
                'men_padre' => 74,
                'men_nombre' => 'Libro Mayor',
                'men_url' => '#',
                'men_orden' => 3,
                'men_icono' => 'fas fa-comment-dollar',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>84,
                'men_padre' => 74,
                'men_nombre' => 'Balance de Comprobación',
                'men_url' => '#',
                'men_orden' => 4,
                'men_icono' => 'fas fa-balance-scale',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>85,
                'men_padre' => 74,
                'men_nombre' => 'Balance General',
                'men_url' => '#',
                'men_orden' => 5,
                'men_icono' => 'fas fa-poll-h',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>86,
                'men_padre' => 74,
                'men_nombre' => 'Estado de Resultados',
                'men_url' => '#',
                'men_orden' => 6,
                'men_icono' => 'fas fa-poll',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>87,
                'men_padre' => 74,
                'men_nombre' => 'Flujo de Efectivo',
                'men_url' => '#',
                'men_orden' => 7,
                'men_icono' => 'fas fa-money-bill-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>88,
                'men_padre' => 74,
                'men_nombre' => 'Razones Financieras',
                'men_url' => '#',
                'men_orden' => 8,
                'men_icono' => 'far fa-money-bill-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>89,
                'men_padre' => 74,
                'men_nombre' => 'Reportes',
                'men_url' => '#',
                'men_orden' => 9,
                'men_icono' => 'fas fa-print',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>90,
                'men_padre' => 89,
                'men_nombre' => 'Libro de Compras',
                'men_url' => '#',
                'men_orden' => 1,
                'men_icono' => 'fas fa-file-download',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>91,
                'men_padre' => 89,
                'men_nombre' => 'Libro de Ventas',
                'men_url' => '#',
                'men_orden' => 2,
                'men_icono' => 'fas fa-file-upload',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>92,
                'men_padre' => 89,
                'men_nombre' => 'Formulario IVA',
                'men_url' => '#',
                'men_orden' => 3,
                'men_icono' => 'fas fa-file-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>93,
                'men_padre' => 89,
                'men_nombre' => 'Formulario Retenciones',
                'men_url' => '#',
                'men_orden' => 4,
                'men_icono' => 'far fa-file-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>94,
                'men_padre' => 89,
                'men_nombre' => 'Formulario ISO',
                'men_url' => '#',
                'men_orden' => 5,
                'men_icono' => 'fas fa-file',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>95,
                'men_padre' => 89,
                'men_nombre' => 'Formulario Trimestral',
                'men_url' => '#',
                'men_orden' => 6,
                'men_icono' => 'fas fa-calendar-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>96,
                'men_padre' => 89,
                'men_nombre' => 'Formulario Anual',
                'men_url' => '#',
                'men_orden' => 7,
                'men_icono' => 'far fa-calendar-alt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>97,
                'men_padre' => 0,
                'men_nombre' => 'Almacenes',
                'men_url' => '#',
                'men_orden' => 8,
                'men_icono' => 'fas fa-warehouse',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'men_id'=>98,
                'men_padre' => 1,
                'men_nombre' => 'Roles',
                'men_url' => 'parametros/rol',
                'men_orden' => 3,
                'men_icono' => 'fas fa-tasks',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [  //99
                'men_id'=>99,
                'men_padre' => 0,
                'men_nombre' => 'Administración',
                'men_url' => '#',
                'men_orden' => 0,
                'men_icono' => 'fas fa-tools',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ // 100
                'men_id'=>100,
                'men_padre' => 99,
                'men_nombre' => 'Tablas Maestras',
                'men_url' => '#',
                'men_orden' => 0,
                'men_icono' => 'fas fa-toolbox',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ // 101
                'men_id'=>101,
                'men_padre' => 1,
                'men_nombre' => 'Terminales',
                'men_url' => 'parametros/terminal',
                'men_orden' => 3,
                'men_icono' => 'fas fa-boxes',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //102
                'men_id'=>102,
                'men_padre' => 100,
                'men_nombre' => 'Moneda',
                'men_url' => 'admin/moneda',
                'men_orden' => 1,
                'men_icono' => 'fas fa-dollar-sign',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //103
                'men_id'=>103,
                'men_padre' => 100,
                'men_nombre' => 'Régimen',
                'men_url' => 'admin/regimen',
                'men_orden' => 2,
                'men_icono' => 'fas fa-coins',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //104
                'men_id'=>104,
                'men_padre' => 100,
                'men_nombre' => 'Tipo de Representante',
                'men_url' => 'admin/tiposrepresentante',
                'men_orden' => 3,
                'men_icono' => 'fas fa-users-cog',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //105
                'men_id'=>105,
                'men_padre' => 100,
                'men_nombre' => 'Certificador',
                'men_url' => 'admin/certificador',
                'men_orden' => 4,
                'men_icono' => 'fas fa-certificate',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //106
                'men_id'=>106,
                'men_padre' => 100,
                'men_nombre' => 'Banco',
                'men_url' => 'admin/bancos',
                'men_orden' => 5,
                'men_icono' => 'fas fa-money-bill-wave',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')

            ], [ //107
                'men_id'=>107,
                'men_padre' => 100,
                'men_nombre' => 'Tipo de Combustible',
                'men_url' => 'admin/tipocombustible',
                'men_orden' => 6,
                'men_icono' => 'fas fa-gas-pump',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //108
                'men_id'=>108,
                'men_padre' => 100,
                'men_nombre' => 'Representantes y Contadores',
                'men_url' => 'admin/representante',
                'men_orden' => 7,
                'men_icono' => 'fas fa-user-tie',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //109
                'men_id'=>109,
                'men_padre' => 100,
                'men_nombre' => 'Firmante',
                'men_url' => 'admin/firmante',
                'men_orden' => 8,
                'men_icono' => 'fas fa-file-signature',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //110
                'men_id'=>110,
                'men_padre' => 100,
                'men_nombre' => 'Tipo de Cliente/Proveedor',
                'men_url' => 'admin/tipopersona',
                'men_orden' => 9,
                'men_icono' => 'fas fa-user-tag',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //111
                'men_id'=>111,
                'men_padre' => 100,
                'men_nombre' => 'Tipo de Contribuyente',
                'men_url' => 'admin/tipocontribuyente',
                'men_orden' => 10,
                'men_icono' => 'fas fa-people-arrows',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //112
                'men_id'=>112,
                'men_padre' => 100,
                'men_nombre' => 'Movimientos',
                'men_url' => 'admin/movimientobancario',
                'men_orden' => 11,
                'men_icono' => 'fas fa-receipt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //113
                'men_id'=>113,
                'men_padre' => 100,
                'men_nombre' => 'Tipo de Pago',
                'men_url' => 'admin/tipopago',
                'men_orden' => 12,
                'men_icono' => 'fas fa-shopping-bag',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //114
                'men_id'=>114,
                'men_padre' => 100,
                'men_nombre' => 'Tipo de Compra',
                'men_url' => 'admin/tipocompra',
                'men_orden' => 13,
                'men_icono' => 'fas fa-shopping-cart',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //115
                'men_id'=>115,
                'men_padre' => 100,
                'men_nombre' => 'Categoría',
                'men_url' => 'admin/categoria',
                'men_orden' => 14,
                'men_icono' => 'fas fa-archive',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //116
                'men_id'=>116,
                'men_padre' => 100,
                'men_nombre' => 'Status de Activo',
                'men_url' => 'admin/statusactivos',
                'men_orden' => 15,
                'men_icono' => 'fas fa-check-square',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //117
                'men_id'=>117,
                'men_padre' => 100,
                'men_nombre' => 'Propiedad',
                'men_url' => 'admin/propiedad',
                'men_orden' => 16,
                'men_icono' => 'fas fa-cogs',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //118
                'men_id'=>118,
                'men_padre' => 100,
                'men_nombre' => 'País',
                'men_url' => 'admin/paises',
                'men_orden' => 17,
                'men_icono' => 'fas fa-globe-americas',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //119
                'men_id'=>119,
                'men_padre' => 100,
                'men_nombre' => 'Pueblo',
                'men_url' => 'admin/pueblo',
                'men_orden' => 18,
                'men_icono' => 'fas fa-building',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //120
                'men_id'=>120,
                'men_padre' => 100,
                'men_nombre' => 'Nivel Académico',
                'men_url' => 'admin/academico',
                'men_orden' => 19,
                'men_icono' => 'fas fa-graduation-cap',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [ //121
                'men_id'=>121,
                'men_padre' => 100,
                'men_nombre' => 'Discapacidad',
                'men_url' => 'admin/discapacidad',
                'men_orden' => 20,
                'men_icono' => 'fas fa-wheelchair',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[ //122
                'men_id'=>122,
                'men_padre' => 100,
                'men_nombre' => 'Idioma',
                'men_url' => 'admin/idioma',
                'men_orden' => 21,
                'men_icono' => 'fas fa-language',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[//123
                'men_id'=>123,
                'men_padre' => 25,
                'men_nombre' => 'Productos',
                'men_url' => 'cxc/productos',
                'men_orden' => 3,
                'men_icono' => 'fas fa-truck-loading',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [//124
                'men_id'=>124,
                'men_padre' => 33,
                'men_nombre' => 'Retenciones IVA',
                'men_url' => 'cxc/ventas/documentos/retencionIVA',
                'men_orden' => 3,
                'men_icono' => 'fas fa-file-prescription',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[//125
                'men_id'=>125,
                'men_padre' => 33,
                'men_nombre' => 'Retenciones ISR',
                'men_url' => 'cxc/ventas/documentos/retencion',
                'men_orden' => 3,
                'men_icono' => 'fas fa-file-contract',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
//      130 es el men_id utilizado en el utimo menu agregado a planillas
        ]);
        DB::table('menu')->where('men_id', 97)->update(['men_deshabilitado' => 1]);
        DB::table('menu')->where('men_id', 69)->update(['men_deshabilitado' => 1]);
    }
}
