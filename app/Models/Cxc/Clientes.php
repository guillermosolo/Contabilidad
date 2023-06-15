<?php

namespace App\Models\Cxc;

use App\Models\Admin\Persona;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Clientes extends Model
{
    use LogsActivity;

    protected $table = 'clientes';
    protected $fillable = ['cli_persona', 'cli_tipoCliente', 'cli_credito'];
    protected $guarded = 'cli_id';
    protected $primaryKey = 'cli_id';
    protected static $logName = 'clientes';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Persona()
    {
        return $this->belongsTo('App\Models\Admin\Persona', 'cli_persona', 'per_id');
    }

    public function TiposClientes()
    {
        return $this->belongsTo('App\Models\Admin\TipoPersona', 'cli_tipoCliente', 'tpp_id');
    }

    public function getClientes()
    {
        $clientes = new Clientes();
        return $clientes->get();
    }

   





}
