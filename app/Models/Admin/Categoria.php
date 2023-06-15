<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Categoria extends Model
{
    use LogsActivity;

    protected $table = 'categoria';
    protected $fillable = ['cat_descripcion', 'cat_porcentaje','cat_tipo'];
    protected $guarded = 'cat_id';
    protected $primaryKey = 'cat_id';
    protected static $logName = 'categoria';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getCategoria($filtro='T')
      {
          $cat = new Categoria();
          if ($filtro =='T'){
          return $cat->orderBy('cat_id')->get();}
          elseif ($filtro =='D'){
            return $cat->where('cat_tipo', 'D')->orderBy('cat_id')->get();
          } else {
            return $cat->where('cat_tipo', 'A')->orderBy('cat_id')->get();
          }
      }

}
