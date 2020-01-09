<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ultraware\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Ultraware\Roles\Traits\HasRoleAndPermission;

class User extends Authenticatable  implements HasRoleAndPermissionContract{
   use Notifiable, HasRoleAndPermission;

   protected $guarded = ['id'];
   protected $hidden = ['password', 'remember_token'];
   protected $casts = ['email_verified_at' => 'datetime'];

   public function RolUsuario(){
      return $this->hasOne('\App\Models\RoleUser','user_id','id')->with("Rol");
  }
}
