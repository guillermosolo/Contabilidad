<?php

namespace App\Rules\Empleados;

use App\Models\Planilla\Empleado;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidarNitEmpleado implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $empleado;


    public function __construct($emp)
    {
        $this->empleado = $emp;
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
        if ($value!="CF"){
            $data = Empleado::where('empl_NIT',$value)->first();
            if ($data&&$data->empl_id!=$this->empleado){
               return false;
           }else{
               return true;
           }
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
        return 'El <strong>NIT</strong> ya se encuentra registrado.';
    }
}
