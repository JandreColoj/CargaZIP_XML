<?php
namespace App\Helpers;

use App\Models\RoleUser;
use App\Models\Empresas;
use App\Models\UserEmpresa;
use App\Models\Ajustes\Bodegas;

class Empresa {

   public static function getIdentidad() {

      $id_user = auth()->id();

      $roleUser  = RoleUser::where('user_id',$id_user)->first();

      if ($roleUser->role_id==1){

         $miempresa = Empresas::where('id_user',$id_user)->first();
         return $miempresa->identidad_empresa;
      }

      $miempresa = UserEmpresa::where('user_id',$id_user)->first();

      return $miempresa->identidad_empresa;

   }

   public static function getID() {

      $id_user = auth()->id();

      $roleUser  = RoleUser::where('user_id',$id_user)->first();

      if ($roleUser->role_id==1){

         $miempresa = Empresas::where('id_user',$id_user)->first();
         return $miempresa->id;
      }

      $miempresa = UserEmpresa::where('user_id',$id_user)->first();

      return $miempresa->id;

   }

   public static function getBodega($id_user = false){

      if(!$id_user){
         $id_user = auth()->id();
      }

      $usuario = User::find($id_user);
      $bodega = Bodegas::find($usuario->id_bodega);

      return $bodega;
   }

}
