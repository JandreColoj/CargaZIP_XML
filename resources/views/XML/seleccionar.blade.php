{{-- NUEVO VENDEDOR --}}
<div class="caja_modal" ng-show="nuevo_vendedor">
   <div id="modal_nuevo" style="height:400px;">
      <div class="header_area">
         <h1>Seleccionar archivo</h1>
         <div class="areacerrar">
            <a ng-click="nuevo_vendedor=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">

         <form method="POST" action="api/subirArchivo" accept-charset="UTF-8" enctype="multipart/form-data">
         
            <form class="form-horizontal" name="frmnew" ng-submit="subirArchivo()">
               <div class="ed-container full">
                  <div class="ed-item s-100 spi">
                     <input type="file" class="form-control"  accept=".zip" name="file" >
                     <!-- <input type="file" id="upload_zip"  accept=".png, .jpg, .jpeg, .zip" ng-model="contenido.zip" ng-change="showContent()"> -->


                  <!-- <input id="archivo" type="file" class="form-control sinp" enctype='multipart/form-data' name="archivo" ng-model="archivo.zip" required > -->
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save">
                        Subir
                     </button>
                  </div>
               </div>

            </form>
         </div>
      </div>
   </div>
</div>