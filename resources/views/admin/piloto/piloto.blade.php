{{-- NUEVO PILOTO --}}
<div class="caja_modal" ng-show="nuevo_piloto">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Nuevo piloto</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmnew" ng-submit="guardarPiloto()">

               <div class="ed-container full">
                  <div class="ed-item s-100 spi">
                     <label for="p_nombre">Nombres</label>
                     <input id="p_nombre" type="text" class="form-control sinp" name="nombre" ng-model="piloto.nombres" required >
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="dpi">DPI</label>
                     <input id="dpi" type="text" class="form-control sinp" name="dpi" ng-model="piloto.dpi" >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="telefono">Teléfono</label>
                     <input id="telefono" type="text" class="form-control sinp" name="telefono" ng-model="piloto.telefono"  required>
                  </div>
               </div>

               <h6><b>Usuario del piloto</b></h6>

               <div class="ed-container full pass_piloto">
                  <div class="ed-item s-100 spi spd">
                     <input type="email" class="form-control " ng-model="piloto.correo" name="correo" placeholder="Ingrese el correo electronico" required>

                     <div class="alert-danger" ng-if="frmnew.correo.$dirty && frmnew.correo.$error.required">
                        Requerido
                     </div>

                     <div class="alert-danger" ng-show="frmnew.correo.$dirty && frmnew.correo.$error.email">
                        Ingresa un correo valido.
                     </div>
                  </div>

                  <div class="ed-item s-50 spi">
                     <input type="password" class="form-control sinp" ng-model="piloto.pass" placeholder="Ingrese la contraseña" required >
                  </div>

                  <div class="ed-item s-50 spd">
                     <input type="password" class="form-control sinp" ng-model="piloto.pass2" placeholder="Confirmar la contraseña" required>
                  </div>

                  <div class="ed-item s-100 alert-danger" ng-if="passIncorrect">
                     @{{passIncorrect}}
                  </div>
               </div>

               <hr>
               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="vehiculo">Asignar Vehiculo:</label>
                     <ol class="nya-bs-select mol relcont" ng-model="piloto.id_transporte" data-live-search="true" data-size="5" title="Selecciona..." required>
                        <li nya-bs-option="trans in transporte" data-value="trans.id">
                           <a>
                              @{{trans.modelo_vehiculo }} ->  @{{trans.piloto.user.name }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="ed-item s-100 alert-danger" ng-if="errorNewPiloto">
                  @{{errorNewPiloto}}
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

{{-- EDITAR PILOTO --}}
<div class="caja_modal" ng-show="editar_piloto">
   <div id="modal_nuevo" style="height:450px;">
      <div class="header_area">
         <h1>Editar piloto</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmedit" ng-submit="editarPiloto()">
               <div class="ed-container full">
                  <div class="ed-item s-100 spi">
                     <label for="e_nombre">Nombres</label>
                     <input id="e_nombre" type="text" class="form-control sinp" name="nombre" ng-model="pilotoSelected.nombre" required >
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="e_dpi">DPI</label>
                     <input id="e_dpi" type="text" class="form-control sinp" name="dpi" ng-model="pilotoSelected.dpi" >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="e_telefono">telefono</label>
                     <input id="e_telefono" type="text" class="form-control sinp" name="telefono" ng-model="pilotoSelected.telefono"  required>
                  </div>
               </div>

               <h6><b>Usuario del piloto</b></h6>

               <div class="ed-container full pass_piloto">
                  <div class="ed-item s-100 m-100 spi spd">
                     <input type="email" class="form-control" ng-model="pilotoSelected.user.email" name="correo" placeholder="Ingrese el correo electronico" readonly>
                     <div class="alert-danger" ng-if="frmedit.correo.$dirty && frmedit.correo.$error.required">
                        Requerido
                     </div>

                     <div class="alert-danger" ng-show="frmedit.correo.$dirty && frmedit.correo.$error.email">
                        Ingresa un correo valido.
                     </div>
                  </div>

                  <div class="ed-item s-50 spi">
                     <input type="password" class="form-control sinp" ng-model="pilotoSelected.pass" placeholder="Ingrese la contraseña" required>
                  </div>

                  <div class="ed-item s-50 spd">
                     <input type="password" class="form-control sinp" ng-model="pilotoSelected.pass2" placeholder="Confirmar la contraseña" required>
                  </div>

                  <div class="ed-item s-100 alert-danger" ng-if="passIncorrect">
                     @{{passIncorrect}}
                  </div>
               </div>

               <hr>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="vehiculoe">Asignar Vehiculo:</label>
                     <ol class="nya-bs-select mol relcont" name="vehiculoe" ng-model="pilotoSelected.id_transporte" data-live-search="true"
                         title="Selecciona..." data-size="4">

                        <li nya-bs-option="trans in transporte" data-value="trans.id">
                           <a>
                              @{{trans.modelo_vehiculo }} -> @{{trans.piloto.user.name }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="ed-item s-100 alert-danger" ng-if="errorEditPiloto">
                  @{{errorEditPiloto}}
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmedit.$invalid">
                        Editar
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
