@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="PedidosCtrl" ng-cloak>
   <div class="head_content">
      <h1>Pedidos</h1>
   </div>

   <div class="caja_modal z_loading" ng-if="modalError || modalSuccess || loadding">

      <div class="caja_cargando2 z_loading" ng-class="{'modal_infoss': modal_error}">

         <div class="col-sm-12" ng-if="loadding">
            <div class="cargador topg"></div>
            <p>@{{mensaje}}</p>
         </div>

         <div class="col-sm-12" ng-if="modalSuccess">
            <div class="tranacep topac"></div>
            <p>@{{mensaje}}</p>
            <div class="col-sm-12">
               <a class="btn btn-primary  btn-login" ng-click="cerrar()">Aceptar</a>
            </div>
         </div>

         <div class="col-sm-12 elerror" ng-if="modalError">
            <div class="tranerror topac"></div>
            <p>@{{mensaje}}</p>
            <div class="col-sm-12">
               <a class="btn btn-primary btn-login" ng-click="cerrar()">Cerrar</a>
            </div>
         </div>

      </div>
   </div>

   {{-- Estatus Pedido --}}
      <div class="my_modalpg" ng-if="fondodetalle">
         <div class="modalpg_dialog">
            <div id="area_detallepedido" ng-if="verdetalle">
               <div class="header_dprocuto no_border">
                  <h1 class="title_pedido">Pedido No. @{{ existePedido.no_orden}}</h1>
                  <div class="areacerrar">
                     <a ng-click="showDetalle()" class="icocerrar"></a>
                  </div>
               </div>

               <div class="container_statuspedido">
                  <div class="proces_order" ng-if="!cancelado">
                     <h1>Proceso de pedido</h1>
                     <div class="content_icons__process">
                        <div class="icon_process ico_pnueva" ng-class="{'icon_op': !nuevo_pedido}"></div>
                        <div class="icon_process ico_pbodega" ng-class="{'icon_op': !bodega}"></div>
                        <div class="icon_process ico_pruta" ng-class="{'icon_op': !ruta_pedido}"></div>
                        <div class="icon_process ico_pentregado" ng-class="{'icon_op': !entregado}"></div>

                        <div class="content_line__proces">
                           <div class="line_pedido"
                                ng-class="{'cl_order': nuevo_pedido, 'cl_bodega': bodega, 'cl_ruta': ruta_pedido, 'cl_entregado': entregado}">
                           </div>
                        </div>
                     </div>

                     <div class="content_datosvitacora">
                        <p>@{{existePedido.created_at | amDateFormat:'DD/MM/Y H:m'}}</p>
                        <p>@{{bitacora.bodega.created_at | amDateFormat:'DD/MM/Y H:m'}}</p>
                        <p>@{{bitacora.ruta.created_at | amDateFormat:'DD/MM/Y H:m'}}</p>
                        <p>@{{bitacora.completado.created_at | amDateFormat:'DD/MM/Y H:m'}}</p>
                     </div>
                  </div>

                  <div class="datos_pedido" ng-if="nuevo_pedido || bodega || estado_pedido">
                     <h1>Ficha de Pedido</h1>
                     <div class="ed-container full">
                        <div class="ed-item s-50 spi">
                           <div class="content_info">
                              <p><b>Negocio:</b> @{{ existePedido.cliente.nombre}}</p>
                              <p><b>Contacto:</b> @{{ existePedido.usuario.nombre }}</p>
                              <p><b>Dirección:</b> @{{ existePedido.direccion.ubicacion }}</p>
                              <p><b>Teléfono:</b> @{{ existePedido.usuario.telefono }}</p>
                              {{-- <p><b>Tipo de pedido:</b> @{{ existePedido.usuario.tipo.nombre }}</p> --}}
                           </div>
                        </div>

                        <div class="ed-item ed-container s-50 spd" ng-if="asignar_piloto">
                           <form class="form-horizontal form_piloto" name="frmnew" ng-submit="asignarPiloto()">
                              <div class="ed-container full main-center cross-center">
                                 <div class="ed-item s-100 m-65 main-center cross-center">
                                    <label>Selecciona el Piloto</label>
                                    <ol class="nya-bs-select mol relcont" name="medida" ng-model="dataAsignar.id_piloto" data-live-search="true"
                                       title="Selecciona..." data-size="20">
                                       <li nya-bs-option="r in pilotos" data-value="r.id">
                                          <a>
                                             <b ng-if="r.id!=0"> @{{r.user.name}}</b> @{{r.vehiculo.modelo_vehiculo}}
                                             <span class="glyphicon glyphicon-ok check-mark"></span>
                                          </a>
                                       </li>
                                    </ol>
                                 </div>

                                 <div class="ed-item s-100 m-65 main-center cross-center">
                                    <label>Fecha de entrega</label>
                                    <div class="ed-item s-100 m-50 spi">
                                       <input type="date" class="form-control" ng-model="dataAsignar.fecha_entrega" required>
                                    </div>
                                    <div class="ed-item s-100 m-50 spd">
                                       <input type="time" class="form-control" ng-model="dataAsignar.hora_entrega" required>
                                    </div>
                                 </div>

                                 <div class="ed-item s-100 m-65 main-center cross-center">
                                    <label>Observaciones:</label>
                                    <div class="ed-item s-100 spi">
                                       <input type="text" class="form-control" ng-model="dataAsignar.observacion">
                                    </div>
                                 </div>
                              </div>

                              <div class="ed-container full main-center cross-center">
                                 <div class="ed-item s-100 m-65 main-center cross-center">
                                    <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                                       Asignar Pedido
                                    </button>
                                 </div>
                              </div>
                           </form>
                        </div>

                        <div class="ed-item s-50 spd" ng-if="existePedido.piloto != null || pilotoAsing">
                           <div class="content_info">
                              <p><b>Repartido:</b> @{{ existePedido.piloto.nombre}} @{{ existePedido.piloto.apellido}} | @{{ existePedido.piloto.telefono }}</p>
                              <p><b>Desde punto:</b> @{{ existePedido.direccion.ubicacion }}</p>
                              <p><b>Entrega estimada:</b> @{{existePedido.fecha_entrega | amDateFormat:'DD/MM/Y H:mm'}}</p>
                              <p><b>Forma de Pago:</b> @{{ existePedido.metodo_pago.metodo.nombre }}</p>
                           </div>
                        </div>
                     </div>

                     <div class="container_estadop" ng-if="cancelado">
                        {{-- <div class="pedido_aceptado" ng-if="entregado estado_pedido">
                           <div class="ico_aceptado"></div>
                           <p>Pedido Entregado</p>
                        </div> --}}

                        <div class="pedido_cancelado" ng-if="cancelado">
                           <div class="pedido_cancelado"></div>
                           <p>Pedido Cancelado</p>
                        </div>
                     </div>

                     <div class="ed-container full" ng-if="nuevo_pedido && !asignar_piloto || bodega || estado_pedido">
                        <div class="ed-item s-100 spi spd">
                           <div class="container_titlebox__pedido" ng-class="{'p_scroll': existePedido.productos_pedidos.length >= 5}">
                              <div class="ed-item ed-container full head_box__productostitle">
                                 <div class="ed-item s-15 main-start cross-center">SKU</div>
                                 <div class="ed-item s-50 main-start cross-center">Producto</div>
                                 <div class="ed-item s-10 main-center cross-center">Cantidad</div>
                                 <div class="ed-item s-10 main-center cross-center">Precio</div>
                                 <div class="ed-item s-15 main-center cross-center">Subtotal</div>
                              </div>
                           </div>

                           <div class="scroll_pedidos">
                              <div class="ed-container full box_detalleproducto"
                                   ng-class="{'mb_nuevopedido': nuevo_pedido, 'mb_proceso': !nuevo_pedido}">

                                 <div class="ed-item ed-container full body_box" ng-repeat="productoP in existePedido.productos_pedidos">
                                    <div class="ed-item s-15">@{{ productoP.producto.sku }}</div>
                                    <div class="ed-item s-50">@{{ productoP.producto.nombre }}</div>
                                    <div class="ed-item s-10 main-center cross-center">@{{ productoP.cantidad }}</div>
                                    <div class="ed-item s-10 main-center cross-center">GTQ @{{ productoP.precio | number:2 }}</div>
                                    <div class="ed-item s-15 main-center cross-center">GTQ @{{ productoP.precio * productoP.cantidad | number:2 }}</div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="ed-item s-100 main-center cross-center" ng-if="!bodega && !estado_pedido">
                           <button type="button" class="btn btn_bodega" ng-click="showPilotos()">Agregar Piloto</button>
                        </div>
                     </div>
                  </div>

                  <div class="container_ruta" ng-if="ruta_pedido">
                     <h2>Acá va el mapa de la ruta</h2>
                  </div>

                  <div class="content_total">
                     <h2>Total pedido <span>GTQ @{{ existePedido.total | number:2 }}</span></h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
   {{-- Fin Estatus Pedido --}}

   <div class="dash_content">
      {{-- Filtro de busqueda --}}
      <div class="ed-container full">
         <div class="ed-item s-100 spi spd">
            <div class="container_filtro">
               <form ng-submit="getPedidos()">
                  <div class="row">
                     <div class="col-sm-2">
                        <label for="">Buscar por</label>
                        <input class="form-control" type="text"  ng-model="filtro.busqueda" placeholder="No. Orden o Cliente">
                     </div>
                     <div class="col-sm-1 spi">
                        <label for="estado">Estado</label>
                        <ol class="nya-bs-select mol relcont" ng-model="filtro.estado"  title="Selecciona...">

                           <li nya-bs-option="estado in Estados" data-value="estado.codigo" >
                              <a>
                                 @{{ estado.nombre }}
                                 <span class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                        </ol>
                     </div>
                     <div class="col-sm-2 spi">
                        <label for="estado">Piloto</label>
                        <ol class="nya-bs-select mol relcont" ng-model="filtro.piloto"  title="Selecciona..."  data-size="10">
                           <li nya-bs-option="piloto in pilotos" data-value="piloto.id">
                              <a>
                                 @{{ piloto.user.name }}
                                 <span class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                        </ol>
                     </div>

                     <div class="col-sm-2 spi">
                        <label for="estado">Vendedor</label>
                        <ol class="nya-bs-select mol relcont" ng-model="filtro.vendedor"  title="Selecciona..."  data-size="10">
                           <li nya-bs-option="vendedor in vendedores" data-value="vendedor.id">
                              <a>
                                 @{{ vendedor.user.name }}
                                 <span class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                        </ol>
                     </div>
                     <div class="col-sm-2 spi">
                        <label for="">Fecha inicio</label>
                        <input class="form-control" type="date" placeholder="Fecha Inicio" ng-model="filtro.fechaInicio">
                     </div>
                     <div class="col-sm-2 spi">
                        <label for="">Fecha final</label>
                        <input class="form-control" type="date" placeholder="Fecha Final" ng-model="filtro.fechaFinal">
                     </div>
                     <div class="col-sm-1 spi">
                        <input class="btn-busfiltro" type="submit">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>

      {{-- Resultados --}}
      <div class="ed-container full">
         <div class="ed-item s-100 spi spd">
            <div class="container_resultado">
               <div class="row">
                  <div class="col-sm-2">
                     <h3 class="resultah3">@{{resumen.total_pedidos}}</h3>
                     <h2>Total de pedidos</h2>
                  </div>

                  <div class="col-sm-2">
                     <h3 class="resultah3">@{{resumen.pedidos_completos}}</h3>
                     <h2>Pedidos Completados</h2>
                  </div>

                  <div class="col-sm-6">
                     <div id="containerestado"></div>
                  </div>

                  <div class="col-sm-2">
                     <div class="area_descarga">
                        <div class="excel" ng-click="exportExcel()" style="cursor:pointer"> Excel</div>
                        <div class="pdf">PDF</div>
                     </div>
                     <h2>Descargar</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{-- Listado de pedidos --}}
      <div class="ed-container full">
         <div class="ed-item s-100 spi spd">
            <div class="container_pedidos" id="exportable">
               <table class="table table-borderless table_separate">
                  <thead class="table_head_pedido">
                     <tr>
                        <th>Estado</th>
                        <th>No. Pedido</th>
                        <th>Cliente</th>
                        <th>Ubicación</th>
                        <th>Piloto</th>
                        <th>Total</th>
                        <th>Recibido</th>
                        <th>Entrega estimada</th>
                        <th>Tipo</th>
                        <th>Usuario</th>
                        <th>Forma de Pago</th>
                     </tr>
                  </thead>

                  <tbody class="table_body_pedido" infinite-scroll="morePedidos()">
                     <tr ng-repeat="pedido in pedidos" ng-click="changeStatus(pedido)" ng-class="{'negrita' : pedido.estado.codigo==1}">
                        <td class="radius_left">
                           <div ng-switch="pedido.estado.codigo">
                              <span class="icon_status ico_norden" ng-switch-when="1" data-tippy-content="Nuevo Pedido"></span>
                              <span class="icon_status ico_norden" ng-switch-when="2" data-tippy-content="Nuevo Pedido"></span>
                              <span class="icon_status ico_bodega" ng-switch-when="3" data-tippy-content="En Bodega"></span>
                              <span class="icon_status ico_ruta" ng-switch-when="4" data-tippy-content="En Ruta"></span>
                              <span class="icon_status ico_entregado" ng-switch-when="5" data-tippy-content="Entregado"></span>
                              <span class="icon_status ico_incompleto" ng-switch-when="6" data-tippy-content="Incompleto"></span>
                              <span class="icon_status ico_cancelado" ng-switch-when="7" data-tippy-content="Cancelado"></span>
                              <span class="icon_status ico_devoluciones" ng-switch-when="8" data-tippy-content="Devolucion"></span>
                           </div>
                        </td>
                        <td>@{{pedido.no_orden}}</td>
                        <td>@{{pedido.cliente.nombre}} @{{pedido.cliente.apellido}}</td>
                        <td>@{{pedido.cliente.ubicacion}}</td>
                        <td>@{{pedido.piloto.nombre}} @{{pedido.piloto.apellido}}</td>
                        <td>@{{pedido.moneda}} @{{pedido.total | number:2}}</td>
                        <td>@{{pedido.created_at | amDateFormat:'DD/MM/Y h:mm' }}</td>
                        <td>@{{pedido.fecha_entrega | amDateFormat:'DD/MM/Y H:mm'}}</td>
                        <td>@{{pedido.usuario.tipo.nombre }}</td>
                        <td>@{{pedido.usuario.nombre }}</td>
                        <td class="radius_right">@{{pedido.metodo_pago.metodo.nombre }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <div class="modal-backdrop_pg" ng-if="fondodetalle" ng-click="showDetalle()"></div>
</div>
@endsection

@push('scripts')
<script src="/js/Controller/Pedidos/PedidosCtrl.js"></script>
@endpush

