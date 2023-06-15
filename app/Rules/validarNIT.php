<?php

namespace App\Rules;

use App\Models\Admin\Persona;
use App\Models\Planilla\Empleado;
use Exception;
use Illuminate\Contracts\Validation\Rule;

class validarNIT implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $repetido = 0;

    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value != "CF") {
            if ($attribute == "per_nit") {
                if (request()->path()=="cxp/proveedores")
                    $persona = Persona::where($attribute, $value)->where('per_id', '!=', request()->pro_persona)->get();
                if (request()->path()=="cxc/clientes")
                    $persona = Persona::where($attribute, $value)->where('per_id', '!=', request()->cli_persona)->get();
                $this->repetido = 1;
            }
            if ($attribute == "empl_NIT") {
                $persona = Empleado::where($attribute, $value)->where('empl_id', '!=', request()->route('id'))->get();
                $this->repetido = 1;
            }
            try{
            if (!$persona->isempty())
                return false;}
                catch (Exception $e) {
                    return true;
                }
            $verificador = $value[strlen($value) - 1];
            if ($verificador == "K" || $verificador == "k")
                $numVerif = 10;
            else
                $numVerif = (int) $verificador;
            $invertidos = strrev(substr($value, 0, -1));
            $suma = 0;
            for ($i = 0; $i < strlen($invertidos); $i++) {
                $suma += $invertidos[$i] * ($i + 2);
            }
            $modulo = $suma % 11;
            $total = 11 - $modulo;
            $total = $total % 11;
            if ($total == $numVerif)
                return true;
            else
                return false;
        } else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->repetido == 0)
            return 'El <strong>NIT</strong> no es válido.';
        else
            return 'El <strong>NIT</strong> ya ha sido ingresado.';
    }
}
