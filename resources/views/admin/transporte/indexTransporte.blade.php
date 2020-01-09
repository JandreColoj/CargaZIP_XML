@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="TransporteCtrl" ng-cloak>
   <div class="head_content">
      <h1>Transporte</h1>
      <div class="cont_btns_head">
         <a ng-click="modalNuevoTransporte()" class="btn btn_opcion" >Nuevo Transporte</a>
      </div>
   </div>

   <div class="ed-container full">
      <div class="ed-item s-100 spi spd">
         <div class="container_pedidos">
            <table class="table table-borderless table_separate">
               <thead class="table_head_pedido">
                  <tr>
                     <th>Vehiculo</th>
                     <th>Placa</th>
                     <th>Modelo</th>
                     <th>Capacidad</th>
                     <th>estado</th>
                     <th>Opciones</th>
                  </tr>
               </thead>

               <tbody class="table_body_pedido">
                  <tr ng-repeat="trans in transporte">
                     <td class="radius_left">@{{trans.modelo_vehiculo}}</td>
                     <td>@{{trans.placa}}</td>
                     <td>@{{trans.anio}}</td>
                     <td>@{{trans.capacidad}}</td>
                     <td>
                        <span ng-if="trans.estado == 1" >Activo</span>
                        <span ng-if="trans.estado == 0" >Desactivado</span>
                     </td>
                     <td class="radius_right">
                        <span class="icoeditar icotfaq" ng-click="modalEditarTransporte(trans)" data-tippy-content="Editar"></span>
                        <span class="icoeliminar icotfaq"  ng-class="{'icoeliminarConfirmar': trans.eliminar==1 }"  ng-click="eliminarTransporte(trans)" data-tippy-content="Eliminar"></span>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   {{-- NUEVO Y EDITAR VEHICULO --}}
   @include('admin.transporte.vehiculo')

</div>

@endsection
@push('scripts')
   <script src="/js/Controller/TransporteCtrl.js"></script>
@endpush
