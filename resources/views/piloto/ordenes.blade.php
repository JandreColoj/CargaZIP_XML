@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="OrdenesCtrl" ng-cloak>
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
               <a class="btn btn-primary  btn-login" ng-click="cerrar()">Cerrar</a>
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
                  <h1 class="title_pedido">Pedido No. @{{ selectPedido.no_orden}}</h1>
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
                        <p>@{{selectPedido.created_at | amDateFormat:'DD/MM/Y H:m'}}</p>
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
                              <p><b>Negocio:</b> @{{ selectPedido.cliente.nombre}}</p>
                              <p><b>Contacto:</b> @{{ selectPedido.usuario.nombre }}</p>
                              <p><b>Dirección:</b> @{{ selectPedido.direccion.ubicacion }}</p>
                              <p><b>Teléfono:</b> @{{ selectPedido.usuario.telefono }}</p>
                              {{-- <p><b>Tipo de pedido:</b> @{{ selectPedido.usuario.tipo.nombre }}</p> --}}
                           </div>
                        </div>

                        <div class="ed-item s-50 spd" ng-if="selectPedido.piloto != null || pilotoAsing">
                           <div class="content_info">
                              <p><b>Repartido:</b> @{{ selectPedido.piloto.nombre}} @{{ selectPedido.piloto.apellido}} | @{{ selectPedido.piloto.telefono }}</p>
                              <p><b>Desde punto:</b> @{{ selectPedido.direccion.ubicacion }}</p>
                              <p><b>Entrega estimada:</b> @{{selectPedido.fecha_entrega | amDateFormat:'DD/MM/Y H:mm'}}</p>
                              <p><b>Forma de Pago:</b> @{{ selectPedido.metodo_pago.metodo.nombre }}</p>
                           </div>
                        </div>
                     </div>

                     <div class="container_estadop" ng-if="cancelado">
                        <div class="pedido_cancelado" ng-if="cancelado">
                           <div class="pedido_cancelado"></div>
                           <p>Pedido Cancelado</p>
                        </div>
                     </div>

                     <div class="ed-container full" ng-if="nuevo_pedido || bodega || estado_pedido">
                        <form class="form-horizontal ed-item s-100 spi spd" name="frm">
                           <div class="container_titlebox__pedido" ng-class="{'p_scroll': selectPedido.productos_pedidos.length >= 6}">
                              <div class="ed-item ed-container full head_box__productostitle">
                                 <div class="ed-item s-15 main-start cross-center">SKU</div>
                                 <div class="ed-item s-40 main-start cross-center">Producto</div>
                                 <div class="ed-item s-10 main-center cross-center">Cantidad</div>
                                 <div class="ed-item s-10 main-center cross-center">Precio</div>
                                 <div class="ed-item s-15 main-center cross-center">Subtotal</div>
                                 <div class="ed-item s-10 main-start cross-center">Estado</div>
                              </div>
                           </div>

                           <div class="scroll_pedidos">
                              <div class="ed-container full box_detalleproducto"
                                   ng-class="{'mb_nuevopedido': nuevo_pedido, 'mb_proceso': !nuevo_pedido}">

                                 <div class="ed-item ed-container full body_box" ng-repeat="productoP in selectPedido.productos_pedidos">
                                    <div class="ed-item s-15">@{{ productoP.producto.sku }}</div>
                                    <div class="ed-item s-40">@{{ productoP.producto.nombre }}</div>
                                    <div class="ed-item s-10 main-center cross-center">@{{ productoP.cantidad }}</div>
                                    <div class="ed-item s-10 main-center cross-center">GTQ @{{ productoP.precio | number:2 }}</div>
                                    <div class="ed-item s-15 main-center cross-center">GTQ @{{ productoP.precio * productoP.cantidad | number:2 }}</div>
                                    <div class="ed-item s-10 main-center cross-center">
                                       <div class="chk_cuentas" ng-if="selectPedido.estado.codigo == 3">
                                          <input id="@{{productoP.producto.id+productoP.producto.medida}}" type="checkbox" ng-model="option.selected" ng-change="change(productoP,this)" required>
                                          <label for="@{{productoP.producto.id+productoP.producto.medida}}" class="chk-label"></label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="ed-item ed-container full main-center cross-center">

                              <div ng-if="selectPedido.estado.codigo == 3">
                                 <div class="ed-item ed-container full main-center cross-center">
                                    <div class="ed-item s-100 spi spd main-center cross-center">
                                       <label>Fecha estidama de entrega: (En formato de 24hrs) </label>
                                    </div>

                                    <div class="ed-item s-50 spi">
                                       <input type="date" class="form-control" ng-model="cambio.fecha" required>
                                    </div>

                                    <div class="ed-item s-50 spd">
                                       <input type="time" class="form-control" ng-model="cambio.hora" required>
                                    </div>

                                    <div class="ed-item s-100 spi spd main-center cross-center">
                                       <button type="button" class="btn btn_bodega" ng-click="cambiarFecha()">Cambiar fecha </button>
                                    </div>
                                 </div>
                              </div>

                              <div class="ed-item s-60 main-center cross-center">
                                 <label>Observaciones:</label>
                                 <div class="ed-item s-100 spi">
                                    <input type="text" class="form-control" ng-model="selectPedido.observacion">
                                 </div>
                              </div>

                              <div class="ed-item s-50 main-center cross-center" ng-if="selectPedido.estado.codigo == 3">
                                 <button type="button" class="btn btn_bodega" ng-click="realizarPedido()" ng-disabled="frm.$invalid">
                                    Recibir Pedido
                                 </button>
                              </div>

                           </div>
                        </form>
                     </div>
                  </div>

                  <div class="container_ruta ed-container full main-center cross-center" ng-if="ruta_pedido">

                     <div class="ed-item s-100" style="min-height: 300px">
                        <h2>Acá va el mapa de la ruta</h2>
                     </div>

                     <div class="ed-item s-100 main-center cross-center">
                        <div class="ed-item s-50 main-center cross-center" >
                           <input type="text" class="form-control" ng-model="selectPedido.observacion" placeholder="Motivo de la devolución">
                           <button type="button" class="btn btn_bodega" ng-click="devolverPedido()"> Devoluciones</button>
                        </div>
                     </div>

                  </div>

                  <div class="content_total">
                     <h2>Total pedido <span>GTQ @{{ selectPedido.total | number:2 }}</span></h2>
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
                     <div class="col-sm-4">
                        <label for="">Buscar por</label>
                        <input class="form-control" type="text"  ng-model="filtro.busqueda" placeholder="No. Orden o Cliente">
                     </div>
                     <div class="col-sm-2 spi">
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
                        <label for="">Fecha inicio</label>
                        <input class="form-control" type="date" placeholder="Fecha Inicio" ng-model="filtro.fechaInicio">
                     </div>
                     <div class="col-sm-2 spi">
                        <label for="">Fecha final</label>
                        <input class="form-control" type="date" placeholder="Fecha Final" ng-model="filtro.fechaFinal">
                     </div>
                     <div class="col-sm-2 spi">
                        <input class="btn-busfiltro" type="submit">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <div class="ed-container full">
         <div class="ed-item s-100 spi spd">
            <div class="container_pedidos">
               <table class="table table-borderless table_separate">
                  <thead class="table_head_pedido">
                     <tr>
                        <th>Estado</th>
                        <th>No. Pedido</th>
                        <th>Cliente</th>
                        <th>Ubicación</th>
                        <th>Total</th>
                        <th>Recibido</th>
                        <th>Entrega estimada</th>
                        <th>Usuario</th>
                        <th>Forma de Pago</th>
                        {{-- <th>Opciones</th> --}}
                     </tr>
                  </thead>

                  <tbody class="table_body_pedido">
                     <tr ng-repeat="pedido in pedidos" ng-click="changeStatus(pedido)">
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
                        <td>@{{pedido.moneda}} @{{pedido.total | number:2}}</td>
                        <td>@{{pedido.created_at | amDateFormat:'DD/MM/Y H:m' }}</td>
                        <td>@{{pedido.fecha_entrega | amDateFormat:'DD/MM/Y H:m'}}</td>
                        <td>@{{pedido.usuario.nombre }}</td>
                        <td class="radius_right">@{{pedido.metodo_pago.metodo.nombre }}</td>
                        {{-- <td class="radius_right">
                           <span ng-if="pedido.estado.codigo > 1" class="ico_visto icotfaq" ng-click="modalDetalle(pedido)"></span>
                        </td> --}}
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
<script src="/js/Controller/piloto/ordenesCtrl.js"></script>
@endpush

