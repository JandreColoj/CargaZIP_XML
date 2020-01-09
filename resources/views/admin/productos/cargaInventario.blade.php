{{-- Carga de  Productos --}}
<div class="caja_modal" ng-if="formulario_carga_inv">
   <div id="modal_nuevo" class="carga__inventario">
      <div class="header_area">
         <h1>Carga de Inventario</h1>
         <div class="areacerrar">
            <a ng-click="cerrarCarga()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">

            {{-- CARGA EXCEL --}}
            <div class="col-sm-12 col-xs-12 spd spi">
               <div class="ed-container">
                  <div class="ed-item s-100">
                     <div class="form-group container_formcuentas">

                        <label for="excel" class="label_filec">
                           <span>@{{nombreArchivo}}</span>
                           <strong>
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25">
                                 <path fill="#fff" d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                              </svg>
                              <p>Seleccione un archivo</p>
                           </strong>
                        </label>
                        <js-xls onread="read" onerror="error" class="form-control snip input_file inputfile" style="visibility:hidden;" id="excel"></js-xls>
                     </div>
                  </div>

                  <div class="form-group btnbox_center ed-item s-100">
                     <a href="https://pagalocard.s3.amazonaws.com/pagaloPOS/PlantillaInventario.xlsx" class="link_plantilla">Descargar plantilla</a>
                  </div>
               </div>

               <div class="center_formcxc menarea" ng-if="showError">
                  <span> @{{mierror}}</span>
               </div>
            </div>

            {{-- LISTADO DE PRODUCTOS CARGADOS --}}
            <div class="col-xs-12 spd spi content__datac" ng-if="datosExcel.length > 0">

               <table class="table table-borderless table_separate">
                  <thead class="table_head_order">
                     <tr>
                        <th>Celda</th>
                        <th>fecha</th>
                        <th>SKU</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Presentación</th>
                        <th>costo</th>
                        <th>Precio Venta</th>
                     </tr>
                  </thead>

                  <tbody class="table_body_order">
                     <tr ng-repeat="data in datosExcel"  ng-class="{celdaInvalid : data.id_producto==0 || !data.cantidadInteger || !data.unidadInteger || !data.precioFloat || !data.costoFloat || !data.formatDate}">
                        <td class="radius_left">@{{$index+2}}</td>
                        <td>@{{data.fecha}}</td>
                        <td>@{{data.sku}}</td>
                        <td>@{{data.nombreProducto}}</td>
                        <td>@{{data.cantidad}}</td>
                        <td>@{{data.nombreMedida}} @{{ data.presentacion=='M001' ? ' - '+data['unidades por caja']+' Unidades' : ''}}</td>
                        <td>@{{data.costo}}</td>
                        <td>@{{data['precio de venta']}}</td>
                     </tr>
                  </tbody>
               </table>

            </div>

            <div class="col-xs-12 spd spi" ng-if="!dataExcelValid">
               <div class="form-group btnbox_center ed-item s-100 menarea">
                  <p>El archivo contiene algunos errores de validación, verifica los datos marcados en rojo y vuelva a intentarlo.</p>
               </div>
            </div>

            <div class="col-sm-12 col-xs-12 spd spi" ng-if="datosExcel.length > 0 && dataExcelValid">
               <div class="form-group btnbox_center ed-item s-100">
                  <button type="button" class="btn btn_save" ng-click="cargaInventario()"> Cargar Inventario </button>
               </div>
            </div>

            {{-- LISTADO DE RESUMEN DE CARGA DE PRODUCTOS --}}
            <div class="col-sm-12 col-xs-12 spd spi content__datac" ng-if="resultadoProductos.length > 0">

               <table class="table table-borderless table_separate">
                  <thead class="table_head_order">
                     <tr>
                        <th>No.</th>
                        <th>sku</th>
                        <th>producto</th>
                        <th>cantidad</th>
                        <th>presentacion</th>
                        <th>Estado</th>
                        <th>comentario</th>
                     </tr>
                  </thead>

                  <tbody class="table_body_order">
                     <tr ng-repeat="data in resultadoProductos"  ng-class="{celdaInvalid : !data.exitoso, celdaValid : data.exitoso}">
                        <td class="radius_left">@{{$index+1}}</td>
                        <td>@{{data.sku}}</td>
                        <td>@{{data.nombreProducto}}</td>
                        <td>@{{data.cantidad}}</td>
                        <td>@{{data.nombreMedida }}</td>
                        <td>@{{data.exitoso ? 'Almacenado' : 'Error' }}</td>
                        <td>@{{data.comentario}}</td>
                     </tr>
                  </tbody>
               </table>

            </div>
         </div>
      </div>
   </div>
</div>
