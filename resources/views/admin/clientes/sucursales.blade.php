{{-- SUCURSALES --}}
<div class="caja_modal" ng-show="showSucursales">
   <div id="modal_sucursales">
      <div class="header_area">
         <h1>Sucursales</h1>
         <div class="areacerrar">
            <a ng-click="showSucursales=false" class="icocerrar"></a>
         </div>

         <div class="container_acciones">
            <a ng-click="modal_nueva_sucursal=true" class="btn btn_opcion">Nueva sucursal</a>
         </div>
      </div>

      <div class="ed-container full" style="margin: 80px 10px 30px 20px">
         <div class="box_productoscontainer">
            <div class="box_proditem" ng-repeat="sucursal in sucursales">
               <div class="ed-container full">
                  <div class="ed-item s-100">
                     <div id="mapa@{{sucursal.id}}" style="text-align: left; width:300px; height:300px"></div>
                  </div>

                  <div class="ed-item s-100 main-start cross-center"  ng-click="detalleSucursal(sucursal)" style="cursor:pointer">
                     <div class="prod_nombre">
                        <h1>@{{sucursal.nombre | limitTo:18}} @{{ sucursal.nombre.length > 18 ? '...' : '' }}</h1>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>


{{-- Nueva sucursal --}}
<div class="caja_modal" ng-show="modal_nueva_sucursal">
   <div id="modal_detalle_suc">
      <div class="header_area">
         <h1>Nueva sucursal</h1>
         <div class="areacerrar">
            <a ng-click="modal_nueva_sucursal=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form  name="frmnew" novalidate ng-submit="guardarSucursal()">

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-40 spi">
                     <label for="nombre">Nombre:</label>
                     <input type="text" class="form-control sinp" name="nombre" ng-model="sucursal.nombre" required >
                  </div>

                  <div class="ed-item s-100 m-40 spi">
                     <label for="direccion">Direccion:</label>
                     <input type="text" class="form-control sinp" name="direccion" ng-model="sucursal.direccion" required >
                  </div>

                  <div class="ed-item s-100 m-20 spi">
                     <label for="zona">Zona:</label>
                     <input id="zona" type="number" class="form-control sinp" name="zona" ng-model="sucursal.zona" required >
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">

                     <label for="depto">Departamento</label>
                     <ol class="nya-bs-select mol relcont" ng-model="municipios" data-live-search="true" data-size="5" title="Selecciona..." ng-change="seleccionarDepto()" required>
                        <li nya-bs-option="depto in Departamentos" data-value="depto.municipios">
                           <a>
                              @{{ depto.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>

                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="muni">Municipio</label>
                     <ol class="nya-bs-select mol relcont" ng-model="sucursal.codigo_municipio" data-live-search="true" data-size="7" title="Selecciona..." required>
                        <li nya-bs-option="muni in municipios" data-value="muni.codigo">
                           <a>
                              @{{muni.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-20 spi">
                     <label for="latitud">latitud:</label>
                     <input id="latitud" type="number" step=0.00000001  class="form-control sinp" name="latitud" ng-model="sucursal.latitud" required>
                  </div>
                  <div class="ed-item s-100 m-20 spi">
                     <label for="longitud">longitud:</label>
                     <input id="longitud" type="number" step=0.00000001  class="form-control sinp" name="longitud" ng-model="sucursal.longitud" required>
                  </div>
                  <div class="ed-item s-100 m-60 spd">
                     <label for="indicaciones">Indicaciones:</label>
                     <input id="indicaciones" type="text" class="form-control sinp" name="indicaciones" ng-model="sucursal.indicaciones">
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                        Crear Sucursal
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- Editar sucursal --}}
<div class="caja_modal" ng-show="modal_editar_sucursal">
   <div id="modal_detalle_suc">
      <div class="header_area">
         <h1>Editar sucursal</h1>
         <div class="areacerrar">
            <a ng-click="modal_editar_sucursal=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form  name="frmEdit" novalidate ng-submit="editarSucursal()">

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-40 spi">
                     <label for="nombre">Nombre:</label>
                     <input type="text" class="form-control sinp" name="nombre" ng-model="selectSucursal.nombre" required >
                  </div>

                  <div class="ed-item s-100 m-40 spi">
                     <label for="direccion">Direccion:</label>
                     <input type="text" class="form-control sinp" name="direccion" ng-model="selectSucursal.direccion" required >
                  </div>

                  <div class="ed-item s-100 m-20 spi">
                     <label for="zona">Zona:</label>
                     <input id="zona" type="text" class="form-control sinp" name="zona" ng-model="selectSucursal.zona" required >
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">

                     <label for="depto">Departamento</label>
                     <ol class="nya-bs-select mol relcont" ng-model="municipios" data-live-search="true" data-size="5" title="Selecciona..." ng-change="seleccionarDepto()" required>
                        <li nya-bs-option="depto in Departamentos" data-value="depto.municipios">
                           <a>
                              @{{ depto.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>

                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="muni">Municipio</label>
                     <ol class="nya-bs-select mol relcont" ng-model="selectSucursal.codigo_municipio" data-live-search="true" data-size="7" title="Selecciona..." required>
                        <li nya-bs-option="muni in municipios" data-value="muni.codigo">
                           <a>
                              @{{muni.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-20 spi">
                     <label for="latitud">latitud:</label>
                     <input id="latitud" type="number" step=0.00000001  class="form-control sinp" name="latitud" ng-model="selectSucursal.latitud" required>
                  </div>
                  <div class="ed-item s-100 m-20 spi">
                     <label for="longitud">longitud:</label>
                     <input id="longitud" type="number" step=0.00000001  class="form-control sinp" name="longitud" ng-model="selectSucursal.longitud" required>
                  </div>
                  <div class="ed-item s-100 m-60 spd">
                     <label for="indicaciones">Indicaciones:</label>
                     <input id="indicaciones" type="text" class="form-control sinp" name="indicaciones" ng-model="selectSucursal.indicaciones">
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmEdit.$invalid">
                        Editar Sucursal
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- DETALLE DE SUCURSAL --}}
<div class="caja_modal" ng-if="modal_detalle_sucursal">
   <div id="modal_detalle_suc">
      <div class="header_area">
         <h1>Detalle de la Sucursal</h1>
         <div class="areacerrar">
            <a ng-click="cerrar_sucursal()" class="icocerrar"></a>
         </div>
      </div>

      <div class="ed-container full" style="padding: 15px">
         <div class="ed-item s-60 fleft_phonecp mtop">
               <p style="text-align:center"><b>@{{selectSucursal.nombre}}</b></p>
               <br>
               <p> <b>Direccion:</b> @{{selectSucursal.direccion}}</p>
               <p> <b>Latitud:</b> @{{selectSucursal.latitud}} <b>longitud:</b> @{{selectSucursal.longitud}}</p>
               <p> <b>Pais:</b>  @{{selectSucursal.pais}}</p>
               <p> <b>Ciudad:</b> @{{selectSucursal.ciudad}}</p>
               <p> <b>Indicaciones:</b>  @{{selectSucursal.indicaciones}}</p>

               <div class="ed-item s-100 main-center cross-center ">
                  <button type="button" class="btn" ng-click="eliminarSucursal()"> Eliminar </button>
                  <button type="button" class="btn" ng-click="showEditarSucursal()"> Editar </button>
               </div>
            </div>
            <div class="ed-item s-40 spd">
               <div id="mapaSelect@{{selectSucursal.id}}" style="text-align: left; width:100%; height:250px">  </div>
            </div>
         </div>
      </div>
   </div>
</div>
