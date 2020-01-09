<?php

namespace App\Http\Controllers\Ajustes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\Empresa;
use App\Models\UserEmpresa;
use App\Models\RoleUser;
use App\User;

class UsuarioController extends Controller{

   public function index(){
      return view('admin.Ajustes.Usuarios.indexUsuario');
   }

   public function nuevoUsuario(Request $request){

      $existe = User::where('email',$request->correo)->first();

      if($existe){
         return response()->json(['codigo' => '400', 'mensaje' => 'El correo ya esta utilizado por otro usuario.']);
      }

      DB::beginTransaction();

      try{

         #crear Usuario
         $usuario = User::create([
            'name'      => $request->nombres,
            'email'     => $request->correo,
            'dpi'       => $request->dpi,
            'telefono'  => $request->telefono,
            'password'  => bcrypt($request->pass),
            'id_bodega' => $request->id_bodega,
            'estado'    => 1
         ]);

         UserEmpresa::create([
            'user_id' => $usuario->id,
            'identidad_empresa' => Empresa::getIdentidad(),
            'estado'  => 1,
         ]);

         DB::table('role_user')->insert([
            'role_id' => $request->id_rol,
            'user_id' => $usuario->id,
         ]);

         DB::commit();

      }catch(\Exception $e){
         DB::rollback();
         $mensaje = $e->getMessage();

         return response()->json(['codigo' => '400', 'mensaje' => $mensaje]);
      }

      return response()->json(['codigo' => '200','data' => $usuario]);

   }

   public function getUsuarios(){

      $identidad = Empresa::getIdentidad();
      $usuarios = UserEmpresa::with('User')->where('identidad_empresa', $identidad)->where('estado',1)->orderby('id', 'DESC')->get();

      return response()->json(['usuarios' => $usuarios],200);
   }

   public function editarUsuario(Request $request){

      DB::beginTransaction();

      try{

         $user = User::find($request->user_id);
         $user->fill([
            'name'     => $request->nombre,
            'dpi'      => $request->dpi,
            'telefono' => $request->telefono,
         ]);
         $user->save();

         RoleUser::updateOrCreate(
            ['user_id'=> $request->user_id],
            ['role_id' => $request->id_rol]
         );

         #actualizacion de password
         if($request->pass != 'false'){
            $user->password = bcrypt($request->pass);
            $user->save();
         }

         DB::commit();

      }catch(\Exception $e){
         DB::rollback();
         $mensaje = $e->getMessage();

         return response()->json(['codigo' => '400', 'mensaje' => $mensaje]);
      }

      return response()->json(['codigo' => '200','response' => $user]);
   }

}
