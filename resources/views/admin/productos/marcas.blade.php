{{-- MANTENIMIENTO DE MARCAS --}}
<div class="caja_modal" ng-show="modalMarcas">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Listado de marcas</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <br>
            <form class="form-horizontal form_posc" name="frm1" ng-submit="guardarMarca()">

               <div class="ed-container full spd spi">
                  <div class="col-sm-8 spi sp_phone">
                     <div class="form-group input_boxpos">
                        <input type="text" placeholder="Nombre de la marca" ng-model="marca.nombre" class="form-control sinp" ng-pattern="/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]*$/" required>
                     </div>
                  </div>
                  <div class="col-sm-4 spi sp_phone">
                     <div class="form-group input_boxpos">
                        <button type="submit" ng-disabled="frm1.$invalid" class="btn btn_formagregar"> Agregar </button>
                     </div>
                  </div>
               </div>
            </form>

            <div class="cont_maxform">
               @{{text}}
               <table class="table table-striped mtop_table table_phone">
                  <thead>
                     <tr class="flex">
                        <th class="title_table thico col-sm-2">Codigo</th>
                        <th class="title_table col-sm-8">Nombre</th>
                        <th class="title_table col-sm-2">Opciones</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat="marca in marcas" class="flex">
                        <td class="body_table col-sm-2"><span>@{{marca.codigo}}</span></td>
                        <td class="body_table col-sm-8" contenteditable="true" id="td_@{{marca.nombre}}"><span>@{{marca.nombre}}</span></td>
                        <td class="col-sm-2">
                           <span class="icoeditar icotfaq" uib-tooltip="Editar" ng-click="editarMarca(marca)"></span>
                           <span class="icoeliminar icotfaq" uib-tooltip="Eliminar" ng-click="eliminarMarca(marca)"></span>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- Eliminar  Marca --}}
<div class="caja_activar" ng-if="modalEliminarMarca">
   <div class="caja_subiendo">
      <div class="col-sm-12 flet_sol">
         <h3> Eliminar la marca:  @{{marcaSelect.nombre}}</h3>
      </div>

      {{-- <div class="col-sm-12 spi">
            <p>Al eliminar esta marca todo los productos asociados quedaran sin marca</p>
      </div> --}}
      <div class="col-sm-12 flet_sol">
         <div class="col-sm-12 spd spi mtop flet_sol">
            <div class="col-sm-6 col-xs-6 spi">
               <span class="btn btn-primary btn-login" ng-click="aceptarEliminarMarca()">Eliminar</span>
            </div>

            <div class="col-sm-6 col-xs-6 spd">
               <span class="btn btn-primary btn-cancelar" ng-click="eliminarMarca()">Cancelar</span>
            </div>
         </div>
      </div>
   </div>
</div>
