<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use ZipArchive;
use Storage;
use File;
use App\User;

class XMLController extends Controller{

   public function index(){
      return view('XML.cargaxmlView');
   }

   public function subirArchivo(Request $request){

      $zip = base64_decode($request->zip);  
 
      $file = $request->file('file');
      $nombre = $file->getClientOriginalName();
      $ruta = public_path().'/zip/';
      $file->move($ruta,$nombre);

      $result = $this->extraerXML($ruta, $nombre);

      // $this->eliminarCarpeta($ruta);
      $json=$this->leerCarpeta('xml/');
      return $json;

   }

   public function extraerXML($ruta, $nombre){

      $zip = new ZipArchive;
      // Declaramos el fichero a descomprimir, puede ser enviada desde un formulario
      $comprimido= $zip->open($ruta.$nombre);

      if ($comprimido=== TRUE) {
         // Declaramos la carpeta que almacenara ficheros descomprimidos
         $zip->extractTo('xml/');
         $zip->close();
         // Imprimimos si todo salio bien
         return 'El fichero se descomprimio correctamente!';
      }else{
         // Si algo salio mal, se imprime esta seccion
         return 'Error descomprimiendo el archivo zip';
      }
           
   }

   public function eliminarCarpeta($carpeta){

      foreach(glob($carpeta . "/*") as $archivos_carpeta){             
        if (is_dir($archivos_carpeta)){
          $this->eliminarCarpeta($archivos_carpeta);
        } else {
         unlink($archivos_carpeta);
        }
      }

      rmdir($carpeta);
   }

   public function leerCarpeta($carpeta){

      $C =[];
      foreach(glob($carpeta . "/*") as $archivos_carpeta){   
         
         $nuevo_nombre = str_replace ("xml//", "", $archivos_carpeta);
         $fp = fopen($archivos_carpeta, "r"); 

         // return $fp;
         $xml = simplexml_load_file($archivos_carpeta); 
         $json = json_encode($xml);
         $array = json_decode($json,TRUE);
         return $array['course'];
         array_push($C, $xml);
      }
      return $C;
   }
     
}
