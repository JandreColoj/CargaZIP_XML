@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="PilotoCtrl" ng-cloak>
   <div class="head_content">
      <h1>Piloto</h1>
      <div class="cont_btns_head">
         <a ng-click="modalNuevoPiloto()" class="btn btn_opcion" >Nuevo piloto</a>
      </div>
   </div>

   <div class="ed-container full">
      <div class="ed-item s-100 spi spd">
         <div class="container_pedidos">
            <table class="table table-borderless table_separate">
               <thead class="table_head_pedido">
                  <tr>
                     <th>No. </th>
                     <th>Nombres</th>
                     <th>DPI</th>
                     <th>Telefono</th>
                     <th>Vehiculo</th>
                     <th>estado</th>
                     <th>Opciones</th>
                  </tr>
               </thead>

               <tbody class="table_body_pedido">
                  <tr ng-repeat="piloto in pilotos">
                     <td class="radius_left">@{{$index+1}}</td>
                     <td>@{{piloto.user.name}}</td>
                     <td>@{{piloto.user.dpi}}</td>
                     <td>@{{piloto.user.telefono}}</td>
                     <td>@{{piloto.vehiculo.modelo_vehiculo}}</td>
                     <td>
                        <span ng-if="piloto.estado == 1" >Activo</span>
                        <span ng-if="piloto.estado == 0" >Desactivado</span>
                     </td>
                     <td class="radius_right">
                        <span class="icoeditar icotfaq" ng-click="modalEditarPiloto(piloto)" data-tippy-content="Editar"></span>
                        {{-- <span class="icoeliminar icotfaq"  ng-class="{'icoeliminarConfirmar': trans.eliminar==1 }"  uib-tooltip="Eliminar" ng-click="eliminarTransporte(trans)"></span> --}}
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   {{-- NUEVO Y EDITAR PILOTO --}}
   @include('admin.piloto.piloto')
   {{-- NUEVO Y EDITAR PILOTO --}}

</div>

@endsection
@push('scripts')
   <script src="/js/Controller/PilotoCtrl.js"></script>
@endpush
