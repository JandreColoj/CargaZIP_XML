<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Empresa;
use App\Models\RoleUser;
use App\Models\Notificaciones;
use App\Models\Departamento;
use App\Models\EstadoPedido;
use App\Models\Roles;
use App\Models\Ajustes\Bodegas;
use App\Models\clientes\CanalNegocio;
use App\Models\clientes\TipoNegocio;

class GeneralController extends Controller{

   public function getNotificaciones(){

      $id_user = auth()->id();
      $roleUser  = RoleUser::with('Rol')->where('user_id',$id_user)->first();

      if ($roleUser->rol->slug == 'piloto') {
         $notificaciones = [];
      }else{
         $identidad = Empresa::getIdentidad();
         $notificaciones = Notificaciones::where('identidad_empresa',$identidad)->where('leido',0)->get();
      }

      return response()->json(['datos' => $notificaciones],200);
   }

   public function omitirNotificacion($id){

      Notificaciones::find($id)->update(['leido'=> 1]);
      return $this->getNotificaciones();
   }

   public function parametros(){

      $estados = EstadoPedido::all();
      $canales = CanalNegocio::where('estado',1)->get();
      $tipoNegocio = TipoNegocio::where('estado',1)->get();
      $departamentos = Departamento::with('municipios')->where('estado',1)->where('codigo_depto',0)->get();

      $datos=[
         'estados' => $estados,
         'canales' => $canales,
         'tipoNegocio' => $tipoNegocio,
         'departamentos' => $departamentos,
      ];

      return response()->json(['datos' => $datos],200);
   }

   public function parametrosUsuario(){

      $id_empresa = Empresa::getID();

      $roles = Roles::where('estado',1)->whereIn('slug',['operativo'])->get();
      $bodegas = Bodegas::where('id_empresa',$id_empresa)->where('estado',1)->get();

      $datos=[
         'roles' => $roles,
         'bodegas' => $bodegas,
      ];

      return response()->json(['datos' => $datos],200);
   }
}
