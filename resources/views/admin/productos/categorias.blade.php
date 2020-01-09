{{-- MANTENIMIENTO DE CATEGORIAS --}}
<div class="caja_modal" ng-show="modalCategorias">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Listado de categorias</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <br>
            <div class="cont_maxform">
               @{{text}}
               <table class="table table-striped mtop_table table_phone">
                  <thead>
                     <tr class="flex">
                        <th class="title_table col-sm-2">Código</th>
                        <th class="title_table thico col-sm-8">Nombre de la categoria</th>
                        <th class="title_table col-sm-2">Subcategoria</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat="categoria in categorias" class="flex">
                        <td class="body_table col-sm-2"><span>@{{categoria.codigo}}</span></td>
                        <td class="body_table col-sm-8"><span>@{{categoria.nombre}}</span></td>
                        <td class="col-sm-2">
                           <span class="icotfaq ico_visto" ng-click="showSubCategorias(categoria)"></span>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- MANTENIMIENTO DE SUB CATEGORIAS --}}
<div class="caja_modal" ng-show="modalSubcategorias">

   <div id="modal_nuevo">
      <div class="header_area">
         <h1>
            <span ng-click="showCategorias()" style="cursor:pointer">
               Todas
            </span>
            <span ng-repeat="tab in tabs_categorias" ng-click="ReturnSubCategorias(tab,$index)" style="cursor:pointer">
               <span>/</span> @{{tab.nombre}}
            </span>
         </h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <br>
            <form class="form-horizontal form_posc" name="frm" ng-submit="guardarCategoria()">

               <div class="ed-container full spd spi">
                  <div class="col-sm-8 spi sp_phone">
                     <div class="form-group input_boxpos">
                        <input type="text" placeholder="Nombre de la sub-categoria" ng-model="categoria.nombre" class="form-control sinp" ng-pattern="/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]*$/" required>
                     </div>
                  </div>
                  <div class="col-sm-4 spi sp_phone">
                     <div class="form-group input_boxpos">
                        <button type="submit" ng-disabled="frm.$invalid" class="btn btn_formagregar"> Agregar </button>
                     </div>
                  </div>
               </div>
            </form>

            <div class="cont_maxform">
               <table class="table table-striped mtop_table table_phone">
                  <thead>
                     <tr class="flex">
                        <th class="title_table thico col-sm-2">Código</th>
                        <th class="title_table col-sm-8">Nombre de la sub-categoria</th>
                        <th class="title_table col-sm-2">Opciones</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat="sub in subCategorias" class="flex">
                        <td class="body_table col-sm-2"><span>@{{sub.codigo}}</span></td>
                        <td class="body_table col-sm-8" contenteditable="true" id="td_@{{sub.nombre}}"><span>@{{sub.nombre}}</span></td>
                        <td class="col-sm-2">
                           <span class="icoeditar icotfaq" uib-tooltip="Editar" ng-click="editarCategoria(sub)"></span>
                           <span class="icoeliminar icotfaq" uib-tooltip="Eliminar" ng-click="eliminarCategoria(sub)"></span>
                           <span class="icotfaq ico_visto" ng-click="showSubCategorias(sub)"></span>
                        </td>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

</div>


{{-- ELIMINAR CATEGORIA --}}
<div class="caja_activar" ng-if="modalEliminarCategoria">
   <div class="caja_subiendo">
      <div class="col-sm-12 flet_sol">
         <h3> Eliminar categoria:  @{{categoriaSelect.nombre}} </h3>
      </div>

      <div class="col-sm-12 flet_sol menarea" ng-if="errorCategoria!=''">
         <p> @{{errorCategoria}}</p>
      </div>

      <div class="col-sm-12 flet_sol">
         <div class="col-sm-12 spd spi mtop flet_sol">
            <div class="col-sm-6 col-xs-6 spi">
               <span class="btn btn-primary btn-login" ng-click="aceptarEliminarCategoria()">Eliminar</span>
            </div>

            <div class="col-sm-6 col-xs-6 spd">
               <span class="btn btn-primary btn-cancelar" ng-click="eliminarCategoria()">Cancelar</span>
            </div>
         </div>
      </div>
   </div>
</div>
