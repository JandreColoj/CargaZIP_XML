@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="ProductosCtrl" ng-cloak>

   <div class="caja_modal" ng-if="modalError || modalSuccess || loadding">

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

   <div class="head_content">
      <h1>Productos</h1>
      <div class="cont_btns_head">
         <a ng-click="modalCategorias = true"       class="btn btn_opcion">Categorias</a>
         <a ng-click="modalMarcas = true"           class="btn btn_opcion">Marcas</a>
         <a ng-click="showNuevoProd()"              class="btn btn_opcion">Nuevo Producto</a>
         <a ng-click="showCargaProd()"              class="btn btn_opcion">Carga Productos</a>
         <a ng-click="formulario_inventario = true" class="btn btn_opcion">Inventario</a>
         <a ng-click="formulario_carga_inv = true"  class="btn btn_opcion">Carga Inventario</a>
      </div>
   </div>

   {{-- Busqueda --}}
   <div class="ed-container full main-end">
      <div class="ed-item s-100 m-40 main-end cross-center spi spd">
         <form class="ed-item ed-container full main-end form_busqueda" ng-submit="buscarProducto()">
            <div class="ed-item s-55 spi spd">
               <div class="form-group">
                  <input type="text" class="form-control input_bus" placeholder="Buscar producto..." ng-model="searchText">
               </div>
               <button type="submit" class="btn btn_loop"></button>
            </div>
         </form>
      </div>
   </div>

   {{-- Filtro categorías y marcas --}}
   <div class="col-sm-12 spd fleft_phone" ng-if="productos_activos">
      <div class="col-sm-12 spi spd">
         <ul class="filtroescri container_scrollcategoria">
            <li>
               <a ng-click="productoFiltro('all',marca_selected)" ng-class="{'act': cat_selected == 'all'}">
                  Todas las Categorias
               </a>
            </li>
            <li>
               <a ng-click="productoFiltro(0,marca_selected)" ng-class="{'act': cat_selected == 0}">
                  Sin Categorias
               </a>
            </li>

            <li ng-repeat="categoria in categorias" >
               <a ng-click="productoFiltro(categoria.id,marca_selected)" ng-class="{'act': cat_selected == categoria.id}">
                  @{{categoria.nombre}}
               </a>
            </li>
         </ul>
      </div>

      <div class="col-sm-12 spi spd">
         <ul class="filtroescri container_scrollcategoria">
            <li>
               <a ng-click="productoFiltro(cat_selected,'all')" ng-class="{'act': marca_selected == 'all'}">
                  Todas las Marcas
               </a>
            </li>
            <li>
               <a ng-click="productoFiltro(cat_selected,0)" ng-class="{'act': marca_selected == 0}">
                  Sin Marcas
               </a>
            </li>

            <li ng-repeat="marca in marcas" >
               <a ng-click="productoFiltro(cat_selected,marca.id)" ng-class="{'act': marca_selected == marca.id}">
                  @{{marca.nombre}}
               </a>
            </li>
         </ul>
      </div>
   </div>

   {{-- Lista de productos --}}
   <div class="ed-container full">
      <div class="box_productoscontainer">
         <div class="box_proditem" ng-repeat="producto in productos | filter:searchText">
            <div class="ed-container full">
               <div class="ed-item s-100" ng-click="subirImagen(producto)">
                  <div class="img_producto" style="--img-prod:url('@{{producto.imagenes[0].imagen}}')" ng-if="producto.imagenes.length > 0"></div>

                  <div class="letra_producto" ng-if="producto.imagenes.length == 0">
                     <h4>@{{producto.nombre | limitTo:1}}</h4>
                  </div>
               </div>

               <div class="ed-item s-100 main-start cross-center">
                  <div class="prod_nombre">
                     <h1>@{{producto.nombre | limitTo:18}} @{{ producto.nombre.length > 18 ? '...' : '' }}</h1>
                  </div>
               </div>

               {{-- PRECIO POR PRESENTACION --}}
               <div class="ed-item s-100 main-justify cross-center">
                  <div class="priceprod" ng-repeat="pre in producto.presentacion">
                     <p>@{{informacion.monedaPrincipal}} @{{pre.precio | number:2}} / @{{pre.medida}}</p>
                  </div>

                  <div class="priceprod" ng-repeat="pre in producto.presentacion">
                     <p>@{{producto.stock/ pre.cantidad_x_caja}} / @{{pre.medida}}</p>
                  </div>
               </div>

               <div class="ed-item s-100 main-justify cross-center">
                  <div class="cont_btnpromos">
                     <button type="button" class="btn btn_promos" ng-click="showPromos(producto)">Promocionar</button>
                  </div>
               </div>
            </div>

            <div class="footer_opcion" ng-click="showOpciones(producto)">
               <p>Opciones</p>
            </div>

            <div class="mini_modaloptions" id="mini_modal@{{producto.id}}" ng-class="{'hide_minomodal': !producto.selected}" ng-if="producto.selected">
               <div class="header">
                  <p>Opciones</p>
                  <div class="clouse" ng-click="showOpciones(producto)"></div>
               </div>

               <div class="body_opciones">
                  <div class="ed-container full">
                     <div class="ed-item s-50">
                        <div class="ico_visualizar" ng-click="showDetalle(producto)">Visualizar</div>
                     </div>
                     <div class="ed-item s-50">
                        <div class="ico_editar" ng-click="editarProd(producto)">Editar</div>
                     </div>
                     <div class="ed-item s-50">
                        <div class="ico_variaciones" ng-click="showVariaciones(producto)">Variaciones</div>
                     </div>
                     <div class="ed-item s-50">
                        <div class="ico_deshabilitar" ng-click="desavilitarProd(producto)" ng-if="producto.estado==1">Deshabilitar</div>
                        <div class="ico_habilitar_pro" ng-click="habilitarProd(producto.id)" ng-if="producto.estado==0">Habilitar</div>
                     </div>
                     <div class="ed-item s-50">
                        <div class="ico_imgprin" ng-click="subirImagen(producto)">Imagen</div>
                     </div>
                     <div class="ed-item s-50">
                        <div class="ico_visualizar" ng-click="showStock(producto)">Detalle Stock</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- MANTENIMIENTO DE MARCAS --}}
   @include('admin.productos.marcas')

   {{-- MANTENIMIENTO DE CATEGORIAS --}}
   @include('admin.productos.categorias')

   {{-- MANTENIMIENTO DE PRODUCTOS --}}
   @include('admin.productos.producto')

   {{-- CARGA DE PRODUCTOS EN EXCEL --}}
   @include('admin.productos.cargaProductos')

   {{-- CREACION DE PROMOCIONES --}}
   @include('admin.productos.promociones')

   {{-- MANTENIMIENTO DE INVENTARIO --}}
   @include('admin.productos.inventario')

   {{-- CARGA DE INVENTARIO --}}
   @include('admin.productos.cargaInventario')

</div>

@endsection
@push('scripts')
<script src="/js/Controller/productos/functionCtrl.js"></script>
<script src="/js/Controller/productos/ProductosCtrl.js"></script>
@endpush
