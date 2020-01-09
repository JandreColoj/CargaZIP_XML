<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdentidadPromociones extends Migration{

   public function up(){
      Schema::table('promociones', function (Blueprint $table) {
         $table->string('identidad_empresa')->after('id_producto');
      });
   }


   public function down(){
      Schema::table('promociones', function (Blueprint $table) {
         $table->dropColumn('identidad_empresa');
      });
   }
}
