{{-- Nuevo Cliente --}}
<div class="caja_modal" ng-show="nuevo_obj">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Nuevo Cliente</h1>
         <div class="areacerrar">
            <a ng-click="nuevo_obj=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal." name="frmnew" novalidate ng-submit="guardarCliente()">

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="nit">NIT</label>
                     <input id="nit" type="text" class="form-control sinp" name="nit" ng-model="cliente.nit">
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">

                     <label for="depto">Tipo de cliente</label>
                     <ol class="nya-bs-select mol relcont" ng-model="cliente.codigo_tipoCliente" data-live-search="true" data-size="5" title="Selecciona..." required>
                        <li nya-bs-option="tipo in TipoNegocios" data-value="tipo.codigo">
                           <a>
                              @{{ tipo.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>

                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="muni">Canal</label>
                     <ol class="nya-bs-select mol relcont" ng-model="cliente.codigo_canal" data-live-search="true" data-size="7" title="Selecciona..." required>
                        <li nya-bs-option="canal in Canales" data-value="canal.codigo">
                           <a>
                              @{{canal.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="empresa">Empresa</label>
                     <input id="empresa" type="text" class="form-control sinp" name="empresa" ng-model="cliente.empresa" required >
                     <div ng-messages="frmnew.empresa.$error" ng-if="frmnew.empresa.$dirty && frmnew.empresa.$invalid || frmnew.$submitted">
                        <div ng-message="required" class="width_register menarea" >El nombre de la empresa es requerido</div>
                     </div>
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="contacto">Contacto</label>
                     <input id="contacto" type="text" class="form-control sinp" name="contacto" ng-model="cliente.nombre" required>
                     <div ng-messages="frmnew.contacto.$error" ng-if="frmnew.contacto.$dirty && frmnew.contacto.$invalid || frmnew.$submitted">
                        <div ng-message="required" class="width_register menarea" >El nombre contacto es requerido</div>
                     </div>
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="correo">Correo</label>
                     <input type="email" class="form-control sinp" id="correo" name="correo" ng-model="cliente.correo" required>
                     <div ng-messages="frmnew.correo.$error" ng-if="frmnew.correo.$dirty && frmnew.correo.$invalid || frmnew.$submitted">
                        <div ng-message="required" class="width_register menarea">Correo requerido</div>
                        <div ng-message="email" class="width_register menarea">Correo invalido</div>
                     </div>
                  </div>
                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="tel">Teléfono</label>
                     <input id="tel" type="text" class="form-control sinp" name="telefono" ng-model="cliente.telefono"  required>
                     <div ng-messages="frmnew.telefono.$error" ng-if="frmnew.telefono.$dirty && frmnew.telefono.$invalid || frmnew.$submitted">
                        <div ng-message="required" class="width_register menarea">Correo requerido</div>
                        <div ng-message="tel" class="width_register menarea">Numero invalido</div>
                     </div>
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="direccion">Dirección</label>
                     <input id="direccion" type="text" class="form-control sinp" name="direccion" ng-model="cliente.direccion" required>
                     <div ng-messages="frmnew.direccion.$error" ng-if="frmnew.direccion.$dirty && frmnew.direccion.$invalid || frmnew.$submitted">
                        <div ng-message="required" class="width_register menarea">La direccion es requerida</div>
                     </div>
                  </div>
                  <div class="ed-item s-100 m-50 spd">
                     <label for="zona">Zona</label>
                     <input id="zona" type="text" class="form-control sinp" name="zona" ng-model="cliente.zona">
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
                     <ol class="nya-bs-select mol relcont" ng-model="cliente.codigo_municipio" data-live-search="true" data-size="7" title="Selecciona..." required>
                        <li nya-bs-option="muni in municipios" data-value="muni.codigo">
                           <a>
                              @{{muni.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save">
                        Crear Cliente
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- Editar cliente --}}
<div class="caja_modal" ng-if="editar_obj">
   <div id="modal_nuevo">
      <div class="header_area">
         <h1>Editar Cliente</h1>
         <div class="areacerrar">
            <a ng-click="cerrar()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal." name="frmedit" novalidate ng-submit="editarCliente()">

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="nit">NIT</label>
                     <input id="nit" type="text" class="form-control sinp" name="nit" ng-model="clienteSelect.nit">
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">

                     <label for="depto">Tipo de cliente</label>
                     <ol class="nya-bs-select mol relcont" ng-model="clienteSelect.codigo_tipoNegocio" data-live-search="true" data-size="5" title="Selecciona..." required>
                        <li nya-bs-option="tipo in TipoNegocios" data-value="tipo.codigo">
                           <a>
                              @{{ tipo.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>

                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="muni">Canal</label>
                     <ol class="nya-bs-select mol relcont" ng-model="clienteSelect.codigo_canal" data-live-search="true" data-size="7" title="Selecciona..." required>
                        <li nya-bs-option="canal in Canales" data-value="canal.codigo">
                           <a>
                              @{{canal.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="empresa">Empresa</label>
                     <input id="empresa" type="text" class="form-control sinp" name="empresa" ng-model="clienteSelect.empresa" required >
                     <div ng-messages="frmedit.empresa.$error" ng-if="frmedit.empresa.$dirty && frmedit.empresa.$invalid || frmedit.$submitted">
                        <div ng-message="required" class="width_register menarea" >El nombre de la empresa es requerido</div>
                     </div>
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="contacto">Contacto</label>
                     <input id="contacto" type="text" class="form-control sinp" name="contacto" ng-model="clienteSelect.nombre" required>
                     <div ng-messages="frmedit.contacto.$error" ng-if="frmedit.contacto.$dirty && frmedit.contacto.$invalid || frmedit.$submitted">
                        <div ng-message="required" class="width_register menarea" >El nombre contacto es requerido</div>
                     </div>
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi">
                     <label for="correo">Correo</label>
                     <input type="email" class="form-control sinp" id="correo" name="correo" ng-model="clienteSelect.email" readonly disabled>
                  </div>
                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="tel">Teléfono</label>
                     <input id="tel" type="text" class="form-control sinp" name="telefono" ng-model="clienteSelect.telefono"  required>
                     <div ng-messages="frmedit.telefono.$error" ng-if="frmedit.telefono.$dirty && frmedit.telefono.$invalid || frmedit.$submitted">
                        <div ng-message="required" class="width_register menarea">Correo requerido</div>
                        <div ng-message="tel" class="width_register menarea">Numero invalido</div>
                     </div>
                  </div>
               </div>

               <div class="form-group ed-container full">
                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="direccion">Dirección</label>
                     <input id="direccion" type="text" class="form-control sinp" name="direccion" ng-model="clienteSelect.ubicacion" required>
                     <div ng-messages="frmedit.direccion.$error" ng-if="frmedit.direccion.$dirty && frmedit.direccion.$invalid || frmedit.$submitted">
                        <div ng-message="required" class="width_register menarea">La direccion es requerida</div>
                     </div>
                  </div>

                  <div class="ed-item s-100 m-50 spd">
                     <label for="zona">Zona</label>
                     <input id="zona" type="text" class="form-control sinp" name="zona" ng-model="clienteSelect.zona">
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
                     <ol class="nya-bs-select mol relcont" ng-model="clienteSelect.codigo_municipio" data-live-search="true" data-size="7" title="Selecciona..." required>
                        <li nya-bs-option="muni in municipios" data-value="muni.codigo">
                           <a>
                              @{{muni.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>


               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save">
                        Editar Cliente
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- Carga de cliente --}}
<div class="bg_fix_clientes" ng-if="carga_obj">
   <div id="modal_nuevo" class="w_data_excel">
      <div class="header_area">
         <h1>Carga masiva de cliente</h1>
         <div class="areacerrar">
            <a ng-click="cerrarCarga()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">

            <div class="col-sm-12 col-xs-12 spd spi">
               <div class="ed-container">
                  <div class="ed-item s-100">
                     <div class="form-group container_formcuentas">
                        {{-- <js-xls onread="read" onerror="error" class="form-control snip input_file" id="excel"></js-xls> --}}
                        <label for="excel" class="label_filec">
                           <span>@{{nombreArchivo}}</span>
                           <strong>
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25">
                                 <path fill="#fff" d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                              </svg>
                              <p>Seleccione un archivo</p>
                           </strong>
                        </label>
                        <js-xls onread="read" onerror="error" class="form-control snip input_file inputfile" style="visibility:hidden;" id="excel"></js-xls>
                     </div>
                  </div>

                  <div class="form-group btnbox_center ed-item s-100">
                     <a href="https://pagalocard.s3.amazonaws.com/pagaloPOS/PlantillaClientesPOS.xlsx" class="link_plantilla">Descargar plantilla</a>
                  </div>
                  <div class="form-group btnbox_center ed-item s-100">
                     <a href="https://pagalocard.s3.amazonaws.com/pagaloPOS/nomenglatura.xls" class="link_plantilla">Descargar nomenglatura</a>
                  </div>
               </div>

               <div class="center_formcxc menarea" ng-if="showError">
                  <span> @{{mierror}}</span>
               </div>
            </div>

            {{-- LISTADO DE CLIENTES CARGADOS --}}
            <div class="col-xs-12 spd spi content__datac" ng-if="datosExcel.length > 0">

               <table class="table table-borderless table_separate">
                  <thead class="table_head_order">
                     <tr>
                        <th>Celda</th>
                        <th>Comercio</th>
                        <th>Contacto</th>
                        <th>Correo</th>
                        <th>NIT</th>
                        <th>Teléfono</th>
                        <th>Ubicacion</th>
                        <th>Municipio</th>
                        <th>Tipo</th>
                        <th>Canal</th>
                     </tr>
                  </thead>

                  <tbody class="table_body_order">
                     <tr ng-repeat="data in datosExcel">
                        <td class="radius_left">@{{$index+2}}</td>
                        <td>@{{data.comercio}}</td>
                        <td>@{{data.contacto }}</td>
                        <td ng-class="{celdaInvalid : !data.correoValido}">@{{data.correo}}</td>
                        <td>@{{data.nit}}</td>
                        <td ng-class="{celdaInvalid : !data.telefonoValido}">@{{data.telefono}}</td>
                        <td>@{{data.ubicacion}}</td>
                        <td ng-class="{celdaInvalid : data.nombre_municipio=='Código incorrecto'}">@{{data.nombre_municipio}}</td>
                        <td ng-class="{celdaInvalid : data.nombre_tipo=='Código incorrecto'}">@{{data.nombre_tipo}}</td>
                        <td ng-class="{celdaInvalid : data.nombre_canal=='Código incorrecto'}">@{{data.nombre_canal}}</td>
                     </tr>
                  </tbody>
               </table>

            </div>

            <div class="col-xs-12 spd spi" ng-if="!dataExcelValid">
               <div class="form-group btnbox_center ed-item s-100 menarea">
                  <p>El archivo contiene algunos errores de validación, verifica los datos marcados en rojo y vuelva a intentarlo.</p>
               </div>
            </div>

            <div class="col-sm-12 col-xs-12 spd spi" ng-if="datosExcel.length > 0 && dataExcelValid">
               <div class="form-group btnbox_center ed-item s-100">
                  <button type="button" class="btn btn_save" ng-click="cargaClientes()"> Guardar clientes </button>
               </div>
            </div>

            {{-- LISTADO DE RESUMEN DE CARGA DE CLIENTES --}}
            <div class="col-sm-12 col-xs-12 spd spi content__datac" ng-if="resultadoClientes.length > 0">

               <table class="table table-borderless table_separate">
                  <thead class="table_head_order">
                     <tr>
                        <th>No.</th>
                        <th>Comercio</th>
                        <th>Contacto</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Motivo</th>
                     </tr>
                  </thead>

                  <tbody class="table_body_order">
                     <tr ng-repeat="data in resultadoClientes"  ng-class="{celdaInvalid : !data.exitoso, celdaValid : data.exitoso}">
                        <td class="radius_left">@{{$index+1}}</td>
                        <td>@{{data.comercio}}</td>
                        <td>@{{data.contacto }}</td>
                        <td>@{{data.correo}}</td>
                        <td>@{{data.telefono}}</td>
                        <td>@{{data.comentario}}</td>
                     </tr>
                  </tbody>
               </table>

            </div>

         </div>
      </div>
   </div>
</div>
