<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmpresa extends Model{

   protected $table = 'user_empresa';
   protected $guarded = ['id'];
   protected $hidden = ['created_at','updated_at'];

   public function User(){
      return $this->hasOne('App\User','id','user_id')->with('RolUsuario');
   }
}
