<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model{

   protected $table = 'roles';
   protected $fillable = ['name','slug','description','level'];
   protected $hidden = ['created_at','updated_at'];

}
