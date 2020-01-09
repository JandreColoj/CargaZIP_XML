@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="EscritorioCtrl" ng-cloak>

   <div class="caja_modal" ng-if="asignarMeta">

      <div class="caja_cargando2">
         <form class="ed-container full main-center cross-center form_meta" name="frmnew" ng-submit="setAsignarMeta()">
            <div class="ed-item s-100 main-center cross-center">
               <label>Cantidad Meta</label>
               <input type="number"  min="0" step="any" class="form-control nobordere sinp" ng-model="metas.cantidad">
            </div>

            <div class="ed-item s-100 main-center cross-center">
               <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                  Guardar
               </button>
            </div>
         </form>
      </div>
   </div>

   <div class="head_content">
      <h1>Escritorio</h1>
   </div>

   <div class="dash_content">
      <div class="boxdata_container">
         <div class="ed-container full">
            <div class="boxdata_cardcontainer">
               <div class="boxdata_item">
                  <div class="head_box__reports">
                     <div class="ed-container full">
                        <div class="ed-item s-80">
                           <p class="monto_total">@{{resumen.moneda}} @{{resumen.venta_year | number:2}}</p>
                           <span class="title_box__reports">Ventas Totales</span>
                        </div>
                        <div class="ed-item s-20 spi spd">
                           <div class="icon_ventast"></div>
                        </div>
                     </div>
                  </div>

                  <div class="body_box__reports">
                     <div class="content_chart" id="container_venta">
                     </div>

                     <div class="bottom_chart">
                        <div class="ed-container full">
                           <div class="ed-item s-50 spd spi">
                              <div class="content_number">
                                 <h3>@{{resumen.moneda}} @{{resumen.venta_semana | number:2}}</h3>
                                 <p>Semana Pasada</p>
                              </div>
                           </div>

                           <div class="ed-item s-50 spd spi">
                              <div class="content_number">
                                 <h3>@{{resumen.moneda}} @{{resumen.venta_mes | number:2}}</h3>
                                 <p>Mes Pasado</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="boxdata_item">
                  <div class="head_box__reports">
                     <div class="ed-container full">
                        <div class="ed-item s-80">
                           <p class="monto_total">@{{resumen.moneda}} @{{resumen.promedio_year | number:2}}</p>
                           <span class="title_box__reports">Ventas Promedio</span>
                        </div>

                        <div class="ed-item s-20 spi spd">
                           <div class="icon_promedio"></div>
                        </div>
                     </div>
                  </div>

                  <div class="body_box__reports">
                     <div class="content_chart" id="container_promedio">

                     </div>

                     <div class="bottom_chart">
                        <div class="ed-container full">
                           <div class="ed-item s-50 spd spi">
                              <div class="content_number">
                                 <h3>@{{resumen.moneda}} @{{resumen.promedio_semana | number:2}}</h3>
                                 <p>Semana Pasada</p>
                              </div>
                           </div>

                           <div class="ed-item s-50 spd spi">
                              <div class="content_number">
                                 <h3>@{{resumen.moneda}} @{{resumen.promedio_mes | number:2}}</h3>
                                 <p>Mes Pasado</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="boxdata_item">
                  <div class="head_box__reports">
                     <div class="ed-container full">
                        <div class="ed-item s-80">
                           <p class="monto_total">@{{resumen.suma_pedidos}}</p>
                           <span class="title_box__reports">Pedidos</span>
                        </div>

                        <div class="ed-item s-20 spi spd">
                           <div class="icon_trandesk"></div>
                        </div>
                     </div>
                  </div>

                  <div class="body_box__reports">
                     <div class="content_chart" id="container_pedidos">

                     </div>

                     <div class="bottom_chart">
                        <div class="ed-container full">
                           <div class="ed-item s-50 spd spi" ng-repeat="pedidos in resumen.total_pedidos" ng-if="pedidos.estado.codigo==1 || pedidos.estado.codigo==5">
                              <div class="content_number">
                                 <h3>@{{pedidos.cantidad}}</h3>
                                 <p>@{{pedidos.estado.nombre}}</p>
                              </div>
                           </div>

                           {{-- <div class="ed-item s-50 spd spi">
                              <div class="content_number">
                                 <h3>1,000</h3>
                                 <p>Fallidas</p>
                              </div>
                           </div> --}}
                        </div>
                     </div>
                  </div>
               </div>

               <div class="boxdata_item">
                  <div class="head_box__reports">
                     <div class="ed-container full">
                        <div class="ed-item s-80">
                           <p class="monto_total">@{{resumen.total_clientes}}</p>
                           <span class="title_box__reports">Clientes</span>
                        </div>

                        <div class="ed-item s-20 spi spd">
                           <div class="icon_clientesrp"></div>
                        </div>
                     </div>
                  </div>

                  <div class="body_box__reports">
                     <div class="content_chart" id="container_clientes">

                     </div>

                     <div class="bottom_chart">
                        <div class="ed-container full">
                           <div class="ed-item s-50 spd spi">
                              <div class="content_number">
                                 <h3>@{{resumen.clientes_mes_actual}}</h3>
                                 <p>Este Mes</p>
                              </div>
                           </div>

                           <div class="ed-item s-50 spd spi">
                              <div class="content_number">
                                 <h3>@{{resumen.clientes_mes}}</h3>
                                 <p>Mes Pasado</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="ed-container full">
         <div class="ed-item s-100 m-75 spi report_nopadding">
            <div class="box_new__reports">
               <div class="head_reports">
                  <h3>Ventas</h3>

                  <div class="ico_ventas_box"></div>
               </div>

               <div class="body_chart_new">
                  <div class="content_ventasnumber">
                     <div class="ed-container full">
                        <div class="ed-item ed-container s-50 m-20 spi">
                           <div class="ed-item s-100">
                              <p class="title_vnew">Este Mes</p>
                           </div>
                           <div class="ed-item s-100">
                              <p class="title_mes">@{{resumen.moneda}} @{{resumen.venta_mes_actual | number:2}}</p>
                           </div>
                        </div>
                        <div class="ed-item ed-container s-50 m-20 spi">
                           <div class="ed-item s-100">
                              <p class="title_vnew">Mes Pasado</p>
                           </div>
                           <div class="ed-item s-100">
                              <p class="title_mesp">@{{resumen.moneda}} @{{resumen.venta_mes | number:2}}</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="container__linechart" id="container_venta_diaria"></div>
               </div>
            </div>
         </div>

         <div class="ed-item s-100 m-25 spd report_nopadding">
            <div class="box_new__reports">
               <div class="head_reports">
                  <h3>Metas</h3>

                  <div class="ico_metas"></div>
               </div>

               <div class="body_chart_new">
                  <div class="content_progresschart" id="container_metas"></div>
                  <div class="footer_meta">
                     <div class="ed-container full">
                        <div class="ed-item s-100 spi spd cross-center">
                           <div class="container_meta active_meta">
                              <span class="edit_meta" ng-click="asignarMeta = true">Editar</span>
                              <p class="title_meta">Ventas</p>
                              <p class="meta_number">@{{resumen.moneda}} @{{resumen.venta_mes_actual | number:2}}</p>
                              <p class="sub_meta">Meta @{{resumen.moneda}} @{{resumen.venta_metas | number:2}}</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="ed-container full">
         <div class="ed-item s-100 spi report_nopadding">
            <div class="box_new__reports">
               <div class="head_reports">
                  <h3>Ultimas Ventas</h3>

                  <div class="ico_ventasprodrp"></div>
               </div>

               <div class="body_chart_new">
                  <div class="ed-container full">
                     <div class="ed-item s-100 spi spd">
                        <div class="container_ventasrp">
                           <table class="table table-borderless table_separate">
                              <thead class="table_head_pedido">
                                 <tr>
                                    <th>Estado</th>
                                    <th>No. pedido</th>
                                    <th>Cliente</th>
                                    <th>Direccion</th>
                                    <th>Total</th>
                                 </tr>
                              </thead>

                              <tbody class="table_body_pedido">
                                 <tr  ng-repeat="pedido in pedidos">
                                    <td class="radius_left">
                                       <div ng-switch="pedido.estado.codigo">
                                          <span class="icon_status ico_norden" ng-switch-when="1" data-tippy-content="Nuevo Pedido"></span>
                                          <span class="icon_status ico_norden" ng-switch-when="2" data-tippy-content="Nuevo Pedido"></span>
                                          <span class="icon_status ico_bodega" ng-switch-when="3" data-tippy-content="En Bodega"></span>
                                          <span class="icon_status ico_ruta" ng-switch-when="4" data-tippy-content="En Ruta"></span>
                                          <span class="icon_status ico_entregado" ng-switch-when="5" data-tippy-content="Entregado"></span>
                                          <span class="icon_status ico_incompleto" ng-switch-when="6" data-tippy-content="Incompleto"></span>
                                          <span class="icon_status ico_cancelado" ng-switch-when="7" data-tippy-content="Cancelado"></span>
                                       </div>
                                    </td>
                                    <td>@{{pedido.no_orden}}</td>
                                    <td>@{{pedido.cliente.nombre}}</td>
                                    <td>@{{pedido.direccion.ubicacion}}</td>
                                    <td class="radius_right"> @{{resumen.moneda}} @{{pedido.total}}</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         {{-- <div class="ed-item s-100 m-25 spd report_nopadding">
            <div class="box_new__reports">
               <div class="head_reports">
                  <h3>Liquidaciones</h3>

                  <div class="ico_liqui"></div>
               </div>

               <div class="body_chart_new">
                  <div class="ed-container full cross-start">
                     <div class="ed-item s-100">
                        <p class="title_liquis">$ 350,000</p>
                     </div>

                     <div class="ed-item s-100">
                        <p class="sub_liquis">Liquidaciones totales</p>
                     </div>

                     <div class="ed-item ed-container s-100 top_liquis">
                        <div class="ed-item s-50">
                           <h4 class="title_fechal">Fecha</h4>
                           <p class="text_liqui">02/10/2019</p>
                           <p class="text_liqui">02/10/2019</p>
                           <p class="text_liqui">02/10/2019</p>
                        </div>

                        <div class="ed-item s-50">
                           <h4 class="title_fechal text_rigth_liqui">Monto</h4>
                           <p class="text_liqui text_rigth_liqui">$ 20,000</p>
                           <p class="text_liqui text_rigth_liqui">$ 20,000</p>
                           <p class="text_liqui text_rigth_liqui">$ 20,000</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div> --}}
      </div>

   </div>
</div>
@endsection

@push('scripts')
   <script src="/js/Controller/EscritorioCtrl.js"></script>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBd0OKsKH-yYSJIYAZ3vaKC_NmxB05rqsI&libraries=visualization"></script>
@endpush

