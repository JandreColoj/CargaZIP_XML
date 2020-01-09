posApp.controller('BodegasCtrl', function ($scope, $http,$timeout){

   $scope.bodega = {};

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

   $scope.Parametros = function (){
      $http.get('api/general/parametros').success(function(response){
          $scope.Departamentos = response.datos.departamentos;
      });
   }

   $scope.getBodegas = function (){

      $scope.loader('Cargando . . .');

      $http.get('api/ajustes/bodega/getBodegas').success(function(response){
         $scope.bodegas = response.bodegas;

         $scope.loader();

         $timeout(function(){
            $scope.bodegas.forEach(element => {
               $scope.mapaGoogle(element,'mapa');
            });
         },2000);

      });
   }

   $scope.detalleBodega = function (bodega){

      $scope.loader('Cargando . . .');

      $scope.modal_detalle_bodega = true;
      $scope.selectBodega = bodega;

      $timeout(function() {
         $scope.mapaGoogle(bodega,'mapaSelect');
         $scope.loader();
      },1000);
   }

   $scope.mapaGoogle = function(bodega,id) {

      var myLatlng = new google.maps.LatLng(bodega.latitud, bodega.longitud);

      var mapOptions = {
         center: myLatlng,
         zoom: 15,
         mapTypeId: google.maps.MapTypeId.ROADMAP};

      var map = new google.maps.Map(document.getElementById(id+bodega.id),mapOptions);

      var marker = new google.maps.Marker({
         position:myLatlng,
         map: map,
         draggable:false,
         title:"Arrastrame!"
      });
   }

   $scope.guardarBodega = function(){

      $scope.loader('Creando bodega . . .');

      $http.post('api/ajustes/bodega/nuevaBodega',$scope.bodega).success(function(response){

         $scope.loader();

         if(response.codigo = 200){
            $scope.bodega = {};
            $scope.getBodegas();
            $scope.modal_nueva_bodega = false;
         }else{
            $scope.modalResponse(response.mensaje, 'error');
         }
      });
   }

   $scope.showEditarBodega = function(){
      $scope.modal_editar_bodega = true;
      $scope.modal_detalle_bodega = false;

      $scope.Departamentos.forEach(element => {

         if($scope.selectBodega.municipio.codigo_depto == element.codigo){
            $scope.municipios = element.municipios;
         }
      });
   }

   $scope.editarBodega = function(){

      $scope.loader('Editando bodega . . .');

      $http.post('api/ajustes/bodega/editarBodega', $scope.selectBodega).success(function(response){

         $scope.loader();

         if(response.codigo = 200){
            $scope.getBodegas();
            $scope.modal_editar_bodega = false;
         }
      });
   }

   $scope.eliminarBodega = function(){

      $scope.modal_detalle_bodega = false;
      $scope.loader('Eliminando bodega . . .');

      $http.get('api/ajustes/bodega/eliminarBodega/'+$scope.selectBodega.id).success(function (response){

         $scope.loader();

         if(response.codigo==200){
            $scope.getBodegas();
         }else{
            $scope.modalResponse(response.mensaje,'error');
         }

      })
   }

   $scope.cerrar_bodega = function(){
      $scope.modal_detalle_bodega = false
   }

   $scope.Parametros();
   $scope.getBodegas();
});
