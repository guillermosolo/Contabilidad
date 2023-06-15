<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $table = "menu";
  protected $primaryKey = "men_id";
  protected $fillable = ['men_nombre','men_url','men_icono'];
  protected $guarded = ['men_id'];

  public function getHijos($padres, $line)
  {
      $children = [];
      foreach ($padres as $line1) {
          if ($line['men_id'] == $line1['men_padre']) {
              $children = array_merge($children, [array_merge($line1, ['submenu' => $this->getHijos($padres, $line1)])]);
          }
      }
      return $children;
  }

  public function getPadres()
  {
          return $this->orderby('men_padre')
              ->orderby('men_orden')
              ->get()
              ->toArray();
  }

  public static function getMenu()
  {
      $menus = new Menu();
      $padres = $menus->getPadres();
      $menuAll = [];
      foreach ($padres as $line) {
          if ($line['men_padre'] != 0)
              break;
          $item = [array_merge($line, ['submenu' => $menus->getHijos($padres, $line)])];
          $menuAll = array_merge($menuAll, $item);
      }
      return $menuAll;
  }

  public function guardarOrden($menu)
  {
      $menus = json_decode($menu);
      foreach ($menus as $var => $value) {
          $this->where('men_id', $value->id)->update(['men_padre' => 0, 'men_orden' => $var + 1]);
          if (!empty($value->children)) {
              foreach ($value->children as $key => $vchild) {
                  $update_id = $vchild->id;
                  $parent_id = $value->id;
                  $this->where('men_id', $update_id)->update(['men_padre' => $parent_id, 'men_orden' => $key + 1]);

                  if (!empty($vchild->children)) {
                      foreach ($vchild->children as $key => $vchild1) {
                          $update_id = $vchild1->id;
                          $parent_id = $vchild->id;
                          $this->where('men_id', $update_id)->update(['men_padre' => $parent_id, 'men_orden' => $key + 1]);

                          if (!empty($vchild1->children)) {
                              foreach ($vchild1->children as $key => $vchild2) {
                                  $update_id = $vchild2->id;
                                  $parent_id = $vchild1->id;
                                  $this->where('men_id', $update_id)->update(['men_padre' => $parent_id, 'men_orden' => $key + 1]);

                                  if (!empty($vchild2->children)) {
                                      foreach ($vchild2->children as $key => $vchild3) {
                                          $update_id = $vchild3->id;
                                          $parent_id = $vchild2->id;
                                          $this->where('men_id', $update_id)->update(['men_padre' => $parent_id, 'men_orden' => $key + 1]);
                                      }
                                  }
                              }
                          }
                      }
                  }
              }
          }
      }
  }
}
