@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="ClientesCtrl" ng-cloak>

   <div class="head_content">
      <h1>Clientes</h1>
      <div class="cont_btns_head">
         <a ng-click="nuevo_obj=true" class="btn btn_opcion" >Nuevo Cliente</a>
         <a ng-click="carga_obj=true" class="btn btn_opcion" >Cargar Clientes</a>
      </div>
   </div>

   <div class="caja_modal z_loading" ng-if="modalError || modalSuccess || loadding">
      <div class="caja_cargando2" ng-class="{'modal_infoss': modal_error}">
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

   {{-- Filtro de busqueda --}}
   <div class="ed-container full">
      <div class="ed-item s-100 spi spd">
         <div class="container_filtro">
            <form ng-submit="getClientes()">
               <div class="row">
                  <div class="col-sm-5">
                     <label for="">Buscar por</label>
                     <input class="form-control" type="text" name="" id="" ng-model="filtro.palabra" placeholder="Cliente o cualquier dato">
                  </div>
                  <div class="col-sm-2 spi">
                     <label for="estado">Estado</label>
                     <ol class="nya-bs-select mol relcont" ng-model="filtro.estado"  title="Selecciona...">
                        <li nya-bs-option="estado in estadoCliente" data-value="estado">
                           <a>
                              @{{ estado }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="col-sm-2 spi">
                     <label for="">Fecha inicio</label>
                     <input class="form-control" type="date" name="" id="" ng-model="filtro.fechaInicio" placeholder="Fecha Inicio">
                  </div>
                  <div class="col-sm-2 spi">
                     <label for="">Fecha final</label>
                     <input class="form-control" type="date" name="" id="" ng-model="filtro.fechaFinal" placeholder="Fecha Final">
                  </div>
                  <div class="col-sm-1 spi">
                     <input class="btn-busfiltro" type="submit">
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>

   {{-- LISTADO DE CLIENTES E HISTORIAL DE CLIENTE --}}
   <div class="dash_content">
      {{-- LISTADO DE CLIENTES --}}
      <div class="ed-container full">
         <div class="ed-item s-100 spi spd">
            <div class="container_pedidos">
               <table class="table table-borderless table_separate">
                  <thead class="table_head_pedido">
                     <tr>
                        <th>Cliente</th>
                        <th>Teléfono</th>
                        <th>Departamento</th>
                        <th>Municipio</th>
                        <th>Dirección</th>
                        <th>Zona</th>
                        <th>Historial</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                     </tr>
                  </thead>

                  <tbody class="table_body_pedido">
                     <tr ng-repeat="cliente in clientes">
                        <td class="radius_left" ng-click="showModalCliente(cliente)">@{{cliente.nombre}}</td>
                        <td ng-click="showModalCliente(cliente)">@{{cliente.telefono}}</td>
                        <td ng-click="showModalCliente(cliente)">@{{cliente.municipio.departamento.nombre}}</td>
                        <td ng-click="showModalCliente(cliente)">@{{cliente.municipio.nombre}}</td>
                        <td ng-click="showModalCliente(cliente)">@{{cliente.ubicacion}}</td>
                        <td ng-click="showModalCliente(cliente)">@{{cliente.zona}}</td>
                        <td><a href="" ng-click="showModalCliente(cliente)">Ver</a></td>
                        <td ng-if="cliente.estado == 0"> <a href="" ng-click="aceptarCliente(cliente.id)">Aceptar</a> </td>
                        <td ng-if="cliente.estado == 1">Activo</td>
                        <td class="radius_right">
                           <span class="icoeditar icotfaq" ng-click="editCliente(cliente)" data-tippy-content="Editar"></span>
                           <span class="icoeliminar icotfaq" ng-click="inhabilitarCliente(cliente)" ng-if="cliente.estado == 1" ng-class="{'icoeliminarConfirmar': cliente.eliminar}" data-tippy-content="Eliminar"></span>
                           <span class="icoSucursal icotfaq" ng-click="verSucursales(cliente)" data-tippy-content="Sucursales"></span>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <article ng-show="showDataClient">
         <div class="overlay" ng-class="{'modal_active':showDataClient}">
            <div class="popup" ng-class="{'modal_active':showDataClient}">
               <div class="body_popup">
                  <div class="container_tuto">
                     <div class="header_popup head_tuto">
                        <a href="" class="btn-cerrar-popup" ng-click="cerrar()">Cerrar</a>
                     </div>

                     <div class="header_popup head_tuto">
                        <a ng-click="showTablePedidos()" class="btn btn_opcion" >Pedidos</a>
                        <a ng-click="showTableProductos()" class="btn btn_opcion" >Productos</a>
                     </div>

                     <div class="ed-container full">
                        <div class="ed-item s-100">

                           {{-- DETALLE DE PEDIDOS --}}
                           <table class="table table-borderless table_separate" ng-if="tabla_pedidos">
                              <thead class="table_head_order">
                                 <tr>
                                    <th>Fecha de pedido</th>
                                    <th>No. pedido</th>
                                    <th>Total</th>
                                    <th>Fecha de entrega</th>
                                    <th>Estado</th>
                                    <th>Ver pedido</th>
                                 </tr>
                              </thead>

                              <tbody class="table_body_order">
                                 <tr ng-repeat="pedido in pedidosCliente">
                                    <td class="radius_left">@{{pedido.created_at | amDateFormat:'D/MM/Y'  }}</td>
                                    <td>@{{pedido.no_orden}}</td>
                                    <td>@{{pedido.total | number : 2}} @{{pedido.moneda}} </td>
                                    <td>@{{pedido.fecha_entrega | amDateFormat:'D/MM/Y'  }}</td>
                                    <td>
                                       <div ng-switch="pedido.estado">
                                          <span ng-switch-when="3" class="ico_preparando icotfaq" ng-click="modalAsignarPedido(pedido)"></span>
                                          <span ng-switch-when="4" class="ico_encamino icotfaq"></span>
                                          <span ng-switch-when="5" class="ico_entregado icotfaq"></span>
                                          <span ng-switch-when="6" class="ico_incompleto icotfaq"></span>
                                          <span ng-switch-when="7" class="ico_cancelado icotfaq"></span>
                                       </div>
                                    </td>
                                    <td class="radius_right">
                                          <a href="{{env('APP_URL')}}/pedidos?pedido=@{{pedido.id}}" target="_blank" class="ico_visto icotfaq" > </a>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>

                           {{-- DETALLE DE PRODUCTOS --}}
                           <table class="table table-borderless table_separate" ng-if="tabla_productos">
                              <thead class="table_head_order">
                                 <tr>
                                    <th>SKU</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                 </tr>
                              </thead>

                              <tbody class="table_body_order">
                                 <tr ng-repeat="producto in productosCliente">
                                    <td class="radius_left">@{{producto.sku}}</td>
                                    <td>@{{producto.nombre}}</td>
                                    <td>@{{producto.descripcion}} </a></td>
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
   </div>

   {{-- ABC CLIENTES --}}
      @include('admin.clientes.cliente')
   {{-- ABC CLIENTES --}}

   {{-- SUCURSALES --}}
      @include('admin.clientes.sucursales')
   {{-- SUCURSALES --}}

</div>
@endsection

@push('scripts')
<script src="/js/Controller/Cliente/ClientesCtrl.js"></script>
<script src="/js/Controller/Cliente/functionCtrl.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyBd0OKsKH-yYSJIYAZ3vaKC_NmxB05rqsI"></script>
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.9.13/xlsx.full.min.js"></script> --}}
@endpush

