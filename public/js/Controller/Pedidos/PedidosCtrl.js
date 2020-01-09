posApp.controller('PedidosCtrl', function ($scope, $http, $window, $location, $timeout) {

   $scope.nuevo_pedido = true;
   $scope.pilotoAsing  = false;
   $scope.filtro = {};

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
   }

   $scope.closeStatus = function(){
      $scope.nuevo_pedido   = false;
      $scope.bodega         = false;
      $scope.ruta_pedido    = false;
      $scope.estado_pedido  = false;
      $scope.entregado      = false;
      $scope.cancelado      = false;
      $scope.asignar_piloto = false;
   }

   $scope.Parametros = function(){
      $http.get('api/general/parametros').success(function(response){
         $scope.Estados = response.datos.estados;

         var element = {};
         element.nombre = 'Todos';
         element.codigo = 0;
         $scope.Estados.unshift(element);
      });
   }

   $scope.existePedido = {};
   $scope.changeStatus = function (pedido){
      var scrollbhidden = angular.element(document.querySelector('body'));
      scrollbhidden.addClass('hide_scroll');

      $scope.existePedido = pedido;

      $scope.bitacora = {};
      $scope.bitacora.bodega     = $scope.existePedido.bitacora.find(function(element) { return element.cambio_estado == 3; });
      $scope.bitacora.ruta       = $scope.existePedido.bitacora.find(function(element) { return element.cambio_estado == 4; });
      $scope.bitacora.completado = $scope.existePedido.bitacora.find(function(element) { return element.cambio_estado == 5; });

      $scope.slug         = pedido.estado.nombre;
      $scope.fondodetalle = !$scope.fondodetalle;
      $scope.verdetalle   = !$scope.verdetalle;

      switch ($scope.slug) {
         case 'Nuevo':
            $scope.closeStatus();
            $scope.nuevo_pedido = true;

            //cambia el estado 2 de visto
            $http.post('api/pedidos/pedidoVisto/' + pedido.id).success(function (){
               $scope.getPedidos();
            });
         break;

         case 'Visto':
            $scope.closeStatus();
            $scope.nuevo_pedido = true;
         break;

         case 'Bodega':
            $scope.closeStatus();
            $scope.bodega = true;
         break;

         case 'Ruta':
            $scope.closeStatus();
            $scope.ruta_pedido = true;
         break;

         case 'Completado':
            $scope.closeStatus();
            $scope.estado_pedido = true;
            $scope.entregado = true;
         break;

         case 'Cancelado':
            $scope.closeStatus();
            $scope.estado_pedido = true;
            $scope.cancelado = true;
         break;

         default:
            console.log('no entro');
         break;
      }
   }

   $scope.showDetalle = function () {
      var scrollShow = angular.element(document.querySelector('body'));
      scrollShow.removeClass('hide_scroll');

      $scope.fondodetalle = !$scope.fondodetalle;
      $scope.verdetalle = !$scope.verdetalle;
   }

   $scope.showPilotos = function () {
      $scope.asignar_piloto = !$scope.asignar_piloto;
   }

   // Funciones
   $scope.baseUrl = new $window.URL($location.absUrl()).href;
   $scope.baseUrlsp = $scope.baseUrl.split('=');
   $scope.idPedido = $scope.baseUrlsp[1];

   //TODO borrar
   $scope.toggleClass = function (id) {
      var drowp = angular.element(document.getElementById(id));
      drowp.toggleClass('show_nya');
   }

   $scope.dataAsignar = {};

   $scope.getPedidos = function(){

      $scope.loader('Cargando pedidos . . .');

      $http.post('api/pedidos/getPedidos', $scope.filtro).success(function (response){

         $scope.loader();

         $scope.pedidos = response.pedidos.slice(0, 30);
         $scope.resumen = response.data;

         $scope.morePedidos = function () {
            $scope.pedidos = response.pedidos.slice(0, $scope.pedidos.length + 30);
         }

         if ($scope.idPedido != undefined) {

            $scope.pedidos.forEach(pedido => {
               if (pedido.id == $scope.idPedido) {
                  $scope.changeStatus(pedido);
                  $scope.idPedido = undefined;
               }
            });
         }

         $timeout(function () { tippy('.icon_status'); }, 5);

         $scope.graficaPedidos($scope.resumen.estados);
      });
   };

   $scope.graficaPedidos = function(estados){

      var data = []
      for (var i = 0; i < estados.length; i++) {

         var element ={};
         element.drilldown = estados[i].nombre;
         element.name = estados[i].nombre;
         element.y = estados[i].cantidad == undefined ? 0 : estados[i].cantidad;

         data.push(element);
      }

      Highcharts.chart('containerestado', {
         chart: {
            type: 'column',
            height: 120,
            borderRadius: 5,
         },
         title: {
            text: null
         },
         xAxis: {
            type: 'category',
         },
         yAxis:[{
            visible: false,
            allowDecimals: false,
            title:{
               text: null
            }
         }],

         tooltip: {
            enabled:false,
               formatter: function () {
               return Highcharts.numberFormat(this.y ,0, '.', ',');
            },
            styledMode: true,
            borderRadius: 15,
         },
         plotOptions: {
            line: {
               dataLabels: {
                  enabled: true,
               },
               enableMouseTracking: false
            },
            series: {
               borderWidth: 0,
               dataLabels: {
                  enabled: true,
               }
            },
            column: {
            borderRadius:2
            }
         },
         series: [{
            showInLegend: false,
            name: "Estados",
            colorByPoint: true,
            data: data
         }],
         exporting: {
            enabled: false
         }
      });
   }

   $scope.getPilotos = function () {
      $http.get('api/pedidos/getPilotos').success(function (response) {
         $scope.pilotos = response.datos;

         //agrega un item al array
         var element = {};
         var user = {name: "todos"}
         element.user = user;
         element.id = 0;
         $scope.pilotos.unshift(element);
         console.log( $scope.pilotos);

      });
   };

   $scope.getVendedores = function () {
      $http.get('api/vendedor/getVendedores').success(function (response) {
         $scope.vendedores = response.vendedores;

         //agrega un item al array
         var user = {name : 'Todos'};
         var element = {};
         element.user =  user;
         element.id =  0;
         $scope.vendedores.unshift(element);
      });
   };

   $scope.asignarPiloto = function(){

      if ($scope.dataAsignar.id_piloto==0) {
         $scope.modalResponse('Selecciona un piloto', 'error');
         return;
      }
      $scope.dataAsignar.id_pedido = $scope.existePedido.id;

      $http.post('api/pedidos/asignarPiloto', $scope.dataAsignar).success(function (response) {

         if(response.codigo == 200){
            $scope.closeStatus();
            $scope.bodega = true;
            $scope.pilotoAsing = true;
            $scope.getPedidos();
         }

      });
   }

   // LIBRARY FileSaver
   $scope.exportExcel = function () {
      var blob = new Blob([document.getElementById('exportable').innerHTML], {
          type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8"
      });
      saveAs(blob, "Reporte.xls");
   };

   $scope.Parametros();
   $scope.getPedidos();
   $scope.getPilotos();
   $scope.getVendedores();

});

