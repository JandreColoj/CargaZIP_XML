<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresas;
use App\Helpers\Empresa;
use \stdClass;
use Auth;

class HomeController extends Controller{

   public function __construct(){
      $this->middleware('auth');
   }

   public function index(){

      // $identidad = Empresa::getIdentidad();
      // $empresa = Empresas::with("User")->where('identidad_empresa',$identidad)->first();

      return view('admin.escritorio.escritorio');

      // if ($empresa->User->cambio_pass==0) {
      //    return view('admin.cambioPass');
      // }else{
      //    return view('home');
      // }
   }

   public function usuario(){

      $identidad = Empresa::getIdentidad();
      $miusuario = Empresas::with("User")->where('identidad_empresa',$identidad)->first();

      return response()->json(['datos' => $miusuario],200);
   }

   public function infoEmpresa(){
      $identidad = Empresa::getIdentidad();
      $empresa = Empresas::where('identidad_empresa', $identidad)->first();

      $informacion = new stdClass();
      $informacion->monedaPrincipal = $empresa->moneda;

      return response()->json(['datos' => $informacion],200);
   }

}
