{{-- Nuevo Producto --}}
<div class="caja_modal" ng-show="nuevo_obj">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Nuevo Producto</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">

            {{-- seleccion de categorias --}}
            <div class="form-group ed-container full spd spi" ng-if='!formularioProducto'>

               <div class="ed-container s-100 m-100" style="height: 500px;  overflow: auto;">

                  <div class="ed-item s-100 m-80">
                     <h5>Categoria: <b> @{{categoriaSeleccionada.nombre}} </b> </h5>
                  </div>

                  <div class="ed-item s-100 m-20">
                     <button type="button" class="btn btn_formagregar sinp" ng-click="showFormProducto()">Siguiente</button>
                  </div>

                  <div class="ed-item s-100 spi spd">
                     {{-- lista recursiva --}}
                        <script type="text/ng-template" id="menu.html">
                           <span class="nivel@{{menu.principal}}" ng-bind="menu.nombre" ng-click="selectCategoria(menu)"></span>
                           <ul style="list-style:none">
                              <li ng-repeat="menu in menu.sub_categoria" ng-include="'menu.html'" ng-if="arrayCategorias.includes(menu.id_cat_padre)">
                           </li>
                           </ul>
                        </script>

                        <span ng-bind="menu.nombre" ng-click="selectCategoria(menu)"></span>
                        <ul>
                           <li ng-repeat="menu in menus" ng-include="'menu.html'" style="cursor:pointer;"></li>
                        </ul>
                     {{-- lista recursiva --}}
                  </div>

               </div>
            </div>
            {{-- seleccion de categorias --}}

            <form class="form-horizontalcontent" name="frmnew" ng-submit="guardarProductoNew()" ng-if='formularioProducto'>

               <div class="form-group ed-container full cross-end spd spi">
                  <div class="s-100 m-100 spd">
                     <h6 ng-click="showNuevoProd()" style="cursor:pointer"> Categoria: <b> @{{categoriaSeleccionada.nombre}}</b></h6>
                  </div>
               </div>

               <div class="form-group ed-container full cross-end spd spi">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="medida">Presentación</label>
                     <ol class="nya-bs-select mol relcont" ng-model="producto.medida" data-size="7" data-live-search="true" title="Selecciona..." required>
                        <li nya-bs-option="medida in medidas" data-value="medida">
                           <a>
                              @{{ medida.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="ed-item s-100 m-40 spd">
                     <label for="d">Marca</label>
                     <ol class="nya-bs-select mol relcont" ng-model="producto.id_marca"  data-live-search="true"  title="Selecciona..." data-size="7">
                        <li nya-bs-option="marca in marcas" data-value="marca.id">
                           <a>
                              <strong>@{{ marca.nombre }}</strong>
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="ed-item s-20 m-10 spi spd con_btnacategoria" ng-click="addMarca()">
                     <a> <span>+</span></a>
                  </div>
               </div>

               <div class="form-group ed-container full cross-end spd spi" ng-if="producto.medida.codigo=='M001'">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="cant">Cantidad por caja</label>
                     <input id="cant" type="number" class="form-control sinp" name="cant" ng-model="producto.cantidad_caja" required >
                  </div>
               </div>

               {{-- agrega nueva marca --}}
               <div class="ed-container full" ng-if="marca_nuevo">
                  <div class="form-group ed-item s-100 m-70 spi">
                     <input id="nombre" type="text" class="form-control sinp" name="nombre-marca" ng-model="marca.nombre" placeholder="Nombre de la marca" required>
                  </div>

                  <div class="form-group ed-item s-100 m-30 spi spd">
                     <button type="button" class="btn btn_formagregar sinp" ng-click="guardarMarca()">Crear Marca</button>
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="">SKU</label>
                     <input id="sku" type="text" class="form-control sinp" name="sku" ng-model="producto.sku" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="">Nombre del producto</label>
                     <input id="nombre" type="text" class="form-control sinp" name="nombre" ng-model="producto.nombre"  required>
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-12 col-xs-12  fleft_phone">
                     <label for="">Descripción</label>
                     <textarea id="descripcion" type="text" class="form-control sinp ng-pristine ng-valid ng-empty ng-touched" name="descripcion" ng-model="producto.descripcion" rows="5" style=""></textarea>
                  </div>
               </div>

               {{-- precio de caja y unitario --}}
               <div class="form-group ed-container" ng-if="producto.medida.codigo=='M001'">
                  <div class="form-group fleft_phone">
                     <label for="">Precio de Venta</label>
                  </div>

                  <div class="ed-item ed-container s-50 spi spf inpumoneda cross-center main-center">
                     <div class="ed-item s-80 spi spd">
                        <label for="">Precio Caja</label>
                        <input id="precio" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precio" ng-model="producto.precio_caja" placeholder="0.00" required>
                     </div>
                     <div class="ed-item s-20 spi spd">
                        <span>@{{informacion.monedaPrincipal}}</span>
                     </div>
                  </div>

                  <div class="ed-item ed-container s-50 spi spf inpumoneda cross-center main-center">
                     <div class="ed-item s-80 spi spd">
                        <label for="">Precio unitario</label>
                        <input id="precioU" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precioU" ng-model="producto.precio_unitario"
                               ng-value="(producto.precio_caja/producto.cantidad_caja)">
                     </div>
                     <div class="ed-item s-20 spi spd">
                        <span>@{{informacion.monedaPrincipal}}</span>
                     </div>
                  </div>
               </div>

               {{-- SOLO PRECIO UNITARIO --}}
               <div class="form-group ed-container" ng-if="producto.medida.codigo!='M001'">
                  <div class="form-group fleft_phone">
                     <label for="">Precio de Venta</label>
                  </div>

                  <div class="ed-item ed-container s-50 spi spf inpumoneda cross-center main-center">
                     <div class="ed-item s-80 spi spd">
                        <label for="">Precio unitario</label>
                        <input id="precioU" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precioU" ng-model="producto.precio_unitario">
                     </div>
                     <div class="ed-item s-20 spi spd">
                        <span>@{{informacion.monedaPrincipal}}</span>
                     </div>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                        Crear Producto
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- Editar Producto --}}
<div class="caja_modal" ng-if="editar_obj">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Editar Producto  @{{productoSelected.nombre}}</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontalcontent" name="frm" ng-submit="editarProducto()">
               <div class="form-group ed-container full cross-end spd spi">
                  <div class="ed-item s-50 spi">
                     <label for="">Categorias</label>
                     <ol class="nya-bs-select mol relcont" ng-model="productoSelected.id_categoria" data-live-search="true" data-size="7" title="Selecciona..." required>
                        <li nya-bs-option="categoria in categorias" data-value="categoria.id">
                           <a>
                              @{{ categoria.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="ed-item s-50 spi">
                     <label for="">Marcas</label>
                     <ol class="nya-bs-select mol relcont" ng-model="productoSelected.id_marca" data-live-search="true" data-size="7" title="Selecciona..." required>
                        <li nya-bs-option="marca in marcas" data-value="marca.id">
                           <a>
                              @{{ marca.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="form-group ed-container full cross-end spd spi">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="medida">Presentación</label>
                     <ol class="nya-bs-select mol relcont" ng-model="productoSelected.medida" data-size="7" data-live-search="true" title="Selecciona..." required>
                        <li nya-bs-option="medida in medidas" data-value="medida">
                           <a>
                              @{{ medida.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="ed-item s-100 m-50 spi" ng-if="productoSelected.medida.codigo=='M001'">
                     <label for="cant">Cantidad por caja</label>
                     <input id="cant" type="number" class="form-control sinp" name="cant" ng-model="productoSelected.cantidad_caja" required >
                  </div>
               </div>

               <div class="form-group ed-container full spd spi">
                  <div class="ed-item s-100 m-30 spi">
                     <label for="">Código</label>
                     <input id="sku" type="text" class="form-control sinp" name="sku" ng-model="productoSelected.sku" required>
                  </div>

                  <div class="ed-item s-100 m-70 spd">
                     <label for="">Nombre del producto/servicio</label>
                     <input id="nombre" type="text" class="form-control sinp" name="nombre" ng-model="productoSelected.nombre" placeholder="Nombre del Producto" required>
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-12 col-xs-12  fleft_phone">
                     <label for="">Descripción</label>
                     <textarea id="descripcion" type="text" class="form-control sinp ng-pristine ng-valid ng-empty ng-touched" name="descripcion" ng-model="productoSelected.descripcion" rows="4" placeholder="Descripción" style=""></textarea>
                  </div>
               </div>

               {{-- precio de caja y unitario --}}
               <div class="form-group ed-container" ng-if="productoSelected.medida.codigo=='M001'">
                  <div class="form-group fleft_phone">
                     <label for="">Precio de Venta</label>
                  </div>

                  <div class="ed-item ed-container s-50 spi spf inpumoneda cross-center main-center">
                     <div class="ed-item s-80 spi spd">
                        <label for="">Precio Caja</label>
                        <input id="precio" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precio" ng-model="productoSelected.precio_caja" placeholder="0.00" required>
                     </div>
                     <div class="ed-item s-20 spi spd">
                        <span>@{{informacion.monedaPrincipal}}</span>
                     </div>
                  </div>

                  <div class="ed-item ed-container s-50 spi spf inpumoneda cross-center main-center">
                     <div class="ed-item s-80 spi spd">
                        <label for="">Precio unitario</label>
                        <input id="precioU" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precioU" ng-model="productoSelected.precio_unitario"
                                 ng-value="(productoSelected.precio_caja/productoSelected.cantidad_caja)">
                     </div>
                     <div class="ed-item s-20 spi spd">
                        <span>@{{informacion.monedaPrincipal}}</span>
                     </div>
                  </div>
               </div>

               {{-- SOLO PRECIO UNITARIO --}}
               <div class="form-group ed-container" ng-if="productoSelected.medida.codigo!='M001'">
                  <div class="form-group fleft_phone">
                     <label for="">Precio de Venta</label>
                  </div>

                  <div class="ed-item ed-container s-50 spi spf inpumoneda cross-center main-center">
                     <div class="ed-item s-80 spi spd">
                        <label for="">Precio unitario</label>
                        <input id="precioU" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precioU" ng-model="productoSelected.precio_unitario">
                     </div>
                     <div class="ed-item s-20 spi spd">
                        <span>@{{informacion.monedaPrincipal}}</span>
                     </div>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frm.$invalid">
                        Editar Producto
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- Area de subir image --}}
<div class="caja_activar" ng-if="carga_obj">
   <div class="caja_subiendoima">
      <div class="col-sm-12 flet_sol_img">
         <h3 ng-if="existeProducto.imagen==''">Agregar la imagen de @{{existeProducto.nombre}}</h3>
         <h3 ng-if="existeProducto.imagen!=''">Editar la imagen de @{{existeProducto.nombre}}</h3>
      </div>

      <div class="col-sm-12 flet_sol_img">
         <div class="col-sm-12 spd spi subiima" ng-if="areasubir">
            <form action="/file-upload" class="dropzone" id="my-awesome-dropzone" dropzone="dropzoneConfig1" >
            </form>
         </div>

         <div class="col-sm-12 spd spi mtop flet_sol_img">
            <div class="col-sm-6 col-xs-6 spi">
               <span class="btn btn-primary  btn-login" ng-click="guardarImagen()">Agregar</span>
            </div>

            <div class="col-sm-6 col-xs-6 spd">
               <span class="btn btn-primary  btn-cancelar" ng-click="cerrarImagen()">Cancelar</span>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- Detalle producto --}}
<div class="caja_modal" ng-click="fondoDetalle(false)" ng-if="verdetalle"></div>

<div id="area_detalleproductot" ng-if="verdetalle">
   <div class="header_dprocuto no_border">
      <div class="areacerrar">
         <a ng-click="fondoDetalle(false)" class="icocerrar"></a>
      </div>
   </div>

   <div  class="container_detalle">
      <div class="ed-container s-100 h-100">
         <div class="ed-item s-40 sp spi cont_hedimg h-phone">
            {{-- varias imagenes con variacion --}}
            <div class="main-carousel" >
               <div class="imgproduto_detale" style="background:url('@{{productoSelected.imagenes[0].imagen}}')no-repeat center" ng-if="productoSelected.imagenes.length > 0"></div>
               <div class="letraproduto_detale" ng-if="productoSelected.imagenes.length == 0">
                  <h4>@{{productoSelected.nombre | limitTo:1}}</h4>
               </div>

               <div ng-repeat="variante  in productoSelected.variantes"   class="imgproduto_detale carousel-cell" style="background:url('@{{variante.imagenes[0].imagen}}')no-repeat center"></div>
            </div>
         </div>


         <div class="ed-item s-60  spi spd">
            <div class="tit_dprod">
               <p>@{{ productoSelected.nombre | limitTo:35 }} @{{ productoSelected.nombre.length > 35 ? '...' : '' }}</p>
            </div>

            <div class="producto_descri">
               <div class="container_vermenos" ng-if="verMenos">
                  <p>
                     @{{ productoSelected.descripcion | limitTo:200}}
                     @{{ productoSelected.descripcion.length > 200 ? '...' : ''}}
                  </p>
                  <a href="#" ng-if="productoSelected.descripcion.length > 200" ng-click="verDescripcion(true)" class="ng-scope">Ver más</a>
               </div>

               <div class="container_vermas" ng-if="verMas">
                  <p>
                     @{{ productoSelected.descripcion }}
                  </p>
                  <a href="#" ng-click="verDescripcion(false)">Ver menos</a>
               </div>
            </div>

            <div class="con_preciodprod">
               <p class="precio_detalle" ng-repeat="pre in productoSelected.presentacion">
                  <strong>@{{informacion.monedaPrincipal}} @{{pre.precio | number:2}} / @{{pre.medida}}</strong>
               </p>
            </div>

            {{--Variaciones Básicas--}}
            <div class="variaciones_container" ng-if="productoSelected.variantes.length>0">
               <div class="table_variacion" ng-repeat="variante  in productoSelected.variantes" >
                  <input type="checkbox" ng-model="variante.checked" id="@{{ variante.id }}" checked>

                  <label for="@{{ variante.id }}">
                     @{{ variante.nombre | limitTo:25}}
                     @{{ variante.nombre.length > 25 ? '...' : ''}}
                  </label>

                  <span class="modalprice__uds" for="@{{ variante.id }}" ng-repeat="pre in variante.presentacion">
                     <b>@{{informacion.monedaPrincipal}} @{{pre.precio | number:2}}</b>
                  </span>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="area_produtorelacionado" ng-if="verdetalle">
   <div class="header_relacionado no_border">
      <h1>Productos Relacionados</h1>
   </div>

   <div  class="cotainer_relacionado">
      <div class="card_variacion animated fadeIn" ng-repeat="producto in productos | categoria : categoriaRel">
         <div class="card_producto__relacionado">
            <div class="productos_item">
               <div ng-if="producto.imagenes.length > 0">
                  <div class="producto_img" style="background: url('@{{producto.imagenes[0].imagen }}') no-repeat center;" ng-click="detalleprodRel(producto)"></div>
               </div>

               <div ng-if="producto.imagenes.length == 0">
                  <div class="producto_img" style="background: #ccc;" ng-click="detalleprodRel(producto)">
                     <h4>@{{producto.nombre | limitTo:1}}</h4>
                  </div>
               </div>

               <div class="producto_descripcion">
                  <div class="title_producto">
                     <p>@{{producto.nombre}}</p>
                  </div>
               </div>

               <div class="opciones_producto">
                  <div class="precioproducto">
                     <p ng-repeat="pre in producto.presentacion"> @{{informacion.monedaPrincipal}}  @{{pre.precio | number :2}} - @{{pre.medida}}</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- Variaciones Producto --}}
<div class="caja_modal" ng-if="variaProducto">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Variaciones</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12">
            <div class="col-sm-8"></div>
            <div class="col-sm-4">
               <button class="btn btn_secondva" ng-click="btn_show_formulario()">Nueva Variación</button>
            </div>
         </div>

         <div class="col-sm-12">
            <div class="col-sm-10 spi">
               <div class="header_area"  ng-show="showFormulario">
                  <h1>Nueva</h1>
               </div>

               <div class="header_area" ng-show="showFrmModVariante">
                  <h1>Modificar @{{ existeV.nombre }}</h1>
               </div>
            </div>
         </div>

         {{-- variaciones avanzadas--}}
         <div class="col-sm-12 mtop fleft_phonecp">
            <table class="table">
               <thead>
                  <tr>
                     <th class="title_table">SKU</th>
                     <th class="title_table">Nombre</th>
                     <th class="title_table">Stock</th>
                     <th class="title_table">Precio</th>
                     <th class="title_table">opciones</th>
                  </tr>
               </thead>

               <tbody>
                  <tr ng-repeat="producto in productoSelected.variantes">
                     <td class="body_table">@{{producto.sku}}</td>
                     <td class="body_table">@{{producto.nombre}}</td>
                     <td class="body_table">@{{producto.stock}}</td>
                     <td class="body_table">@{{producto.presentacion[0].precio}} @{{informacion.monedaPrincipal}} / @{{producto.presentacion[0].medida}}</td>

                     <td class="body_table">
                        <ul class="opciones">
                           <li>
                              <a ng-click="editarVariante(producto)" class="icoeditar" uib-tooltip="Editar"></a>
                           </li>
                           <li>
                              <a ng-click="subirImagen(producto,true)" class="ico_imgvar" uib-tooltip="Cargar Imagen"></a>
                           </li>
                           <li>
                              <a ng-click="btnElimVpro(producto)" class="ico_eliminar" uib-tooltip="Eliminar"></a>
                           </li>
                        </ul>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>


         {{-- Eliminar Variante --}}
         <div class="caja_activar" ng-if="elimVProducto">
            <div class="caja_subiendo">
               <div class="col-sm-20 flet_sol">
                  <h3>Desea eliminar la variante:  @{{existeV.nombre}}  ?</h3>
               </div>

               <div class="col-sm-12 flet_sol">
                  <div class="col-sm-12 spd spi mtop flet_sol">
                     <div class="col-sm-6 col-xs-6 spi">
                        <span class="btn btn-primary  btn-login" ng-click="eliminarVariante(existeV.id)">Eliminar</span>
                     </div>

                     <div class="col-sm-6 col-xs-6 spd">
                        <span class="btn btn-primary  btn-cancelar" ng-click="cerrarElimVar()">Cancelar</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- Nuevo Variacion --}}
<div class="caja_modal" ng-if="showFormulario">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Nueva variación</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontalContent" name="frmnew" ng-submit="guardarVarianteProducto()">

               <div class="form-group fleft_phone flex__contentnporducto">
                  <div class="col-sm-4 col-xs-4 fleft_phone">
                     <label for="">Código</label>
                     <input id="sku" type="text" class="form-control sinp" name="sku" ng-model="varianteProductos.sku" >
                  </div>
                  <div class="col-sm-8 col-xs-8 fleft_phone">
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-12 col-xs-12  fleft_phone">
                        <label for="">Nombre</label>
                     <input id="nombre" type="text" class="form-control sinp" name="nombre" ng-model="varianteProductos.nombre"  required>
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-12 col-xs-12  fleft_phone">
                        <label for="">Descripcion</label>
                     <textarea id="descripcion" type="text" class="form-control sinp ng-pristine ng-valid ng-empty ng-touched" name="descripcion" ng-model="varianteProductos.descripcion" rows="5" style=""></textarea>
                  </div>
               </div>
               <div class="form-group fleft_phone">
                  <div class="col-sm-12  fleft_phone">
                     <label for="">Precio</label>
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-6 col-xs-12 spf inpumoneda">
                     <div class="col-sm-8 col-xs-8 spi spd">
                        <input id="precioq" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precioq" ng-model="varianteProductos.precio_unitario" placeholder="0.00">
                     </div>
                     <div class="col-sm-4 col-xs-4 spi spd">
                        <span>@{{informacion.monedaPrincipal}}</span>
                     </div>
                  </div>
               </div>

               <div class="col-sm-12 mtop2">
                  <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                     <button type="submit" class="btn btn-primary  btn-login" ng-disabled="frmnew.$invalid">Crear Variación</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- Editar Variacion --}}
<div class="caja_modal" ng-if="showFrmModVariante">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Editar variación</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp">
            <form class="form-horizontalContent" name="frm" ng-submit="edVariante()">
               <div class="form-group fleft_phone">
                  <div class="col-sm-4 col-xs-12  fleft_phone">
                        <label for="">Código</label>
                     <input id="sku" type="text" class="form-control sinp" name="sku" ng-model="existeV.sku" >
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-12 col-xs-12  fleft_phone">
                        <label for="">Nombre del producto/servicio</label>
                     <input id="nombre" type="text" class="form-control sinp" name="nombre" ng-model="existeV.nombre" placeholder="Nombre de la variación" required>
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-12 col-xs-12  fleft_phone">
                     <label for="">Descripcion</label>
                     <textarea id="descripcion" type="text" class="form-control sinp ng-pristine ng-valid ng-empty ng-touched" name="descripcion" ng-model="productoSelected.descripcion" rows="4" placeholder="Descripción" style=""></textarea>
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-12  fleft_phone">
                     <label for="">Precio</label>
                  </div>
               </div>

               <div class="form-group fleft_phone">
                  <div class="col-sm-6 col-xs-12 spf inpumoneda">
                     <div class="col-sm-8 col-xs-8 spi spd">
                        <input id="precioq" type="number"  min="0" step="any" class="form-control nobordere sinp" name="precioq" ng-model="existeV.precio_unitario" placeholder="0.00">
                     </div>
                     <div class="col-sm-4 col-xs-4 spi spd">
                        <span>@{{informacion.monedaPrincipal}}</span>
                     </div>
                  </div>
               </div>

               <div class="col-sm-12 mtop2">
                  <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                     <button type="submit" class="btn btn-primary  btn-login" ng-disabled="frm.$invalid"> Editar Producto</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- Deshabilitar producto --}}
<div class="caja_activar" ng-if="disablProducto">
   <div class="caja_subiendo">
      <div class="col-sm-20 flet_sol">
         <h3> Desea deshabilitar el producto:  @{{productoSelected.nombre}}  ?</h3>
      </div>

      <div class="col-sm-12 flet_sol">
         <div class="col-sm-12 spd spi mtop flet_sol">
            <div class="col-sm-6 col-xs-6 spi">
               <span class="btn btn-primary  btn-login" ng-click="deshabilitar(productoSelected.id)">Deshabilitar</span>
            </div>

            <div class="col-sm-6 col-xs-6 spd">
               <span class="btn btn-primary  btn-cancelar" ng-click="cerrar()">Cancelar</span>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- DETALLE DE STOCK --}}
<div class="caja_modal" ng-show="modal_detalle_stock">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Existencia</h1>
         <div class="areacerrar">
            <a ng-click="modal_detalle_stock = false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">

         {{-- variaciones avanzadas--}}
         <div class="col-sm-12 mtop fleft_phonecp">
            <table class="table">
               <thead>
                  <tr>
                     <th class="title_table">No.</th>
                     <th class="title_table">Bodega</th>
                     <th class="title_table">Existencia</th>
                  </tr>
               </thead>

               <tbody>
                  <tr ng-repeat="producto in productoSelected.variantes">
                     <td class="body_table">@{{producto.sku}}</td>
                     <td class="body_table">@{{producto.nombre}}</td>
                     <td class="body_table">@{{producto.stock}}</td>
                     <td class="body_table">@{{producto.presentacion[0].precio}} @{{informacion.monedaPrincipal}} / @{{producto.presentacion[0].medida}}</td>

                     <td class="body_table">
                        <ul class="opciones">
                           <li>
                              <a ng-click="editarVariante(producto)" class="icoeditar" uib-tooltip="Editar"></a>
                           </li>
                           <li>
                              <a ng-click="subirImagen(producto,true)" class="ico_imgvar" uib-tooltip="Cargar Imagen"></a>
                           </li>
                           <li>
                              <a ng-click="btnElimVpro(producto)" class="ico_eliminar" uib-tooltip="Eliminar"></a>
                           </li>
                        </ul>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>

      </div>
   </div>
</div>

