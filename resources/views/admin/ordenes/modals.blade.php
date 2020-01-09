{{--VISTA DE ORDENES --}}

{{-- DETALLE DEL PEDIDO --}}
<article ng-show="showDataClient">
   <div class="overlay" ng-class="{'modal_active':showDataClient}">
      <div class="popup" ng-class="{'modal_active':showDataClient}">
         <div class="body_popup">
            <div class="container_tuto">
               <div class="header_popup head_tuto">
                  <a href="" class="btn-cerrar-popup" ng-click="hideModal()">Cerrar</a>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100">
                     <table class="table table-borderless table_separate">
                        <thead class="table_head_order">
                           <tr>
                              <th>No.</th>
                              <th>sku</th>
                              <th>Producto</th>
                              <th>Cantidad</th>
                              <th>Valor</th>
                              <th>Total</th>
                           </tr>
                        </thead>

                        <tbody class="table_body_order">
                           <tr ng-repeat="detalle in selectPedido">
                              <td class="radius_left">@{{$index+1}}</td>
                              <td>@{{detalle.producto.sku}}</td>
                              <td>@{{detalle.producto.nombre}} <strong> @{{ detalle.promocion==null ? ' ': 'Promocion'}}</strong></td>
                              <td>@{{detalle.cantidad}}</td>
                              <td>@{{detalle.precio | number : 2}}</td>
                              <td class="radius_right"> @{{detalle.precio * detalle.cantidad| number : 2}}</a></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</article>

{{-- ASIGNAR PEDIDO --}}
<article ng-show="modalAsignarP">
   <div class="overlay" ng-class="{'modal_active':modalAsignarP}">
      <div class="popup_small" ng-class="{'modal_active':modalAsignarP}">
         <div class="body_popup">
            <div class="container_tuto">
               <div class="header_popup head_tuto">
                  <a href="" class="btn-cerrar-popup" ng-click="hideModal()">Cerrar</a>
               </div>

               <form class="form-horizontal" name="frmnew" ng-submit="asignarPiloto()">
                  <div class="ed-container full">
                     <div class="ed-item s-100">
                        <label>Selecciona el piloto</label>
                        <ol class="nya-bs-select mol" id="myDrowp1" ng-click="toggleClass('myDrowp1')" ng-model="dataAsignar.id_piloto" data-size="7" data  title="Selecciona..." required>
                           <li nya-bs-option="r in pilotos" data-value="r.id">
                              <a>
                                 <b> @{{r.nombre}} @{{r.apellido}}</b> @{{r.vehiculo.modelo_vehiculo}}
                                 <span class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                        </ol>
                     </div>

                     <div class="ed-item s-100">
                        <label>Fecha de entrega</label>
                        <div class="ed-item s-100 spi">
                           <input type="date" class="form-control" ng-model="dataAsignar.fecha_entrega" required>
                        </div>
                     </div>
                  </div>

                  <div class="ed-container full">
                     <div class="ed-item s-100 main-center cross-center">
                        <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                           Asignar Pedido
                        </button>
                     </div>
                  </div>
               </form>

            </div>
         </div>
      </div>
   </div>
</article>
