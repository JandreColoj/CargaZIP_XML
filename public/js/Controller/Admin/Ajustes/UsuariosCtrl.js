posApp.controller('UsuariosCtrl', function ($scope, $http) {

   $scope.usuario = {};

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

      $scope.passIncorrect = "";
   }

   $scope.ParametrosUsuario = function (){
      $http.get('api/general/parametrosUsuario').success(function(response){
         $scope.Roles = response.datos.roles;
         $scope.Bodegas = response.datos.bodegas;
      });
   }

   $scope.getUsuarios = function(){
      $http.get('/api/ajustes/usuario/getUsuarios').success(function(response){
         $scope.usuarios = response.usuarios;

         $scope.usuarios.forEach(element => {
            element.eliminar = 0;
         });

      });
   };

   $scope.guardarUsuario = function(){

      $scope.passIncorrect = "";

      if($scope.usuario.pass != $scope.usuario.pass2){
         $scope.passIncorrect = "Las contraseñas ingresadas no son iguales. ";
         return 0;
      }else if($scope.loadding)
         return 0;

      $scope.loader('Guardando usuario . . . ');

      $http.post('/api/ajustes/usuario/nuevoUsuario', $scope.usuario).success(function (response){

         $scope.loader();

         if(response.codigo=='200'){
            $scope.usuario = {};
            $scope.nuevo_usuario = false;
            $scope.getUsuarios();
         }else{
            $scope.modalResponse(response.mensaje, 'error');
         }

      });
   };

   $scope.modalEditarUsuario = function(usuario){
      $scope.editar_usuario = true;
      $scope.usuarioSelected = usuario;
      $scope.usuarioSelected.nombre   = $scope.usuarioSelected.user.name;
      $scope.usuarioSelected.dpi      = $scope.usuarioSelected.user.dpi;
      $scope.usuarioSelected.telefono = $scope.usuarioSelected.user.telefono;
      $scope.usuarioSelected.id_rol   = $scope.usuarioSelected.user.rol_usuario.role_id;

      $scope.usuarioSelected.pass = 'false';
      $scope.usuarioSelected.pass2 = 'false';
   }

   $scope.editarUsuario = function(){

      if($scope.usuarioSelected.pass != $scope.usuarioSelected.pass2) {
         $scope.passIncorrect = "Las contraseñas ingresadas no son iguales. ";
         return 0;
      }

      if($scope.loadding) return 0;

      $scope.loader('Editando usuario . . . ');

      $http.put('/api/ajustes/usuario/editarUsuario', $scope.usuarioSelected).success(function(response){

         $scope.loader();

         if (response.codigo=='200') {
            $scope.getUsuarios();
            $scope.editar_usuario = false;
         }else{
            $scope.modalResponse(response.mensaje, 'error');
         }

      })
   };

   $scope.getUsuarios();
   $scope.ParametrosUsuario();

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
