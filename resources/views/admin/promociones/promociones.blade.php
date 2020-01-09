@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="PromocionesCtrl" ng-cloak>

   <div class="head_content">
      <h1>Promociones</h1>
   </div>

   {{-- Filtro de busqueda --}}
   <div class="ed-container full">
      <div class="ed-item s-100 spi spd">
         <div class="container_filtro">
            <form>
               <div class="row">
                  <div class="col-sm-4">
                     <label for="">Buscar por</label>
                     <input class="form-control" type="text" name="" id="" placeholder="Promocion o cualquier dato">
                  </div>
                  <div class="col-sm-3 spi">
                        <label for="">Producto</label>
                        <input class="form-control" type="text" name="" id="" placeholder="Producto">
                  </div>

                  <div class="col-sm-2 spi">
                        <label for="">Fecha inicio</label>
                        <input class="form-control" type="date" name="" id="" placeholder="Fecha Inicio">
                  </div>
                  <div class="col-sm-2 spi">
                        <label for="">Fecha final</label>
                        <input class="form-control" type="date" name="" id="" placeholder="Fecha Final">
                  </div>
                  <div class="col-sm-1 spi">
                        <input  class="btn-busfiltro" type="submit">
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
                     <th>Título</th>
                     <th>Creado</th>
                     <th>Descripcion</th>
                     <th>Fecha Inicio</th>
                     <th>Fecha Fin</th>
                     <th>Alcance</th>
                     <th>Pedidos</th>
                     <th>Efectividad</th>
                     <th>Opciones</th>
                  </tr>
               </thead>

               <tbody class="table_body_pedido">
                  <tr ng-repeat="promo in promociones">
                     <td class="radius_left" ng-click="verPromo(promo)">@{{promo.titulo}}</td>
                     <td ng-click="verPromo(promo)">@{{promo.created_at | amDateFormat:'D/MM/Y' }}</td>
                     <td ng-click="verPromo(promo)">@{{promo.descripcion}}</td>
                     <td ng-click="verPromo(promo)">@{{promo.fecha_inicio | amDateFormat:'D/MM/Y'}}</td>
                     <td ng-click="verPromo(promo)">@{{promo.fecha_fin | amDateFormat:'D/MM/Y'}}</td>
                     <td ng-click="verPromo(promo)">@{{promo.total_alcance}}</td>
                     <td ng-click="verPromo(promo)">@{{promo.total_pedidos}}</td>
                     <td ng-click="verPromo(promo)">@{{(promo.total_pedidos/promo.total_alcance | number:2)*100}} %</td>
                     <td class="radius_right">
                        <a ng-click="modalEditar(promo)" class="ico_editpromo icon_typpy" data-tippy-content="Editar"></a>
                        <a ng-click="eliminarPromo(promo.id)" class="ico_suprpromo icon_typpy" data-tippy-content="Eliminar"></a>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <div class="caja_modal" ng-click="cerrar()" ng-if="editar_promo"></div>
   <div id="area_detalleproductot"   style="height: 530px;" ng-if="editar_promo">
      <div class="header_dprocuto no_border">
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="container_detalle" style="overflow-y:hidden;">
         <div class="ed-container full">
            <div class="ed-item s-50 spi">
               <div class="ed-item s-100 spi spd msj_banner">
                  <span >@{{promocion.error_banner}}</span>
               </div>
               <div class="content_image_promo">
                  <form action="/file-upload" class="dropzone img_primary" id="my-awesome-dropzone" dropzone="dropzoneConfig_img1" >
                  </form>
               </div>
            </div>

            <div class="ed-item ed-container s-50 spd">

               <form class="form-horizontal ed-container content_formpromo" name="frmEdit" ng-submit="editarPromocion()">


                  <div class="form-group ed-container">
                     <div class="ed-item s-100 spi spd">
                        <input id="titulo" type="text"  class="form-control" name="titulo" ng-model="promocion.titulo" placeholder="Titulo" required>
                     </div>
                  </div>

                  <div class="form-group ed-container">
                     <div class="ed-item s-100 spi spd">
                        <label for="">Presentación:</label>
                        <ol class="nya-bs-select mol relcont" ng-model="promocion.codigo_medida" data-live-search="true" data-size="7" title="Selecciona..." required>
                           <li nya-bs-option="medida in promocion.presentacion" data-value="medida.codigo_medida">
                              <a>
                                 @{{ medida.medida }}
                                 <span class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                        </ol>
                     </div>
                  </div>

                  <div class="form-group ed-container">
                     <div class="ed-item ed-container s-100 spi spd spf inpumoneda cross-center main-center">
                        <div class="ed-item s-80 spi spd">
                           <input id="precioq" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precioq" ng-model="promocion.precio" placeholder="Precio 0.00" required>
                        </div>
                        <div class="ed-item s-20 spi spd">
                           <span>@{{informacion.monedaPrincipal}}</span>
                        </div>
                     </div>
                  </div>

                  <div class="form-group fleft_phone">
                     <div class="col-sm-12 col-xs-12  fleft_phone">
                        <textarea id="descripcion" type="text" class="form-control sinp ng-pristine ng-valid ng-empty ng-touched" name="descripcion" ng-model="promocion.descripcion" rows="5" placeholder="Descripción promo"></textarea>
                     </div>
                  </div>

                  <div class="form-group ed-container">

                     <div class="ed-item ed-container s-50 spi cross-center main-start">
                        <label>Fecha Inicio</label>
                        <div class="ed-item s-100 spi">
                           <input type="date" class="form-control" ng-model="promocion.inicio" placeholder="Fecha Inicio" required>
                        </div>
                     </div>

                     <div class="ed-item ed-container s-50 spd cross-center main-start">
                        <label>Fecha Fin</label>
                        <div class="ed-item s-100 spi spd">
                           <input type="date" class="form-control" ng-model="promocion.fin" placeholder="Fecha Fin" required>
                        </div>
                     </div>
                  </div>

                  <div class="ed-container full">
                     <div class="ed-item s-100 main-center cross-center">
                        <button type="submit" class="btn btn_save" ng-disabled="frmEdit.$invalid">
                           Editar Promoción
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   {{-- DETALLE DE PRODUCTO --}}
   <div class="caja_modal" ng-click="cerrar()" ng-if="ver_promo"></div>
   <div id="area_detalleproductot" ng-if="ver_promo">
      <div class="header_dprocuto no_border">
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="container_detalle" style="overflow-y:hidden;">
         <div class="ed-container full">
            <div class="ed-item s-50 spi">
               <div class="content_image_promo">
                  <img src="@{{promoSelect.imagen_1}}" alt="">
               </div>
            </div>

            <div class="ed-item s-50 spd cross-start">
               <p> Nombre: @{{promoSelect.producto.nombre}}</p>
               <p> Descripcion: @{{promoSelect.descripcion}}</p>
               <p> fecha de promocion:  del @{{promoSelect.fecha_inicio}} al @{{promoSelect.fecha_fin}}</p>

               <div class="ed-container full">
                  <div class="ed-item s-50 main-center cross-center">
                     <button type="button" class="btn btn_save" ng-click="modalEditar(promoSelect)">
                        Editar
                     </button>
                  </div>
                  <div class="ed-item s-50 main-center cross-center">
                     <button type="button" class="btn btn_save btn_pedidos" ng-click="pedidosPromocion(promoSelect.id)">
                        Ver Pedidos
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- LISTA DE PEDIDOS POR PROMO --}}
   <div class="caja_modal" ng-click="cerrar()" ng-if="ver_pedidos_promo"></div>
   <div id="area_detalleproductot" ng-if="ver_pedidos_promo">
      <div class="header_dprocuto no_border">
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="container_detalle" style="overflow-y:hidden;">
         <div class="ed-container full">

            <table class="table table-borderless table_separate">
               <thead class="table_head_pedido">
                  <tr>
                     <th>Estado</th>
                     <th>No. Pedido</th>
                     <th>Cliente</th>
                     <th>Cantidad</th>
                     <th>Total</th>
                     <th>Recibido</th>
                  </tr>
               </thead>

               <tbody class="table_body_pedido" infinite-scroll="morePedidos()">
                  <tr ng-repeat="promocion in pedidos" ng-class="{'negrita' : promocion.estado.codigo==1}">
                     <td class="radius_left">
                        <div ng-switch="promocion.pedido.estado.codigo">
                           <span class="icon_status ico_norden" ng-switch-when="1" data-tippy-content="Nuevo Pedido"></span>
                           <span class="icon_status ico_norden" ng-switch-when="2" data-tippy-content="Nuevo Pedido"></span>
                           <span class="icon_status ico_bodega" ng-switch-when="3" data-tippy-content="En Bodega"></span>
                           <span class="icon_status ico_ruta" ng-switch-when="4" data-tippy-content="En Ruta"></span>
                           <span class="icon_status ico_entregado" ng-switch-when="5" data-tippy-content="Entregado"></span>
                           <span class="icon_status ico_incompleto" ng-switch-when="6" data-tippy-content="Incompleto"></span>
                           <span class="icon_status ico_cancelado" ng-switch-when="7" data-tippy-content="Cancelado"></span>
                        </div>
                     </td>
                     <td class="radius_right">@{{promocion.pedido.no_orden}}</td>
                     <td>@{{promocion.pedido.cliente.nombre}} @{{pedido.cliente.apellido}}</td>
                     <td>@{{promocion.cantidad}}</td>
                     <td>@{{promocion.pedido.moneda}} @{{promocion.cantidad * promocion.precio | number:2}}</td>
                     <td>@{{promocion.pedido.created_at | amDateFormat:'DD/MM/Y h:m' }}</td>
                  </tr>
               </tbody>
            </table>

         </div>
      </div>
   </div>

</div>
@endsection

@push('scripts')
<script src="/js/Controller/PromocionesCtrl.js"></script>
@endpush

