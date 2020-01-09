<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model{
   protected $table = 'role_user';
   protected $fillable = ['role_id','user_id'];
   protected $hidden = ['created_at','updated_at'];
   protected $dates = ['deleted_at'];

   public function Rol(){
      return $this->hasOne('\App\Models\Roles','id','role_id');
   }
}
