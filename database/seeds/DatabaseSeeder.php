<?php

use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MenuSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(DepMunSeeder::class);
        $this->call(TerminalSeeder::class);
        $this->call(MonedaSeeder::class);
        $this->call(RegimenSeeder::class);
        $this->call(PaisesSeeder::class);
        $this->call(DiscapacidadSeeder::class);
        $this->call(IdiomasSeeder::class);
        $this->call(PuebloSeeder::class);
        $this->call(CertificadorSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(OperacionSeeder::class);
        $this->call(AcademicoSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(CentroCostoSeeder::class);
        $this->call(CuentaContableSeeder::class);
        $this->call(BancosSeeder::class);
        $this->call(TipoRepresentanteSeeder::class);
        $this->call(TipoPersonaSeeder::class);
        $this->call(TipoContribuyenteSeeder::class);
        $this->call(StatusActivosSeeder::class);
        $this->call(PropiedadesSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(TipoCombustibleSeeder::class);
        $this->call(TipoCuentaBancariaSeeder::class);
        $this->call(TipoCompraSeeder::class);
        $this->call(RepresentanteSeeder::class);
        $this->call(RepresentacionSeeder::class);
        $this->call(ConceptosSeeder::class);
        $this->call(ProductosSeeder::class);
        $this->call(TipoPagoSeeder::class);
        $this->call(CorrelativoSeeder::class);
        $this->call(TipoDescSeeder::class);
        $this->call(ParametrizadasSeeder::class);
        $this->call(TipoRetencionSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ClienteSeeder::class);
    }
}
