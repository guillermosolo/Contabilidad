<?php

namespace App\Rules\CajaBancos;

use App\Models\cyb\DetalleLiquidacionCC;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ValidarDocumento implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $repetido = false;

    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value != "") {
            if (request()->dlcc_tipodoc == 'F') {
                $fecha = Carbon::parse(Carbon::createFromFormat('d/m/Y', request()->dlcc_fecha));
                $detalleActual = DetalleLiquidacionCC::where($attribute, $value)->where('dlcc_terminal',request()->dlcc_terminal)
                    ->where('dlcc_fecha',$fecha->format('Y-m-d'))
                    ->orderBy('dlcc_id','desc')->first();
                $detallePasado = DetalleLiquidacionCC::where($attribute, $value)->where('dlcc_terminal',request()->dlcc_terminal)
                    ->where('dlcc_fecha',$fecha->subMonth()->format('Y-m-d'))
                    ->orderBy('dlcc_id','desc')->first();
                if ($detallePasado||$detalleActual) {

                    if ($detalleActual->dlcc_status == "R"||$detallePasado== "R") {
                        $this->repetido = false;
                        return true;
                    }else{
                        $this->repetido = true;
                        return false;
                    }
                }
            }
        } else {
            return false;
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
        if ($this->repetido) {
            return 'El <strong>No Documento </strong> Ya esta registado.';
        } else {
            return 'El <strong>No Documento </strong> Es requerido.';
        }
    }
}
