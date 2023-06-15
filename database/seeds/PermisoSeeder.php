<?php

use App\Models\Admin\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = Menu::where('men_url', '!=', '#')->get();
        foreach ($menus as $menu) {
            $existe = Count(Permission::where('name','ver ' . $menu['men_url'])->get());
            if ($existe == 0) {
                Permission::create(['name' => 'ver ' . $menu['men_url']]);
                Permission::create(['name' => 'crear ' . $menu['men_url']]);
                Permission::create(['name' => 'actualizar ' . $menu['men_url']]);
                Permission::create(['name' => 'eliminar ' . $menu['men_url']]);
            }
        }
    }
}
