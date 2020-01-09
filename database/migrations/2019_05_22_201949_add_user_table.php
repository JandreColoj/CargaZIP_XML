<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTable extends Migration{

   public function up(){

      Schema::table('users', function (Blueprint $table) {
         $table->string('verifytoken');
         $table->integer('estado');
      });
   }

   public function down(){
      Schema::table('users', function (Blueprint $table) {
         $table->dropColumn('verifytoken');
         $table->dropColumn('estado');
      });
   }
}
