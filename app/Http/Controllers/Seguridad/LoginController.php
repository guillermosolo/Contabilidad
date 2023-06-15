<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use hisorange\BrowserDetect\Parser as Browser;



class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('seguridad.index');
    }

    public function username()
    {
        return 'usu_nombre';
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->usu_activo) {
            if (Browser::isDesktop()) {
                $dispositivo = 'Laptop';
            }
            if (Browser::isTablet()) {
                $dispositivo = 'Tablet';
            }
            if (Browser::isMobile()) {
                $dispositivo = 'Celular';
            }
            activity('sesion')
                ->withProperties([
                    'explorador' => Browser::browserName(),
                    'ip' => $request->ip(),
                    'so' => Browser::platformName(),
                    'dispositivo' => $dispositivo
                ])
                ->log('login');
            $user->setSession();
        } else {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect('seguridad/login')->withErrors(['error' => 'El usuario no está activo.']);
        }
    }

    public function logout(Request $request)
    {

        if (Browser::isDesktop()) {
            $dispositivo = 'Laptop';
        }
        if (Browser::isTablet()) {
            $dispositivo = 'Tablet';
        }
        if (Browser::isMobile()) {
            $dispositivo = 'Celular';
        }
        activity('sesion')
            ->withProperties([
                'explorador' => Browser::browserName(),
                'ip' => $request->ip(),
                'so' => Browser::platformName(),
                'dispositivo' => $dispositivo
            ])
            ->log('logout');

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
