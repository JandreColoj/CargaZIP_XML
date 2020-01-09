<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaProductoTable extends Migration{

   public function up(){

      Schema::create('categoria_producto', function (Blueprint $table) {
         $table->increments('id');
         $table->string('identidad_empresa');
         $table->string('nombre');
         $table->integer('estado')->default(1);
         $table->timestamps();
      });

      Schema::create('productos', function (Blueprint $table) {
         $table->increments('id');
         $table->string('identidad_empresa');
         $table->string('sku');
         $table->string('nombre');
         $table->longText('descripcion');
         $table->float('precio',15,2);
         $table->float('precio_usd',15,2)->default(0);
         $table->integer('ac_stock');
         $table->integer('estado')->default(1);
         $table->integer('id_producto')->nullable(); #hace referencia a la misma tabla
         $table->integer('id_categoria')->default(0);
         $table->timestamps();
      });

      Schema::create('imagen_producto', function (Blueprint $table) {
         $table->increments('id');
         $table->string('imagen');
         $table->integer('id_producto')->unsigned();
         $table->foreign('id_producto')->references('id')->on('productos');
         $table->timestamps();
      });

      Schema::create('stock_producto', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('stock');
         $table->integer('id_producto')->unsigned();
         $table->foreign('id_producto')->references('id')->on('productos');
         $table->timestamps();
      });

   }

   public function down(){
      Schema::dropIfExists('categoria_producto');
      Schema::dropIfExists('productos');
      Schema::dropIfExists('imagen_producto');
      Schema::dropIfExists('stock_producto');
   }
}
