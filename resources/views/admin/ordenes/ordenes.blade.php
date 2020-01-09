@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="OrdenesCtrl" ng-cloak>
   <div class="head_content">
      <h1>Ordenes</h1>
   </div>

   <div class="dash_content">

      {{-- MODALS --}}
         @include('admin.ordenes.modals')
      {{-- MODALS --}}

      <div class="ed-container full">
         <div class="ed-item s-100 spi spd main-start cross-center">
            <div class="container_tabs">
               <button type="button" class="btn tab_order" ng-click="switchTab('ordenes')" ng-class="{'active_tab':ordersTab}">
                  Ordenes
               </button>
               {{-- <button type="button" class="btn tab_order" ng-click="switchTab('mapa')" ng-class="{'active_tab':mapTab}">
                  Mapa de Calor
               </button> --}}
            </div>
         </div>
      </div>

      <div class="ed-container full" ng-show="ordersTab">
         <div class="ed-item s-100 spi spd">
            <div class="container_orders">
               <div class="historico_option">
                  <div class="container_btn_fill">
                     <button type="button" class="btn btn_fill" ng-class="{'active': btn_dia}" ng-click="getPedidos('dia')">Día</button>
                     <button type="button" class="btn btn_fill" ng-class="{'active': btn_mes}" ng-click="getPedidos('mes')">Mes</button>
                     <button type="button" class="btn btn_fill" ng-class="{'active': btn_anio}" ng-click="getPedidos('anio')">Año</button>
                  </div>
                  <h1>Historicos</h1>
               </div>

               <div class="list_promos">
                  <table class="table table-borderless table_separate">
                     <thead class="table_head_order">
                        <tr>
                           <th># Orden</th>
                           <th>Fecha</th>
                           <th>Cliente</th>
                           <th>Ubicación</th>
                           <th>Piloto</th>
                           <th>Fecha de entrega</th>
                           <th>Total</th>
                           <th>Opciones</th>
                        </tr>
                     </thead>

                     <tbody class="table_body_order">
                        <tr ng-repeat="pedido in pedidos">
                           <td class="radius_left">@{{pedido.no_orden}}</td>
                           <td>@{{pedido.created_at | amDateFormat:'D/MM/Y' }}</td>
                           <td>@{{pedido.cliente.nombre}} @{{pedido.cliente.apellido}}</td>
                           <td>@{{pedido.cliente.ubicacion}}</td>
                           <td>@{{pedido.piloto.nombre}} @{{pedido.piloto.apellido}}</td>
                           <td>@{{pedido.fecha_entrega | amDateFormat:'D/MM/Y'}}</td>
                           <td>@{{pedido.moneda}} @{{pedido.total | number:2}}</td>
                           <td class="radius_right">

                              <span class="ico_visto icotfaq" ng-click="modalDetalle(pedido)"></span>
                              <span class="ico_preparando icotfaq" ng-if="pedido.estado==2" ng-click="modalAsignarPedido(pedido)"></span>
                              {{-- <a href="#" tooltips tooltip-template="tooltip">Tooltip me</a> --}}
                              <div ng-switch="pedido.estado">
                                 <span ng-switch-when="3" class="ico_preparando icotfaq" ng-click="modalAsignarPedido(pedido)"></span>
                                 <span ng-switch-when="4" class="ico_encamino icotfaq"></span>
                                 <span ng-switch-when="5" class="ico_entregado icotfaq"></span>
                                 <span ng-switch-when="6" class="ico_incompleto icotfaq"></span>
                                 <span ng-switch-when="7" class="ico_cancelado icotfaq"></span>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

         {{-- <div class="ed-item s-100 spi spd">
            <div class="mapa_container">
               <div class="head_mapa">
                  <h2>Ubucaciones</h2>
                  <div class="ico_ubi"></div>
               </div>
               Mapa
            </div>
         </div> --}}
      </div>

      <div class="ed-container full" ng-show="mapTab">
         <div class="ed-item ed-container full">
            <div class="ed-item s-100 m-25 spi sp_phone">
               <select class="custom-select select_order">
                  <option selected disabled value>Zona</option>
                  <option value="1">Zona 12</option>
               </select>
            </div>

            <div class="ed-item s-100 m-25 spi sp_phone">
               <select class="custom-select select_order">
                  <option selected disabled value>Cuidad</option>
                  <option value="1">Guatemala</option>
               </select>
            </div>

            <div class="ed-item s-100 m-25 spi sp_phone">
               <select class="custom-select select_order">
                  <option selected disabled value>Departamento</option>
                  <option value="1">Petén</option>
               </select>
            </div>

            <div class="ed-item s-100 m-25 spi spd">
               <select class="custom-select select_order">
                  <option selected disabled value>País</option>
                  <option value="1">Guatemala</option>
               </select>
            </div>
         </div>

         <div class="ed-item s-100 spi spd">
            <div class="mapa_container">
               <div class="head_mapa">
                  <h2>Ubucaciones</h2>
                  <div class="ico_ubi"></div>
               </div>
               Mapa
            </div>
         </div>
      </div>


   </div>
</div>
@endsection

@push('scripts')
<script src="/js/Controller/OrdenesCtrl.js"></script>
@endpush

