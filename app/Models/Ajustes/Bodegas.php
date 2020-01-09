<?php

namespace App\Models\Ajustes;

use Illuminate\Database\Eloquent\Model;

class Bodegas extends Model{
   protected $table = 'bodegas';
   protected $guarded = ['id'];
   protected $hidden = ['updated_at'];

   public function Municipio(){
      return $this->hasOne('App\Models\Departamento','codigo', 'codigo_municipio')->with('Departamento');
   }

}
