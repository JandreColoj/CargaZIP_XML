{{-- Promociones producto --}}
<div class="caja_modal" ng-click="showPromos()" ng-if="activePromos"></div>

<div id="area_detalleproductot" style="height: 530px;" ng-if="activePromos">
   <div class="header_dprocuto no_border">
      <div class="areacerrar">
         <a ng-click="showPromos()" class="icocerrar"></a>
      </div>
   </div>

   <div class="container_detalle" style="overflow-y:hidden;">
      <div class="ed-container full">

         <div class="ed-item s-50 spi">
            <div class="ed-item s-100 spi spd msj_banner">
               <span >@{{promocion.error_banner}}</span>
            </div>

            <div class="content_image_promo">
               <form action="/file-upload" class="dropzone img_primary" id="my-awesome-dropzone" dropzone="dropzoneConfig_img1" >
               </form>
            </div>
         </div>

         <div class="ed-item s-50 spd spi">
            <form class="form-horizontal ed-container content_formpromo" name="frmnew" ng-submit="guardarPromocion()">

               <div class="form-group ed-container">
                  <div class="ed-item s-100 spi spd">
                     <input id="titulo" type="text"  class="form-control" name="titulo" ng-model="promocion.titulo" placeholder="Titulo" required>
                  </div>
               </div>

               <div class="form-group ed-container">
                  <div class="ed-item s-100 spi spd">
                     <label for="">Presentación:</label>
                     <ol class="nya-bs-select mol relcont" ng-model="promocion.codigo_medida" data-live-search="true" data-size="7" title="Selecciona..." required>
                        <li nya-bs-option="medida in productoSelected.presentacion" data-value="medida.codigo_medida">
                           <a>
                              @{{ medida.medida }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-12 col-xs-12 fleft_phone">
                     <textarea id="descripcion" type="text" class="form-control sinp ng-pristine ng-valid ng-empty ng-touched" name="descripcion" ng-model="promocion.descripcion" rows="4" placeholder="Descripción promo"></textarea>
                  </div>
               </div>

               <div class="form-group ed-container">
                  <div class="ed-item ed-container s-100 spi spd spf inpumoneda cross-center main-center">
                     <div class="ed-item s-80 spi spd">
                        <input id="precioq" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precioq" ng-model="promocion.precio" placeholder="Precio 0.00" required>
                     </div>
                     <div class="ed-item s-20 spi spd">
                        <span>@{{informacion.monedaPrincipal}}</span>
                     </div>
                  </div>
               </div>

               <div class="form-group ed-container">

                  <div class="ed-item ed-container s-50 spi cross-center main-start">
                     <label>Fecha Inicio</label>
                     <div class="ed-item s-100 spi">
                        <input type="date" class="form-control" ng-model="promocion.inicio" placeholder="Fecha Inicio" required>
                     </div>
                  </div>

                  <div class="ed-item ed-container s-50 spd cross-center main-start">
                     <label>Fecha Fin</label>
                     <div class="ed-item s-100 spi spd">
                        <input type="date" class="form-control" ng-model="promocion.fin" placeholder="Fecha Fin" required>
                     </div>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                        Crear Promoción
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
