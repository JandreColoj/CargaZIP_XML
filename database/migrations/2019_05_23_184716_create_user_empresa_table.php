<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEmpresaTable extends Migration{

   public function up(){
      Schema::create('user_empresa', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
         $table->string('identidad_empresa');
         $table->integer('estado');
         $table->timestamps();
      });
   }

   public function down(){
      Schema::dropIfExists('user_empresa');
   }
}
