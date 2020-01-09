{{-- NUEVO VENDEDOR --}}
<div class="caja_modal" ng-show="nuevo_vendedor">
   <div id="modal_nuevo" style="height:400px;">
      <div class="header_area">
         <h1>Nuevo Vendedor</h1>
         <div class="areacerrar">
            <a ng-click="nuevo_vendedor=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmnew" ng-submit="guardarVendedor()">
               <div class="ed-container full">
                  <div class="ed-item s-100 spi">
                     <label for="p_nombre">Nombres</label>
                     <input id="p_nombre" type="text" class="form-control sinp" name="nombre" ng-model="vendedor.nombres" required >
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="dpi">DPI</label>
                     <input id="dpi" type="text" class="form-control sinp" name="dpi" ng-model="vendedor.dpi" >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="telefono">Teléfono</label>
                     <input id="telefono" type="text" class="form-control sinp" name="telefono" ng-model="vendedor.telefono"  required>
                  </div>
               </div>

               <h6><b>Usuario del vendedor</b></h6>

               <div class="ed-container full pass_piloto">
                  <div class="ed-item s-100 spi spd">
                     <input type="email" class="form-control " ng-model="vendedor.correo" name="correo" placeholder="Ingrese el correo electronico" required>

                     <div class="alert-danger" ng-if="frmnew.correo.$dirty && frmnew.correo.$error.required">
                        Requerido
                     </div>

                     <div class="alert-danger" ng-show="frmnew.correo.$dirty && frmnew.correo.$error.email">
                        Ingresa un correo valido.
                     </div>
                  </div>

                  <div class="ed-item s-100 m-50 spi">
                     <input type="password" class="form-control sinp" ng-model="vendedor.pass" placeholder="Ingrese la contraseña" required >
                  </div>

                  <div class="ed-item s-100 m-50 spd">
                     <input type="password" class="form-control sinp" ng-model="vendedor.pass2" placeholder="Confirmar la contraseña" required>
                  </div>

                  <div class="ed-item s-100 alert-danger" ng-if="passIncorrect">
                     @{{passIncorrect}}
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

{{-- EDITAR VENDEDOR --}}
<div class="caja_modal" ng-show="editar_vendedor">
   <div id="modal_nuevo" style="height:400px;">
      <div class="header_area">
         <h1>Editar Vendedor</h1>
         <div class="areacerrar">
            <a ng-click="editar_vendedor = false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmedit" ng-submit="editarVendedor()">
               <div class="ed-container full">
                  <div class="ed-item s-100  spi">
                     <label for="e_nombre">Nombres</label>
                     <input id="e_nombre" type="text" class="form-control sinp" name="nombre" ng-model="vendedorSelected.nombre" required >
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="e_dpi">DPI</label>
                     <input id="e_dpi" type="text" class="form-control sinp" name="dpi" ng-model="vendedorSelected.dpi" >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="e_telefono">telefono</label>
                     <input id="e_telefono" type="text" class="form-control sinp" name="telefono" ng-model="vendedorSelected.telefono"  required>
                  </div>
               </div>

               <h6><b>Usuario del vendedor</b></h6>

               <div class="ed-container full pass_piloto">
                  <div class="ed-item s-100 m-100 spi spd">
                     <input type="email" class="form-control" ng-model="vendedorSelected.user.email" name="correo" placeholder="Ingrese el correo electronico" readonly>

                     <div class="alert-danger" ng-if="frmedit.correo.$dirty && frmedit.correo.$error.required">
                        Requerido
                     </div>
                     <div class="alert-danger" ng-show="frmedit.correo.$dirty && frmedit.correo.$error.email">
                        Ingresa un correo valido.
                     </div>
                  </div>

                  <div class="ed-item s-100 m-50 spi">
                     <input type="password" class="form-control sinp" ng-model="vendedorSelected.pass" placeholder="Ingrese la contraseña" required>
                  </div>

                  <div class="ed-item s-100 m-50 spd">
                     <input type="password" class="form-control sinp" ng-model="vendedorSelected.pass2" placeholder="Confirmar la contraseña" required>
                  </div>

                  <div class="ed-item s-100 alert-danger" ng-if="passIncorrect">
                     @{{passIncorrect}}
                  </div>
               </div>

               {{-- <div class="ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <input type="password" class="form-control sinp" ng-model="vendedorSelected.pass" placeholder="Ingrese la contraseña" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <input type="password" class="form-control sinp" ng-model="vendedorSelected.pass2" placeholder="Confirmar la contraseña" required>
                  </div>

                  <div class="ed-item s-100 alert-danger" ng-if="passIncorrect">
                     @{{passIncorrect}}
                  </div>
               </div> --}}

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
