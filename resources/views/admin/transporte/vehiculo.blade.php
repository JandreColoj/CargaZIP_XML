{{-- Nuevo Producto --}}
<div class="caja_modal" ng-show="nuevo_transporte">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Nuevo vehiculo</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmnew" ng-submit="guardarVehiculo()">

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="">Modelo del Vehiculo</label>
                     <input id="sku" type="text" class="form-control sinp" name="marca" ng-model="vehiculo.modelo" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="">Año del vehiculo</label>
                     <input id="nombre" type="number" class="form-control sinp" name="anio" ng-model="vehiculo.anio"  required>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="">Placas</label>
                     <input id="sku" type="text" class="form-control sinp" name="placa" ng-model="vehiculo.placa" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="">Capacidad</label>
                     <input id="nombre" type="text" class="form-control sinp" name="capacidad" ng-model="vehiculo.capacidad"  required>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                        Crear
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- Editar Producto --}}
<div class="caja_modal" ng-show="editar_transporte">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Editar vehiculo</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmEdit" ng-submit="editarVehiculo()">

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="">Modelo del Vehiculo</label>
                     <input id="sku" type="text" class="form-control sinp" name="marca" ng-model="vehiculoSelected.modelo_vehiculo" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="">Año del vehiculo</label>
                     <input id="nombre" type="number" class="form-control sinp" name="anio" ng-model="vehiculoSelected.anio"  required>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="">Placas</label>
                     <input id="sku" type="text" class="form-control sinp" name="placa" ng-model="vehiculoSelected.placa" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="">Capacidad</label>
                     <input id="nombre" type="text" class="form-control sinp" name="capacidad" ng-model="vehiculoSelected.capacidad"  required>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmEdit.$invalid">
                        Editar
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
