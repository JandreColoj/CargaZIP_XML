<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleProduct extends TestCase{

   /* @test */
   function it_load_view_product(){
      $this->get('/productos')->assertStatus(200);
   }

   /* @test */
   function it_load_get_product(){
      $this->get('/api/productos/getProductos')->assertStatus(200);
   }

}
