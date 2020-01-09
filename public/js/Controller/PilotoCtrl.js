posApp.controller('PilotoCtrl', function ($scope, $http, $timeout,$element) {

   $scope.toggleClass = function (id) {
      var drowp = angular.element(document.getElementById(id));
      drowp.toggleClass('show_nya');
   }

   $scope.piloto = {};
   $scope.enviando = false;

   //Cierra modal, nuevo y editar
   $scope.cerrar = function () {
      $scope.nuevo_piloto = false;
      $scope.editar_piloto = false;
      $scope.enviando = false;
      $scope.passIncorrect = "";
   }

   $scope.getPilotos = function(){
      $http.get('api/transporte/getPilotos').then(function(response){
         $scope.pilotos = response.data.datos;

         $scope.pilotos.forEach(element => {
            element.eliminar = 0;
         });

         $timeout(function () {
            tippy('.icotfaq');
         }, 5);
      });
   };

   $scope.getPilotos();

   $scope.getTransporte = function(){

      $http.get('api/transporte/getTransportes').then(function(response){
         $scope.transporte = response.data.datos;
      });
   };
   $scope.getTransporte();

   $scope.modalNuevoPiloto = function (){
      $scope.nuevo_piloto = true;
   }

   $scope.guardarPiloto = function(){

      if ($scope.piloto.pass != $scope.piloto.pass2) {
         $scope.passIncorrect = "Las contraseñas ingresadas no son iguales. ";
         return 0;
      }

      if($scope.enviando){
         return 0;
      }
      $scope.enviando = true;

      $http.post('/api/transporte/nuevoPiloto', $scope.piloto).then(function (response) {

         if (response.data.codigo=='200') {
            $scope.piloto = {};
            $scope.cerrar();
            $scope.getPilotos();
            $scope.getTransporte();
         }else{
            $scope.enviando = false;
            $scope.errorNewPiloto = response.data.mensaje;
         }

      });
   };

   $scope.modalEditarPiloto = function(piloto){
      $scope.editar_piloto = true;
      $scope.pilotoSelected = piloto;
      $scope.pilotoSelected.nombre   = $scope.pilotoSelected.user.name;
      $scope.pilotoSelected.dpi      = $scope.pilotoSelected.user.dpi;
      $scope.pilotoSelected.telefono = $scope.pilotoSelected.user.telefono;
      $scope.pilotoSelected.pass     = 'false';
      $scope.pilotoSelected.pass2    = 'false';
   }

   $scope.editarPiloto = function () {

      if ($scope.pilotoSelected.pass != $scope.pilotoSelected.pass2) {
         $scope.passIncorrect = "Las contraseñas ingresadas no son iguales. ";
         return 0;
      }

      $http.put('/api/transporte/editarPiloto', $scope.pilotoSelected).then(function(response){

         if (response.data.codigo=='200') {
            $scope.getPilotos();
            $scope.getTransporte();
            $scope.cerrar();
         }else{
            $scope.errorEditPiloto = response.data.mensaje;
         }

      })
   };

   // $scope.eliminarTransporte = function(transporte){
   //    transporte.eliminar += 1;

   //    $scope.vehiculoSelected = transporte;

   //    if (transporte.eliminar == 2) {

   //       $http.put('api/transporte/deshabilitarTransporte', $scope.vehiculoSelected).then(function (response) {
   //          $scope.getTransporte()
   //       });

   //    }

   // }

});
