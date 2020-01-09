@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="BodegasCtrl" ng-cloak>
   <div class="head_content">
      <h1>Bodega</h1>
      <div class="cont_btns_head">
         <a ng-click="modal_nueva_bodega=true" class="btn btn_opcion" >Nueva Bodega</a>
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

   {{-- LISTADO DE BODEGAS --}}
   <div class="ed-container full">
      <div class="box_productoscontainer">
         <div class="box_proditem" ng-repeat="bodega in bodegas">
            <div class="ed-container full">
               <div class="ed-item s-100">
                  <div id="mapa@{{bodega.id}}" style="text-align: left; width:300px; height:300px"></div>
               </div>

               <div class="ed-item s-100 main-start cross-center"  ng-click="detalleBodega(bodega)" style="cursor:pointer">
                  <div class="prod_nombre">
                     <h1>@{{bodega.nombre | limitTo:18}} @{{ bodega.nombre.length > 18 ? '...' : '' }}</h1>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- NUEVA BODEGA --}}
   <div class="caja_modal" ng-show="modal_nueva_bodega">
      <div id="modal_detalle_suc">
         <div class="header_area">
            <h1>Nueva Bodega</h1>
            <div class="areacerrar">
               <a ng-click="modal_nueva_bodega=false" class="icocerrar"></a>
            </div>
         </div>

         <div class="contenido_area coloblan">
            <div class="col-sm-12 fleft_phonecp mtop">
               <form  name="frmnew" novalidate ng-submit="guardarBodega()">

                  <div class="form-group ed-container full">
                     <div class="ed-item s-100 m-40 spi">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control sinp" name="nombre" ng-model="bodega.nombre" required >
                     </div>

                     <div class="ed-item s-100 m-40 spi">
                        <label for="direccion">Dirección:</label>
                        <input type="text" class="form-control sinp" name="direccion" ng-model="bodega.direccion" required >
                     </div>

                     <div class="ed-item s-100 m-20 spi">
                        <label for="zona">Zona:</label>
                        <input id="zona" type="number" class="form-control sinp" name="zona" ng-model="bodega.zona" required >
                     </div>
                  </div>

                  <div class="form-group ed-container full">
                     <div class="ed-item s-100 m-50 spi">

                        <label for="depto">Departamento</label>
                        <ol class="nya-bs-select mol relcont" ng-model="municipios" data-live-search="true" data-size="5" title="Selecciona..." ng-change="seleccionarDepto()" required>
                           <li nya-bs-option="depto in Departamentos" data-value="depto.municipios">
                              <a>
                                 @{{ depto.nombre }}
                                 <span class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                        </ol>

                     </div>

                     <div class="ed-item s-100 m-50 spi spd">
                        <label for="muni">Municipio</label>
                        <ol class="nya-bs-select mol relcont" ng-model="bodega.codigo_municipio" data-live-search="true" data-size="7" title="Selecciona..." required>
                           <li nya-bs-option="muni in municipios" data-value="muni.codigo">
                              <a>
                                 @{{muni.nombre}}
                                 <span class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                        </ol>
                     </div>
                  </div>

                  <div class="form-group ed-container full">
                     <div class="ed-item s-100 m-20 spi">
                        <label for="latitud">latitud:</label>
                        <input id="latitud" type="number" step=0.00000001  class="form-control sinp" name="latitud" ng-model="bodega.latitud" required>
                     </div>
                     <div class="ed-item s-100 m-20 spi">
                        <label for="longitud">longitud:</label>
                        <input id="longitud" type="number" step=0.00000001  class="form-control sinp" name="longitud" ng-model="bodega.longitud" required>
                     </div>
                     <div class="ed-item s-100 m-60 spd">
                        <label for="indicaciones">Indicaciones:</label>
                        <input id="indicaciones" type="text" class="form-control sinp" name="indicaciones" ng-model="bodega.indicaciones">
                     </div>
                  </div>

                  <div class="ed-container full">
                     <div class="ed-item s-100 main-center cross-center">
                        <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                           Crear Bodega
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   {{-- EDITAR BODEGA --}}
   <div class="caja_modal" ng-show="modal_editar_bodega">
      <div id="modal_detalle_suc">
         <div class="header_area">
            <h1>Editar Bodega</h1>
            <div class="areacerrar">
               <a ng-click="modal_editar_bodega=false" class="icocerrar"></a>
            </div>
         </div>

         <div class="contenido_area coloblan">
            <div class="col-sm-12 fleft_phonecp mtop">
               <form  name="frmEdit" novalidate ng-submit="editarBodega()">

                  <div class="form-group ed-container full">
                     <div class="ed-item s-100 m-40 spi">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control sinp" name="nombre" ng-model="selectBodega.nombre" required >
                     </div>

                     <div class="ed-item s-100 m-40 spi">
                        <label for="direccion">Direccion:</label>
                        <input type="text" class="form-control sinp" name="direccion" ng-model="selectBodega.direccion" required >
                     </div>

                     <div class="ed-item s-100 m-20 spi">
                        <label for="zona">Zona:</label>
                        <input id="zona" type="text" class="form-control sinp" name="zona" ng-model="selectBodega.zona" required >
                     </div>
                  </div>

                  <div class="form-group ed-container full">
                     <div class="ed-item s-100 m-50 spi">

                        <label for="depto">Departamento</label>
                        <ol class="nya-bs-select mol relcont" ng-model="municipios" data-live-search="true" data-size="5" title="Selecciona..." ng-change="seleccionarDepto()" required>
                           <li nya-bs-option="depto in Departamentos" data-value="depto.municipios">
                              <a>
                                 @{{ depto.nombre }}
                                 <span class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                        </ol>

                     </div>

                     <div class="ed-item s-100 m-50 spi spd">
                        <label for="muni">Municipio</label>
                        <ol class="nya-bs-select mol relcont" ng-model="selectBodega.codigo_municipio" data-live-search="true" data-size="7" title="Selecciona..." required>
                           <li nya-bs-option="muni in municipios" data-value="muni.codigo">
                              <a>
                                 @{{muni.nombre}}
                                 <span class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                        </ol>
                     </div>
                  </div>

                  <div class="form-group ed-container full">
                     <div class="ed-item s-100 m-20 spi">
                        <label for="latitud">latitud:</label>
                        <input id="latitud" type="number" step=0.00000001  class="form-control sinp" name="latitud" ng-model="selectBodega.latitud" required>
                     </div>
                     <div class="ed-item s-100 m-20 spi">
                        <label for="longitud">longitud:</label>
                        <input id="longitud" type="number" step=0.00000001  class="form-control sinp" name="longitud" ng-model="selectBodega.longitud" required>
                     </div>
                     <div class="ed-item s-100 m-60 spd">
                        <label for="indicaciones">Indicaciones:</label>
                        <input id="indicaciones" type="text" class="form-control sinp" name="indicaciones" ng-model="selectBodega.indicaciones">
                     </div>
                  </div>

                  <div class="ed-container full">
                     <div class="ed-item s-100 main-center cross-center">
                        <button type="submit" class="btn btn_save" ng-disabled="frmEdit.$invalid">
                           Editar Bodega
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   {{-- DETALLE DE BODEGA --}}
   <div class="caja_modal" ng-if="modal_detalle_bodega">
      <div id="modal_detalle_suc">
         <div class="header_area">
            <h1>Detalle de la Bodega</h1>
            <div class="areacerrar">
               <a ng-click="cerrar_bodega()" class="icocerrar"></a>
            </div>
         </div>

         <div class="ed-container full" style="padding: 15px">
            <div class="ed-item s-60 fleft_phonecp mtop">
                  <p style="text-align:center"><b>@{{selectBodega.nombre}}</b></p>
                  <br>
                  <p> <b>Departamento:</b> @{{selectBodega.municipio.departamento.nombre}}</p>
                  <p> <b>Municipio:</b> @{{selectBodega.municipio.nombre}}</p>
                  <p> <b>Direccion:</b> @{{selectBodega.direccion}}</p>
                  <p> <b>Zona:</b> @{{selectBodega.zona}}</p>
                  <p> <b>Latitud:</b> @{{selectBodega.latitud}} <b>longitud:</b> @{{selectBodega.longitud}}</p>
                  <p> <b>Indicaciones:</b>  @{{selectBodega.indicaciones}}</p>

                  <div class="ed-item s-100 main-center cross-center ">
                     <button type="button" class="btn" ng-click="eliminarBodega()"> Eliminar </button>
                     <button type="button" class="btn" ng-click="showEditarBodega()"> Editar </button>
                  </div>
               </div>
               <div class="ed-item s-40 spd">
                  <div id="mapaSelect@{{selectBodega.id}}" style="text-align: left; width:100%; height:250px">  </div>
               </div>
            </div>
         </div>
   </div>

</div>

@endsection
@push('scripts')
   <script src="https://maps.google.com/maps/api/js?key=AIzaSyBd0OKsKH-yYSJIYAZ3vaKC_NmxB05rqsI"></script>
   <script src="/js/Controller/Admin/Ajustes/BodegasCtrl.js"></script>
@endpush
