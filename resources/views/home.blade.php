@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="EscritorioCtrl" ng-cloak>
   <div class="head_content">
      <h1>Dashboard</h1>
   </div>

   <div class="dash_content">
      <div class="ed-container full">
         <div class="ed-item s-100 m-1-3 spi sp_phone">
            <div class="box_container">
               <div class="ed-item ed-container full h_card">
                  <div class="ed-item s-60 cross-center main-center spi spd">
                     <div class="ico_ventast">
                        <p>Ventas Totales</p>
                        <h2>@{{resumen.total | number:2}}</h2>
                     </div>
                  </div>

                  <div class="ed-item s-40 spi spd">
                     <div class="bg_ventas">
                        <h1>Tarjeta</h1>
                        <p>@{{resumen.total | number:2}}</p>
                        <h1>Efectivo</h1>
                        <p>0.00</p>
                        <h1>Banco</h1>
                        <p>0.00</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="ed-item s-100 m-1-3 spi spd">
            <div class="box_container">
               <div class="ed-item ed-container full h_card">
                  <div class="ed-item s-60 cross-center main-center spi spd">
                     <div class="ico_ordenest">
                        <p>Total de Ordenes</p>
                        <h2>@{{resumen.cantidad}}</h2>
                     </div>
                  </div>

                  <div class="ed-item s-40 spi spd cross-center main-center">
                     <a  href="{{ route('pedidos') }}" class="btn btn_pos">Ver</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="ed-item s-100 m-1-3 spd sp_phone">
            <div class="box_container">
               <div class="ed-item ed-container full h_card">
                  <div class="ed-item s-60 cross-center main-center spi spd">
                     <div class="ico_clientest">
                        <p>Clientes</p>
                        <h2>@{{resumen.clientes}}</h2>
                     </div>
                  </div>

                  {{-- <div class="ed-item s-40 spi spd">
                     <div class="bg_clientes">
                        <h1>Hombrea</h1>
                        <p>6,500</p>
                        <h1>Mujeres</h1>
                        <p>3,500</p>
                     </div>
                  </div> --}}
               </div>
            </div>
         </div>
      </div>

      {{-- MAPA DE CALOR --}}
      {{-- <div class="ed-container full">
         <div class="ed-item s-100 spi spd">
            <div class="mapa_container">
               <div class="head_mapa">
                  <h2>Ubicaciones</h2>
                  <div class="ico_ubi">
                  </div>
               </div>

               <div id="map" style="float: left;width: 100%;height: 100%;"></div>

            </div>
         </div>
      </div> --}}

      <div class="ed-container full">
         <div class="ed-item s-100 m-100 spi spd">
            <div class="container_chartventas">
               <div class="ed-item ed-container full">
                  <div class="ed-item s-100 cross-center main-end">
                     <div class="container_btn_fill">
                        <button type="button" class="btn btn_fill" ng-class="{'active': btn_dia}" ng-click="graficaPedidos('dia')">Día</button>
                        <button type="button" class="btn btn_fill" ng-class="{'active': btn_mes}" ng-click="graficaPedidos('mes')">Mes</button>
                        <button type="button" class="btn btn_fill" ng-class="{'active': btn_mes}" ng-click="init()">Mapa</button>
                        {{-- <button type="button" class="btn btn_fill" ng-class="{'active': btn_anio}" ng-click="graficaPedidos('anio')">Año</button> --}}
                     </div>
                     <div class="ed-container full">
                        <div class="chart_leads">
                           <div id="containerconv">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="ed-container full">
         <div class="ed-item s-100 m-1-3 spi sp_phone">
            <div class="container_listordenes">
               <h1>Últimos pedidos</h1>

               <div class="list_ordenes" ng-repeat="orden in ordenes">
                  <div class="ordenes_item">
                     <p> <strong> Orden: @{{ orden.no_orden}}</strong>   @{{ orden.cliente.nombre}} @{{orden.cliente.apellido}}  Q. @{{orden.total | number : 2}}</p>
                  </div>
               </div>

               <div class="footer_ordenes">
                  <a href="{{ route('pedidos') }}"><p>Ver Más</p></a>
               </div>
            </div>
         </div>

         <div class="ed-item s-100 m-1-3 spi spd">
            <div class="chart_productos">
               <h1>Productos más vendidos</h1>

               <div class="list_ordenes" ng-repeat="producto in mas_vendido">
                  <div class="ordenes_item">
                     <p> @{{$index +1}} <strong> @{{ producto.nombre}}</strong>  @{{producto.cantidad}}</p>
                  </div>
               </div>

               {{-- <div class="footer_chart">
                  <a href="#"><p>Ampliar</p></a>
               </div> --}}
            </div>
         </div>

         <div class="ed-item s-100 m-1-3 spd sp_phone">
            <div class="container_promos">
               <h1>Promociones</h1>

               <div class="list_promos">
                  <div class="promos_item" ng-repeat="promocion in promociones">
                     <p><b>@{{$index+1}}</b> @{{promocion.descripcion}}</p>
                  </div>
               </div>

               <div class="footer_promos">
                  <a href="{{ route('promociones') }}"><p>Ver Más</p></a>
               </div>
            </div>
         </div>
      </div>

      <div class="ed-container full">
         {{-- <div class="ed-item s-100 m-1-3 spi sp_phone">
            <div class="container_chartpay">
               <h1>Categorías</h1>
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

