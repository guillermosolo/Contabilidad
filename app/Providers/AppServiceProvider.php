<?php

namespace App\Providers;

use App\Models\Admin\Menu;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use \NumberFormatter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layout.aside', function ($view) {
            $menus = Menu::getMenu();
            $view->with('menusComposer', $menus);
        });
        Str::macro('percent', function ($percent) {
            return (number_format($percent * 100, 2, '.', ',') . ' %');
        });
        Str::macro('nit', function ($nit) {
            if ($nit == '') {
                return '';
            } else {
                return (substr($nit, -strlen($nit), strlen($nit) - 1) . '-' . substr($nit, -1));
            }
        });
        Str::macro('money', function ($money,$prefijo) {
           return ($prefijo . number_format($money, 2, '.', ','));
        });
        Str::macro('decimal', function ($decimal) {
            return(number_format($decimal,2,'.',','));
        });
        Str::macro('nombreMes', function ($mes){
            $meses = ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
            return $meses[$mes -1];
        });
    }
}
