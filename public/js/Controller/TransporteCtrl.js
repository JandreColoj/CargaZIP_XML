posApp.controller('TransporteCtrl', function ($scope, $http, $timeout) {

   $scope.vehiculo = {};
   $scope.enviando = false;

   //Cierra modal, nuevo y editar
   $scope.cerrar = function () {
      $scope.nuevo_transporte = false;
      $scope.editar_transporte = false;
      $scope.enviando = false;
   }

   $scope.getTransporte = function(){
      $http.get('api/transporte/getTransportes').then(function(response){
         $scope.transporte = response.data.datos;

         $scope.transporte.forEach(element => {
            element.eliminar = 0;
         });

         $timeout(function () {
            tippy('.icotfaq');
         }, 5);
      });
   };

   $scope.getTransporte();

   $scope.modalNuevoTransporte = function (){
      $scope.nuevo_transporte = true;
   }

   $scope.guardarVehiculo = function(){

      if($scope.enviando){
         return 0;
      }
      $scope.enviando = true;

      $http.post('/api/transporte/nuevoTransporte', $scope.vehiculo).then(function () {
         $scope.getTransporte();
         $scope.vehiculo = {};
         $scope.nuevo_transporte = false;
         $scope.enviando = false;
      });
   };

   $scope.modalEditarTransporte = function(transporte){
      $scope.editar_transporte = true;
      $scope.vehiculoSelected = transporte;
      $scope.vehiculoSelected.anio = parseInt($scope.vehiculoSelected.anio)
   }

   $scope.editarVehiculo = function () {

      $scope.vehiculoSelected.nombre = $scope.vehiculoSelected.piloto.nombre;
      $scope.vehiculoSelected.telefono = $scope.vehiculoSelected.piloto.telefono;

      /* se envia  $scope.productoSelected*/
      $http.put('/api/transporte/editarTransporte', $scope.vehiculoSelected).then(function(){
         $scope.getTransporte();
         $scope.editar_transporte = false;
      })
   };

   $scope.eliminarTransporte = function(transporte){
      transporte.eliminar += 1;

      $scope.vehiculoSelected = transporte;

      if (transporte.eliminar == 2) {

         $http.put('api/transporte/deshabilitarTransporte', $scope.vehiculoSelected).then(function (response) {
            $scope.getTransporte()
         });

      }

   }

});
