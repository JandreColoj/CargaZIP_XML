{{-- NUEVO USUARIO --}}
<div class="caja_modal" ng-show="nuevo_usuario">
   <div id="modal_nuevo" style="height:400px;">
      <div class="header_area">
         <h1>Nuevo Usuario</h1>
         <div class="areacerrar">
            <a ng-click="nuevo_usuario=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmnew" ng-submit="guardarUsuario()">

               <div class="ed-container full">
                  <div class="ed-item s-100 spi">
                     <label for="p_nombre">Nombres y apellidos: </label>
                     <input id="p_nombre" type="text" class="form-control sinp" name="nombre" ng-model="usuario.nombres" required >
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="dpi">DPI</label>
                     <input id="dpi" type="text" class="form-control sinp" name="dpi" ng-model="usuario.dpi" >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="telefono">Teléfono</label>
                     <input id="telefono" type="text" class="form-control sinp" name="telefono" ng-model="usuario.telefono"  required>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="depto">Rol:</label>
                     <ol class="nya-bs-select mol relcont" ng-model="usuario.id_rol" data-live-search="true" data-size="5" title="Selecciona..." required>
                        <li nya-bs-option="rol in Roles" data-value="rol.id">
                           <a>
                              @{{ rol.name }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  {{-- <div class="ed-item s-100 m-50 spi spd">
                     <label for="depto">Bodega:</label>
                     <ol class="nya-bs-select mol relcont" ng-model="usuario.id_bodega" data-live-search="true" data-size="5" title="Selecciona..." required>
                        <li nya-bs-option="bodega in Bodegas" data-value="bodega.id">
                           <a>
                              @{{ bodega.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div> --}}
               </div>

               <div class="ed-container full">

                  <h6> <b>Usuario del vendedor</b></h6>

                  <div class="ed-item s-100 m-100 spi spd">
                     <input type="email" class="form-control " ng-model="usuario.correo" name="correo" placeholder="Ingrese el correo electronico" required>
                     <div class="alert-danger" ng-if="frmnew.correo.$dirty && frmnew.correo.$error.required">
                           Requerido
                     </div>

                     <div class="alert-danger" ng-show="frmnew.correo.$dirty && frmnew.correo.$error.email">
                           Ingresa un correo valido.
                     </div>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <input type="password" class="form-control sinp" ng-model="usuario.pass" placeholder="Ingrese la contraseña" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <input type="password" class="form-control sinp" ng-model="usuario.pass2" placeholder="Confirmar la contraseña" required>
                  </div>

                  <div class="ed-item s-100 alert-danger" ng-if="passIncorrect">
                     @{{passIncorrect}}
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                        Crear Usuario
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- EDITAR USUARIO --}}
<div class="caja_modal" ng-show="editar_usuario">
   <div id="modal_nuevo" style="height:400px;">
      <div class="header_area">
         <h1>Editar Usuario</h1>
         <div class="areacerrar">
            <a ng-click="editar_usuario = false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmedit" ng-submit="editarUsuario()">

               <div class="ed-container full">
                  <div class="ed-item s-100  spi">
                     <label for="e_nombre">Nombres</label>
                     <input id="e_nombre" type="text" class="form-control sinp" name="nombre" ng-model="usuarioSelected.nombre" required >
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="e_dpi">DPI</label>
                     <input id="e_dpi" type="text" class="form-control sinp" name="dpi" ng-model="usuarioSelected.dpi" >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="e_telefono">telefono</label>
                     <input id="e_telefono" type="text" class="form-control sinp" name="telefono" ng-model="usuarioSelected.telefono"  required>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="depto">Rol:</label>
                     <ol class="nya-bs-select mol relcont" ng-model="usuarioSelected.id_rol" data-live-search="true" data-size="5" title="Selecciona..." required>
                        <li nya-bs-option="rol in Roles" data-value="rol.id">
                           <a>
                              @{{ rol.name }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="header_area">
                  <h1>Usuario del piloto</h1>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-100 spi spd">
                     <input type="email" class="form-control" ng-model="usuarioSelected.user.email" name="correo" placeholder="Ingrese el correo electronico" readonly>
                     <div class="alert-danger" ng-if="frmedit.correo.$dirty && frmedit.correo.$error.required">
                           Requerido
                     </div>
                     <div class="alert-danger" ng-show="frmedit.correo.$dirty && frmedit.correo.$error.email">
                           Ingresa un correo valido.
                     </div>
                  </div>
               </div>
               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <input type="password" class="form-control sinp" ng-model="usuarioSelected.pass" placeholder="Ingrese la contraseña" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <input type="password" class="form-control sinp" ng-model="usuarioSelected.pass2" placeholder="Confirmar la contraseña" required>
                  </div>

                  <div class="ed-item s-100 alert-danger" ng-if="passIncorrect">
                     @{{passIncorrect}}
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmedit.$invalid">
                        Editar usuario
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
