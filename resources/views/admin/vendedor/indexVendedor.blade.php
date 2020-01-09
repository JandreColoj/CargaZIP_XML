@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="vendedorCtrl" ng-cloak>
   <div class="head_content">
      <h1>Vendedor</h1>
      <div class="cont_btns_head">
         <a ng-click="modalNuevoVendedor()" class="btn btn_opcion" >Nuevo vendedor</a>
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


   <div class="ed-container full">
      <div class="ed-item s-100 spi spd">
         <div class="container_pedidos">
            <table class="table table-borderless table_separate">
               <thead class="table_head_pedido">
                  <tr>
                     <th>No. </th>
                     <th>Nombre</th>
                     <th>DPI</th>
                     <th>Telefono</th>
                     <th>estado</th>
                     <th>Opciones</th>
                  </tr>
               </thead>

               <tbody class="table_body_pedido">
                  <tr ng-repeat="vendedor in vendedores">
                     <td class="radius_left">@{{$index+1}}</td>
                     <td>@{{vendedor.user.name}}</td>
                     <td>@{{vendedor.user.dpi}}</td>
                     <td>@{{vendedor.user.telefono}}</td>
                     <td>
                        <span ng-if="vendedor.user.estado == 1" >Activo</span>
                        <span ng-if="vendedor.user.estado == 0" >Desactivado</span>
                     </td>
                     <td class="radius_right">
                        <span class="icoeditar icotfaq" ng-click="modalEditarVendedor(vendedor)" data-tippy-content="Editar"></span>
                        {{-- <span class="icoeliminar icotfaq"  ng-class="{'icoeliminarConfirmar': trans.eliminar==1 }"  uib-tooltip="Eliminar" ng-click="eliminarTransporte(trans)"></span> --}}
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   {{-- NUEVO Y EDITAR VENDEDOR --}}
   @include('admin.vendedor.vendedor')
   {{-- NUEVO Y EDITAR VENDEDOR --}}

</div>

@endsection
@push('scripts')
   <script src="/js/Controller/Admin/vendedorCtrl.js"></script>
@endpush
