<?php

namespace App\Models\Ajustes;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model{
   protected $table = 'vendedores';
   protected $guarded = ['id'];
   protected $hidden = ['updated_at'];

   public function User(){
      return $this->hasOne('App\User','id','id_user');
   }
}
