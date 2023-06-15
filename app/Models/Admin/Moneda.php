<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Moneda extends Model
{
    use LogsActivity;

    protected $table = 'moneda';
    protected $fillable = ['mon_nombre', 'mon_abreviatura','mon_simbolo'];
    protected $guarded = 'mon_id';
    protected $primaryKey = 'mon_id';
    protected static $logName = 'moneda';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getMonedas()
  {
      $moneda = new Moneda();
      return $moneda->where('mon_id', '>', '0')->orderBy('mon_id')->get();
  }

  public function getMoneda($param)
  {
      $mon = new Moneda();
      $abreviatura = $mon->where('mon_id', '=', $param)->first();

      return $abreviatura;
  }

  public function getSigla($monid){
    $moneda = new Moneda();
    return $moneda->where('mon_id',$monid)->first()->mon_abreviatura;
}
}



