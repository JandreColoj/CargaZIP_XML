<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadoRoleTable extends Migration{

   public function up(){
      Schema::table('roles', function (Blueprint $table) {
         $table->integer('estado');
      });

      Schema::table('users', function (Blueprint $table) {
         $table->string('telefono')->after('email')->nullable();
         $table->string('dpi')->after('telefono')->nullable();
      });

      Schema::table('piloto', function (Blueprint $table) {
         $table->integer('id_transporte')->change();
         $table->dropColumn(['nombre', 'apellido', 'telefono', 'dpi']);
      });

      Schema::table('vendedores', function (Blueprint $table) {
         $table->dropColumn(['telefono', 'dpi']);
      });
   }


   public function down(){
      Schema::table('roles', function (Blueprint $table) {
         $table->dropColumn('estado');
      });

      Schema::table('users', function (Blueprint $table) {
         $table->dropColumn('telefono');
         $table->dropColumn('dpi');
      });

      Schema::table('piloto', function (Blueprint $table) {
         $table->string('nombre');
         $table->string('apellido');
         $table->string('telefono');
         $table->string('dpi');
      });

      Schema::table('vendedores', function (Blueprint $table) {
         $table->string('telefono');
         $table->string('dpi');
      });
   }
}
