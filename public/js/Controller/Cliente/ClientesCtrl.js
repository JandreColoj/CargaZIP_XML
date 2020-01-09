posApp.controller('ClientesCtrl', function ($scope, $http,$timeout, functionCtrl){

   $scope.tabla_pedidos = true;
   $scope.datosExcel = [];
   $scope.resultadoClientes = [];
   $scope.cliente    = {};
   $scope.municipios = {};
   $scope.sucursal   = {};
   $scope.filtro     = {};

   $scope.estadoCliente = [
      'Activo',
      'Inactivo'
   ];

   $scope.Parametros = function (){
      $http.get('api/general/parametros').success(function(response){
         $scope.Canales = response.datos.canales;
         $scope.TipoNegocios = response.datos.tipoNegocio;
         $scope.Departamentos = response.datos.departamentos;
      });
   }

   $scope.showModalCliente = function (cliente){
      $scope.showDataClient = true;

      $http.get('api/clientes/historial/'+cliente.identidad_cliente).success(function(response){
         $scope.pedidosCliente = response.pedidos;
         $scope.productosCliente = response.productos;
      });
   }

   $scope.modalResponse = function(mensaje, tipo){

      if(tipo == 'error') {
         $scope.modalError = true;
      }else if(tipo == 'success'){
         $scope.modalSuccess = true;
      }
      $scope.mensaje = mensaje;
   }

   $scope.loader = function (mensaje = false){
      if (mensaje!=false) {
         $scope.loadding = true;
         $scope.mensaje = mensaje;
      }else{
         $scope.loadding = false;
      }
   }

   $scope.cerrar = function(){
      $scope.mensaje = '';
      $scope.modalError = false;
      $scope.modalSuccess = false;

      $scope.editar_obj = false;
      $scope.showDataClient = false;
   }

   $scope.aceptarCliente = function(id_cliente){
      $http.get('api/clientes/aceptar/'+id_cliente).then(function(){
         $scope.getClientes();
      });
   }

   /* NUEVO CLIENTE */
   $scope.guardarCliente = function(){

      if(this.frmnew.$invalid){ return 0; }

      $scope.nuevo_obj = false;
      $scope.loader('Guardando nuevo cliente . . .');

      $http.post('api/clientes/nuevo', $scope.cliente).success(function(response){

         $scope.loader();

         if(response.codigo==200){
            $scope.modalResponse(response.mensaje, 'success');
            $scope.getClientes();
            $scope.resetForm('frmnew');
         }else{
            $scope.modalResponse(response.mensaje, 'error');
         }
      });

   }

   $scope.editCliente = function(cliente){
      $scope.editar_obj = true;
      $scope.clienteSelect = cliente; console.log(cliente);

      $scope.Departamentos.forEach(element => {
         if ($scope.clienteSelect.municipio.departamento.codigo == element.codigo){
            $scope.municipios = element.municipios;
         }
      });
   }

   $scope.editarCliente = function(){

      if(this.frmedit.$invalid){ return 0; }

      $scope.editar_obj = false;
      $scope.loader('Editando cliente . . .');

      $http.post('api/clientes/editar', $scope.clienteSelect).success(function(response){

         $scope.loader();

         if(response.codigo==200){
            $scope.modalResponse(response.mensaje, 'success');
            $scope.resetForm('frmedit');
            $scope.getClientes();

         }else{
            $scope.modalResponse(response.mensaje, 'error');
         }
      });

   }

   $scope.inhabilitarCliente = function(cliente){

      if(cliente.eliminar){

         $http.post('api/clientes/inhabilitar', {'id' :cliente.id}).success(function(response){

            if(response.codigo==200){
               $scope.getClientes();
            }

         });

      }

      cliente.eliminar = true; //cambia de color el icono
   }

   $scope.resetForm = function(tipo){

      if (tipo=='frmnew') {
         $scope.frmnew.$setPristine();
         $scope.frmnew.$setUntouched();
         $scope.cliente = {};
      }else if(tipo=='frmedit'){    }

   }

   /******************** archivo excel ********************/
      $scope.cerrarCarga = function(){
         $scope.dataExcelValid = true;
         $scope.carga_obj  = false;
         $scope.nombreArchivo = '';
         $scope.datosExcel = [];
         $scope.resultadoClientes = [];
      }

      $scope.dataExcelValid = true;
      $scope.read = function (workbook){

         $scope.valido = $scope.validarArchivo();

         if(!$scope.valido){

            $timeout(function(){
               $scope.datosExcel = [];
               $scope.showError = true;
            },1000);

            return 0;
         }

         var headerNames = XLSX.utils.sheet_to_json( workbook.Sheets[workbook.SheetNames[0]], { header: 1 })[0];
         $scope.data = XLSX.utils.sheet_to_json( workbook.Sheets[workbook.SheetNames[0]]);

         //validacion de encabezados del excel
         //Si se cambian los nombre de las columnas, modificar el registro en PAGALO
         var titulos = new Array('comercio','contacto','telefono','correo','ubicacion','municipio','tipo cliente', 'canal','nit','zona');
         var existe = true;

         for(var i = 0; i < headerNames.length; i++) {
            if (!titulos.includes(headerNames[i])) {
               existe = false;
               break;
            }
         }

         if(!existe){

            $timeout(function(){
               $scope.showError = true;
               $scope.datosExcel = [];
               $scope.mierror = "El archivo no tiene las columnas correctas, descargue la plantilla.";
            },1000);

            return 0;
         }

         $timeout(function(){
            $scope.resultadoClientes = [];
            $scope.loader('Cargando datos . . . ');
            $scope.carga_obj = false;
         },50);

         for (let index = 1; index < $scope.data.length; index++) {

            Object.keys($scope.data[index]).forEach(function(key) {

               if(key=='correo') {
                  $scope.data[index]['correoValido'] = functionCtrl.validarEmail($scope.data[index][key]);

                  if(!$scope.data[index]['correoValido'])
                     $scope.dataExcelValid = false;
               }

               if(key=='telefono'){
                  $scope.data[index]['telefonoValido'] = functionCtrl.validarTelefono($scope.data[index][key]);

                  if(!$scope.data[index]['telefonoValido'])
                     $scope.dataExcelValid = false;
               }

               if(key=='tipo cliente'){
                  $scope.data[index]['nombre_tipo'] = functionCtrl.validarTipoClientes($scope.data[index][key], $scope.TipoNegocios);
               }

               if(key=='canal'){
                  $scope.data[index]['nombre_canal'] = functionCtrl.validarCanal($scope.data[index][key], $scope.Canales);
               }

               if(key=='municipio'){
                  $scope.data[index]['nombre_municipio'] = functionCtrl.validarMunicipio($scope.data[index][key], $scope.Departamentos);
               }

               //console.log("Key = >" + key); console.log("Value => " + $scope.data[index][key]);
            });

         }

         if($scope.data[0].comercio=='Nombre del negocio'){
            $scope.data.shift();
         }


         $timeout(function(){
            $scope.loader();
            $scope.datosExcel = $scope.data;
            $scope.carga_obj = true;
            $scope.dataExcelValid;
         },100);
      }

      $scope.validarArchivo = function(){

         $scope.nombreArchivo = document.getElementById("excel").value;
         var extensiones_permitidas = new Array(".xls", ".xlsx");

         $scope.mierror = "";
         $scope.showError = false;
         extension = ($scope.nombreArchivo.substring($scope.nombreArchivo.lastIndexOf("."))).toLowerCase();

         permitida = false;

         for (var i = 0; i < extensiones_permitidas.length; i++) {
            if (extensiones_permitidas[i] == extension) {
               permitida = true;
               break;
            }
         }

         if(!permitida){
            $scope.mierror = "Sólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
            return false;
         }else{
            return true;
         }

      }

      $scope.cargaClientes = function () {

         if($scope.loadding){ return 0; }

         $scope.loader('Creando cliente . . .');

         $http.post('api/clientes/cargaMasiva', $scope.datosExcel).success(function(response){

            $scope.loader();

            if(response.codigo==200){

               $scope.datosExcel = [];
               $scope.resultadoClientes = response.resultado;
               $scope.getClientes();
               $scope.modalResponse(response.mensaje, 'success');
            }else{
               $scope.modalResponse(response.mensaje, 'error');
            }
         });

      }
   /******************** archivo excel ********************/

   $scope.detallePedido = function(id){

      $scope.baseUrl = new $window.URL($location.absUrl()).href;

      $window.location.href = $scope.baseUrl+"pedidos?pedido="+id;
   }

   $scope.showTablePedidos =  function(){
      $scope.tabla_pedidos = true;
      $scope.tabla_productos = false;
   }

   $scope.showTableProductos =  function(){
      $scope.tabla_productos = true;
      $scope.tabla_pedidos = false;
   }

   /*************************************** SUCURSALES ****************************************/
      $scope.verSucursales = function(cliente){
         $scope.showSucursales = true;
         $scope.selectCliente = cliente;
         $scope.getSucursales(cliente.identidad_cliente);
      }

      $scope.getSucursales = function (identidad_cliente){

         $scope.loader('Cargando . . .');

         $http.get('api/clientes/getSucursales/'+identidad_cliente).success(function(response){
            $scope.sucursales = response.sucursales;

            $timeout(function(){
               $scope.sucursales.forEach(element => {
                  $scope.mapaGoogle(element,'mapa');
                  $scope.loader();
               });

               $scope.loader();
             },2000);

         });
      }

      $scope.detalleSucursal = function (sucursal){

         $scope.loader('Cargando . . .');
         $scope.modal_detalle_sucursal = true;
         $scope.selectSucursal = sucursal;

         $timeout(function() {
            $scope.mapaGoogle(sucursal,'mapaSelect');
            $scope.loader();
         },1000);

      }

      $scope.mapaGoogle = function(sucursal,id) {
         var mapOptions = {
            center: new google.maps.LatLng(sucursal.latitud, sucursal.longitud),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP};
            var map = new google.maps.Map(document.getElementById(id+sucursal.id),mapOptions);
      }

      $scope.guardarSucursal = function(){

         $scope.loader('Creando sucursal . . .');
         $scope.sucursal.cliente = $scope.selectCliente;

         $http.post('api/clientes/nuevaSucursal',$scope.sucursal).success(function(response){
            $scope.loader();

            if(response.codigo = 200){
               $scope.sucursal = {};
               $scope.getSucursales($scope.selectCliente.identidad_cliente);
               $scope.modal_nueva_sucursal = false;
            }

         });
      }

      $scope.showEditarSucursal = function(){
         $scope.modal_editar_sucursal = true;
         $scope.modal_detalle_sucursal = false;

         $scope.Departamentos.forEach(element => {
            if ($scope.selectSucursal.codigo_municipio == element.codigo){
               $scope.municipios = element.municipios;
            }
         });
      }

      $scope.editarSucursal = function(){

         $scope.loader('Editando sucursal . . .');

         $http.post('api/clientes/editarSucursal', $scope.selectSucursal).success(function(response){

            $scope.loader();

            if(response.codigo = 200){
               $scope.getSucursales($scope.selectCliente.identidad_cliente);
               $scope.modal_editar_sucursal = false;
            }
         });

      }

      $scope.eliminarSucursal = function(){

         $scope.modal_detalle_sucursal = false;

         $http.get('api/clientes/eliminarSucursal/'+$scope.selectSucursal.id).success(function (response){

            if(response.codigo==200){
               $scope.getSucursales($scope.selectCliente.identidad_cliente);
            }else{
               $scope.modalResponse(response.mensaje,'error');
            }

         })
      }

      $scope.cerrar_sucursal = function(){
         $scope.modal_detalle_sucursal = false
      }
   /*************************************** SUCURSALES ***************************************/

   //CLIENTES
   $scope.getClientes = function(){

      $scope.loader('Cargando clientes . . .');

      $http.post('api/clientes/getClientes',$scope.filtro).success(function(response){
         $scope.clientes = response.clientes;
         $scope.loader();
      });
   }

   $scope.Parametros();
   $scope.getClientes();
});
