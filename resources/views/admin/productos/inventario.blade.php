{{-- Carga de  Productos --}}
<div class="caja_modal" ng-show="formulario_inventario">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>INVENTARIOS</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">

            <form class="form-horizontalconten" name="frmnew" ng-submit="guardarEntradaProducto()">

               <div class="form-group sed-container full cross-end spd spi">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="medida">Producto</label>
                     <ol class="nya-bs-select mol relcont" name="medida" ng-model="prodInventario.producto"  ng-click="selectProductoI()" data-live-search="true"  title="Selecciona..." data-size="10">

                        <li nya-bs-option="producto in Allproductos" data-value="producto">
                           <a>
                              <strong >@{{ producto.nombre }}</strong>
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="ed-item s-100 m-50 spi">
                     <label for="fecha">Fecha</label>
                     <input id="fecha" type="date" class="form-control" name="fecha" ng-model="prodInventario.fecha" required>
                  </div>
               </div>

               {{-- <h4>Precio de venta</h4>
               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi spd" ng-if="prodInventario.producto.medida.codigo=='M001'">
                     <label for="precioP">Caja</label>
                     <input id="precioP" type="number" step="0.01" class="form-control sinp" name="precioP" ng-model="prodInventario.producto.precio_caja" value="0" disabled>
                  </div>

                  <div class="ed-item s-100 m-50 spd">
                     <label for="precioU">Unitario</label>
                     <input id="precioU" type="number" step="0.01" class="form-control sinp" name="precioU" ng-model="prodInventario.producto.precio_unitario" value="0" disabled>
                  </div>
               </div> --}}

               {{-- <h4>Descuentos</h4>
               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="des_cliente">Descuento de cliente</label>
                     <input id="des_cliente" type="text" class="form-control sinp" name="des_cliente" ng-model="prodInventario.producto.descuento_producto.descuento_cliente" value="0" placeholder="2%">
                  </div>

                  <div class="ed-item s-100 m-50 spd">
                     <label for="des_pago">Descuento pronto pago</label>
                     <input id="des_pago" type="text" class="form-control sinp" name="des_pago" ng-model="prodInventario.producto.descuento_producto.pronto_pago" value="0" placeholder="1%">
                  </div>
               </div> --}}

               <h4>Agregar</h4>
               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-40 spi spd">
                     <label for="presentacion">Presentacion</label>
                     <input id="presentacion" type="text" class="form-control sinp" name="presentacion"  ng-model="prodInventario.producto.medida.nombre" readonly>
                  </div>

                  <div class="ed-item s-100 m-30 spd">
                     <label for="cantidad">cantidad</label>
                     <input id="cantidad" type="number" ng-min="1" ng-pattern="/^-?[0-9][^\.]*$/" class="form-control sinp" name="cantidad" ng-model="prodInventario.producto.cantidad"  required>
                  </div>

                  <div class="ed-item s-100 m-30 spd">
                     <label for="costo">costo</label>
                     <input id="costo" type="number" step="0.01"  ng-min="1" class="form-control sinp" name="costo" ng-model="prodInventario.producto.costo"  required>
                  </div>

               </div>


               {{-- cambiar --}}
               {{-- ingresar precio de venta de unidad y por caja --}}
               {{-- agregar el distribuidor --}}
               {{-- datos de documento de compra --}}
               {{-- agregar detalle de inventarios (pedidos) --}}
               {{-- Ajuste de inventario devoluciones o producto dañado --}}

               {{-- CARDEX --}}
               <div class="form-group ed-container full" style="max-height: 350px; overflow: auto;">
                  <div class="ed-item s-100 spi spd">
                     <table class="table table-striped mtop_table table_phone">
                        <thead>
                           <tr class="flex">
                              <th class="title_table thico col-sm-4">Fecha</th>
                              <th class="title_table col-sm-2">Entradas</th>
                              <th class="title_table col-sm-2">costo</th>
                              <th class="title_table col-sm-2">Salida</th>
                              <th class="title_table col-sm-2">Disponible</th>
                           </tr>
                        </thead>

                        <tbody>
                           <tr ng-repeat="mov in movimientoProducto | orderBy:mov.fecha" class="flex">
                              <td class="body_table col-sm-4"><span>@{{mov.fecha | amDateFormat:'DD/MM/Y'}}</span></td>
                              <td class="body_table col-sm-2"><span>@{{mov.tipo=='entrada' ? mov.cantidad : 0}}</span></td>
                              <td class="body_table col-sm-2"><span>@{{mov.tipo=='entrada' ? mov.costo : 0 | number:2}}</span></td>
                              <td class="body_table col-sm-2"><span>@{{mov.tipo=='salida' ? mov.cantidad : 0}}</span></td>
                              <td class="body_table col-sm-2"><span>@{{mov.disponible | number:2}}</span></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                        Agregar
                     </button>
                  </div>
               </div>
            </form>

         </div>
      </div>
   </div>
</div>
