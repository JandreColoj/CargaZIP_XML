posApp.controller('cargaxmlCtrl', function ($scope, $http, $timeout,FileUploader) {

  $scope.contenido = {};

   $scope.showContent = function(){
      // console.log($scope.contenido.zip);
   }

   $scope.toggleClass = function (id) {
      var drowp = angular.element(document.getElementById(id));
      drowp.toggleClass('show_nya');
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

   $scope.cerrar = function () {
      $scope.mensaje = '';
      $scope.modalError = false;
      $scope.modalSuccess = false;

      $scope.passIncorrect = "";
   }

   // $scope.getVendedor = function(){
   //    $http.get('api/vendedor/getVendedores').success(function(response){
   //       $scope.vendedores = response.vendedores;

   //       $scope.vendedores.forEach(element => {
   //          element.eliminar = 0;
   //       });

   //       $timeout(function () {
   //          tippy('.icotfaq');
   //       }, 5);
   //    });
   // };

   $scope.modalNuevoVendedor = function (){
      $scope.vendedor = {};
      $scope.nuevo_vendedor = true;
   }

   $scope.subirArchivo = function(){

      $scope.loader('Guardando archivo . . . ');

      $http.post('api/subirArchivo', $scope.contenido).success(function (response){

         $scope.loader();

         if(response.codigo=='200'){
         //    $scope.nuevo_vendedor = false;
         //    $scope.getVendedor();
         }else{
            // $scope.modalResponse(response.mensaje, 'error');
         }

      });
   };

   // $scope.getVendedor();

});
