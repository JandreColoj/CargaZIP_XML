posApp.controller('vendedorCtrl', function ($scope, $http, $timeout,$element) {

   $scope.toggleClass = function (id) {
      var drowp = angular.element(document.getElementById(id));
      drowp.toggleClass('show_nya');
   }

   $scope.vendedor = {};

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

   $scope.cerrar = function () {
      $scope.mensaje = '';
      $scope.modalError = false;
      $scope.modalSuccess = false;

      $scope.passIncorrect = "";
   }

   $scope.getVendedor = function(){
      $http.get('api/vendedor/getVendedores').success(function(response){
         $scope.vendedores = response.vendedores;

         $scope.vendedores.forEach(element => {
            element.eliminar = 0;
         });

         $timeout(function () {
            tippy('.icotfaq');
         }, 5);
      });
   };

   $scope.modalNuevoVendedor = function (){
      $scope.vendedor = {};
      $scope.nuevo_vendedor = true;
   }

   $scope.guardarVendedor = function(){

      if($scope.vendedor.pass != $scope.vendedor.pass2) {
         $scope.passIncorrect = "Las contraseñas ingresadas no son iguales. ";
         return 0;
      }

      if($scope.loadding) return 0;

      $scope.loader('Guardando vendedor . . . ');

      $http.post('/api/vendedor/nuevo', $scope.vendedor).success(function (response){

         $scope.loader();

         if(response.codigo=='200'){
            $scope.nuevo_vendedor = false;
            $scope.getVendedor();
         }else{
            $scope.modalResponse(response.mensaje, 'error');
         }

      });
   };

   $scope.modalEditarVendedor = function(vendedor){
      $scope.editar_vendedor = true;
      $scope.vendedorSelected = vendedor;
      $scope.vendedorSelected.nombre   = $scope.vendedorSelected.user.name;
      $scope.vendedorSelected.dpi      = $scope.vendedorSelected.user.dpi;
      $scope.vendedorSelected.telefono = $scope.vendedorSelected.user.telefono;

      $scope.vendedorSelected.pass = 'false';
      $scope.vendedorSelected.pass2 = 'false';
   }

   $scope.editarVendedor = function(){

      if($scope.vendedorSelected.pass != $scope.vendedorSelected.pass2) {
         $scope.passIncorrect = "Las contraseñas ingresadas no son iguales. ";
         return 0;
      }

      if($scope.loadding) return 0;

      $scope.loader('Guardando vendedor . . . ');

      $http.put('/api/vendedor/editar', $scope.vendedorSelected).success(function(response){

         $scope.loader();

         if (response.codigo=='200') {
            $scope.getVendedor();
            $scope.editar_vendedor = false;
         }else{
            $scope.modalResponse(response.mensaje, 'error');
         }

      })
   };

   $scope.getVendedor();


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
