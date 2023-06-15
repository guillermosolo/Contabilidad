<?php

namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidarCampoMovBan implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
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
        $movimientos = DB::table('movimientobancario')
                       ->join('cuentacontable','movb_cuentacontable','=','cta_id')
                       ->where($attribute,$value)
                       ->where('movb_id','!=',request()->route('id'))
                       ->where('cta_empresa','=',request()->empresa)
                       ->get();
        return $movimientos->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo <strong>nombre</strong> ya existe en esa empresa.';
    }
}
