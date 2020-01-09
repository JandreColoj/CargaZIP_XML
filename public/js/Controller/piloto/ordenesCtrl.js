posApp.controller('OrdenesCtrl', function ($scope, $http, $timeout) {

   $scope.ordersTab = true;
   $scope.btn_mes = true;
   $scope.cambio = {};

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

   $scope.Parametros = function(){
      $http.get('api/general/parametros').success(function(response){
         $scope.Estados = response.datos.estados;

         var element = {};
         element.nombre = 'Todos';
         element.codigo = 0;
         $scope.Estados.unshift(element);
      });
   }

   $scope.getPedidos = function(){

      $scope.loader('Cargando pedidos . . .');

      $http.post('api/pedidos/getPedidosPiloto', $scope.filtro).success(function (response){

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
      });
   };

   $scope.closeStatus = function(){
      $scope.nuevo_pedido   = false;
      $scope.bodega         = false;
      $scope.ruta_pedido    = false;
      $scope.estado_pedido  = false;
      $scope.entregado      = false;
      $scope.cancelado      = false;
   }

   $scope.changeStatus = function (pedido){

      var scrollbhidden = angular.element(document.querySelector('body'));
      scrollbhidden.addClass('hide_scroll');

      $scope.selectPedido = pedido;

      $scope.bitacora = {};
      $scope.bitacora.bodega     = $scope.selectPedido.bitacora.find(function(element) { return element.cambio_estado == 3; });
      $scope.bitacora.ruta       = $scope.selectPedido.bitacora.find(function(element) { return element.cambio_estado == 4; });
      $scope.bitacora.completado = $scope.selectPedido.bitacora.find(function(element) { return element.cambio_estado == 5; });

      $scope.slug = $scope.selectPedido.estado.nombre;
      $scope.cambio.fecha = new Date($scope.selectPedido.fecha_entrega);
      $scope.cambio.hora  = new Date($scope.selectPedido.fecha_entrega);
      $scope.fondodetalle = true;
      $scope.verdetalle   = true;

      switch ($scope.slug) {
         case 'Nuevo':
            $scope.closeStatus();
            $scope.nuevo_pedido = true;

            //cambia el estado 2 de visto
            $http.post('api/pedidos/pedidoVisto/' + pedido.id).then(function () {
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
            $scope.closeStatus();
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

   $scope.change = function(producto,check) {
      if(check.option.selected){
         producto.recibido = true;
      }else{
         producto.recibido = false;
      }
   };

   $scope.realizarPedido = function(){

      $scope.completo = true;

      $scope.selectPedido.productos_pedidos.forEach(element => {
         if (element.recibido == undefined || element.recibido == false) {
            $scope.completo = false;
         }
      });

      if (!$scope.completo) {
        console.log('Selecciona todo los productos.');

      } else {
         $http.post('api/pedidos/realizarPedido',{id: $scope.selectPedido.id, observacion: $scope.selectPedido.observacion}).success(function(response){

            if (response.codigo == 200) {
               $scope.getPedidos();
               $scope.selectPedido.estado.nombre = 'Ruta';
               $scope.changeStatus($scope.selectPedido);
            }
            // $scope.pedidos = response.data.result;
         });
      }

   }

   $scope.cambiarFecha = function(){

      $scope.cambio.id = $scope.selectPedido.id;

      $http.post('api/pedidos/cambiarFecha',$scope.cambio).success(function(response){

         if(response.codigo == 200) {
            $scope.modalResponse(response.mensaje, 'success');
         }else{
            $scope.modalResponse(response.mensaje, 'error');
         }
      });
   }

   $scope.devolverPedido = function(){

      if($scope.selectPedido.observacion==undefined){
         $scope.modalResponse("Agrega un motivo de la devolución", 'error');
         return ;
      }

      $http.post('api/pedidos/devolverPedido',$scope.selectPedido).success(function(response){

         if(response.codigo == 200) {
            $scope.closeStatus();
            $scope.getPedidos();
         }else{
            $scope.modalResponse(response.mensaje, 'error');
         }
      });

   }

   $scope.getPedidos();
   $scope.Parametros();
});

