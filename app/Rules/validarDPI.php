<?php

namespace App\Rules;

use App\Models\Admin\Persona;
use App\Models\Planilla\Empleado;
use Illuminate\Contracts\Validation\Rule;

class validarDPI implements Rule
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
        if ($value != "") {
            if ($attribute == "per_cui") {
                if (request()->path()=="cxp/proveedores")
                    $persona = Persona::where($attribute, $value)->where('per_id', '!=', request()->pro_persona)->get();
                if (request()->path()=="cxc/clientes")
                    $persona = Persona::where($attribute, $value)->where('per_id', '!=', request()->cli_persona)->get();
                $this->repetido = 1;
            }
            if ($attribute == "empl_docID") {
                if (request()->empl_tipoDocID == 1){
                $persona = Empleado::where($attribute, $value)->where('empl_id', '!=', request()->route('id'))->get();
                $this->repetido = 1;
                } else {
                    return true;
                }
            }
            if (!$persona->isempty())
                return false;
            if (strlen($value) != 13)
                return false;
            $depto = intval(substr($value, 9, 2));
            $muni = intval(substr($value, 11, 2));
            $numero = substr($value, 0, 8);
            $comprobar = intval(substr($value, 8, 1));

            $munisxDepto = array(17, 8, 16, 16, 13, 14, 19, 8, 24, 21, 9, 30, 32, 21, 8, 17, 14, 5, 11, 11, 7, 17);

            if ($depto > count($munisxDepto))
                return false;
            if ($muni > $munisxDepto[$depto - 1])
                return false;

            $total = 0;
            for ($i = 0; $i < strlen($numero); $i++) {
                $total += $numero[$i] * ($i + 2);
            }

            $modulo = $total % 11;

            return $modulo == $comprobar;
        }
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
            return 'El <strong>CUI</strong> no es válido.';
        else
            return 'El <strong>CUI</strong> ya ha sido ingresado.';
    }
}
