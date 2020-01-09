posApp.controller('OrdenesCtrl', function ($scope, $http, $timeout, $window, $location) {

   $scope.baseUrl = new $window.URL($location.absUrl()).href;
   $scope.baseUrlsp = $scope.baseUrl.split('=');
   $scope.idPedido = $scope.baseUrlsp[1];

   if ($scope.idPedido!=undefined) {

      $http.get('api/pedidos/detalle/'+$scope.idPedido).success(function(response){
         if (response.codigo==200)
            $scope.modalDetalle(response.result);
      });
   }

   $scope.toggleClass = function (id){
      var drowp = angular.element(document.getElementById(id));
      drowp.toggleClass('show_nya');
   }

   $scope.dataAsignar = {};
   $scope.ordersTab = true;
   $scope.btn_mes = true;

   $scope.hideModal = function () {
      $timeout(function () {
         $scope.showDataClient = false;
         $scope.modalAsignarP = false;
      }, 200);
   }

   $scope.getPedidos = function(tipo){
      $scope.filtroFecha = tipo; //Guarda el tipo de busqueda seleccionada

      $scope.btn_mes = tipo=='mes' ? true: false;
      $scope.btn_dia = tipo=='dia' ? true: false;
      $scope.btn_anio = tipo=='anio' ? true: false;

      $http.get('api/pedidos/getPedidos/'+tipo).then(function(response){
         $scope.pedidos = response.data.result;
      });
   };
   $scope.getPedidos('mes');

   $scope.getPilotos = function(){

      $http.get('api/pedidos/getPilotos').then(function(response){
         $scope.pilotos = response.data.datos;
      });
   };
   $scope.getPilotos();


   $scope.modalDetalle = function(pedido){
      $scope.showDataClient = true;
      $scope.selectPedido = pedido.productos_pedidos;

      //cambia el estado 2 de visto
      $http.post('api/pedidos/pedidoVisto/'+pedido.id).then(function(){
         $scope.getPedidos($scope.filtroFecha);
      });
   }

   $scope.modalAsignarPedido = function (pedido){
      $scope.selectPedido = pedido;
      $scope.modalAsignarP = true;
   }

   $scope.asignarPiloto = function(){

      $scope.dataAsignar.id_pedido = $scope.selectPedido.id;

      $http.post('api/pedidos/asignarPiloto',$scope.dataAsignar).then(function(response){

         if (response.data.codigo==200) {
            $scope.getPedidos('mes');
            $scope.hideModal();
         }

      });

   }

   $scope.switchTab = function (tab) {

      if (tab == 'ordenes') {
         $scope.mapTab = false;
         $scope.ordersTab = true;
      } else if (tab == 'mapa') {
         $scope.ordersTab = false;
         $scope.mapTab = true;
      } else {
         console.warn('no params');
      }
   }

});

