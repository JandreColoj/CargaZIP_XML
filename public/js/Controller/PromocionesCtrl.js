posApp.controller('PromocionesCtrl', function ($scope, $http,$timeout) {

   $scope.promocion = {};

   $scope.getPromociones = function(){
      $http.get('api/promociones/getPromociones').then(function(response){
         $scope.promociones = response.data.datos;

         $timeout(function () {
            tippy('.icon_typpy');
         }, 5);
      });
   };

   $scope.pedidosPromocion = function (id) {

      $http.get('api/promociones/getPedidos/' + id).success(function (response){

         if (response.codigo==200) {
            $scope.pedidos = response.pedidos;
            $scope.ver_promo = false;
            $scope.ver_pedidos_promo = true;
         }
      });
   };

   $scope.infoEmpresa = function(){
      $http.get('/api/infoEmpresa').success(function(response){
         $scope.informacion = response.datos;
         //informacion de bancos
         $scope.informacion.monedaPrincipal;
      });
   }

   $scope.verPromo = function (promo){
      $scope.promoSelect = promo;
      $scope.ver_promo = true;
   }

   $scope.modalEditar = function (promo){
      $scope.ver_promo = false;
      $scope.editar_promo = true;
      $scope.promocion.error_banner = '';

      $scope.promocion.inicio        = new Date(promo.fecha_inicio);
      $scope.promocion.fin           = new Date(promo.fecha_fin);
      $scope.promocion.precio        = promo.promocion_gtq;
      $scope.promocion.descripcion   = promo.descripcion;
      $scope.promocion.id            = promo.id;
      $scope.promocion.titulo        = promo.titulo;
      $scope.promocion.presentacion  = promo.producto.presentacion;
      $scope.promocion.codigo_medida = promo.codigo_medida;
      $scope.promocion.id_producto   = promo.producto.id;

      //imagenes
      $scope.promocion.img1 = promo.imagen_1;

      $scope.dropzoneConfig_img1 = {
         'options': {
            'url': '/api/productos/subirImagen',
            'paramName': 'file',
            'uploadMultiple': false,
            'maxFiles': 1,
            'maxFilesize': '10',
            'acceptedFiles': '.jpg, .jpeg, .png',
            'addRemoveLinks': true
         },
         'eventHandlers': {
            'sending': function (file, xhr, formData) {
               formData.append('_token', csrfToken);
               formData.append('id_producto', $scope.promocion.id_producto);
               formData.append('tipo', 'promocion');
            },
            'success': function (file, response) {
               $scope.promocion.img1 = response.ruta;
               $timeout(function() {$scope.promocion.error_banner = response.error != undefined ? response.error : '';},5);
            }
         }
      };

   }

   $scope.editarPromocion = function(){

      if($scope.promocion.error_banner!='') {
         $scope.promocion.error_banner = 'Agrega un banner con las dimeciones correctas.';
         return;
      }

      console.log($scope.promocion);

      $http.put('api/promociones/editarPromocion',$scope.promocion).then(function(){
         $scope.editar_promo = false;
         $scope.getPromociones();
      });
   }

   $scope.eliminarPromo = function (id){

      $http.put('api/promociones/eliminarPromocion/'+id).then(function(response){
         $scope.getPromociones();
      });

   }

   $scope.cerrar = function(){
      $scope.editar_promo = false;
      $scope.ver_promo = false;
      $scope.ver_pedidos_promo = false;
   }

   $scope.getPromociones();
   $scope.infoEmpresa();

});
