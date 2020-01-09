   var posApp = angular.module('myApp', [
      'infinite-scroll',
      'ngMask',
      'ngAnimate',
      'nya.bootstrap.select',
      'thatisuday.dropzone',
      'ngMessages',
      'angularMoment',
      'nya.bootstrap.select',
      'angular-js-xlsx',
      'LocalStorageModule',
      'angularFileUpload'
   ]);

   posApp.config(['localStorageServiceProvider', function(localStorageServiceProvider) {
      localStorageServiceProvider.setPrefix('ls');
    }]);

   posApp.directive('appFilereader', function ($q) {
      var slice = Array.prototype.slice;
      return {
         restrict: 'A',
         require: '?ngModel',
         link: function (scope, element, attrs, ngModel) {
            if (!ngModel) return;
   
            ngModel.$render = function () { };
   
            element.bind('change', function (e) {
               var element = e.target;
   
               $q.all(slice.call(element.files, 0).map(readFile))
                  .then(function (values) {
                     if (element.multiple) ngModel.$setViewValue(values);
                     else ngModel.$setViewValue(values.length ? values[0] : null);
                  });
   
               function readFile(file) {
                  var deferred = $q.defer();
   
                  var reader = new FileReader();
                  reader.onload = function (e) {
                     deferred.resolve(e.target.result);
                  };
                  reader.onerror = function (e) {
                     deferred.reject(e);
                  };
                  reader.readAsDataURL(file);
   
                  return deferred.promise;
               }
   
            }); //change
   
         } //link
      }; //return
   });


   posApp.directive('dropzone', function () {
      return function (scope, element, attrs) {
      var config, dropzone;

      config = scope[attrs.dropzone];

      // create a Dropzone for the element with the given options
      dropzone = new Dropzone(element[0], config.options);

      // bind the given event handlers
      angular.forEach(config.eventHandlers, function (handler, event) {
         dropzone.on(event, handler);
      });
      };
   });

   // posApp.config(function($locationProvider) {
   //    $locationProvider.html5Mode({
   //       enabled: true,
   //       requireBase: true
   //    });
   // });

   //Funcion que recibe como parametro un codigo de error y devuelve el motivo de error.
   posApp.factory('codigosError', function() {

      return {
         msj: function(code) {

            if (code==101) {
               $mensaje = "Faltan datos obligatorios que enviar";
            }else if(code==102){
               $mensaje = "Error al validar campos de la tarjeta";
            }else if(code==202){
               $mensaje = "Tarjeta expirada";
            }else if(code==204){
               $mensaje = "No hay fondos suficientes en la tarjeta";
            }else if(code==208){
               $mensaje = "Tarjeta inactiva o no autorizada";
            }else if(code==209){
               $mensaje = "CVV no concuerda";
            }else if(code==210){
               $mensaje = "La tarjeta ha alcanzado si límite de Crédito";
            }else if(code==211){
               $mensaje = "CVV Incorrecto";
            }else if(code==230){
               $mensaje = "Negado por no pasar el control CVV";
            }else if(code==231){
               $mensaje = "Número de tarjeta invalido";
            }else if(code==232){
               $mensaje = "El procesador de pago no acepta el tipo de tarjeta";
            }else if(code==234){
               $mensaje = "Error del sistema de antifraude";
            }else if(code==236){
               $mensaje = "Fallo del procesador, espere unos minutos";
            }else if(code==481){
               $mensaje = "Fallo en la transacción, consulte con su banco";
            }else if(code==01){
               $mensaje = "Refiérase al Emisor";
            }else if(code==02){
               $mensaje = "Refiérase al Emisor";
            }else if(code==02){
               $mensaje = "Refiérase al Emisor";
            }else if(code==05){
               $mensaje = "Transacción no aceptada";
            }else if(code==13){
               $mensaje = "FONDOS INSUFICIENTES";
            }else if(code==14){
               $mensaje = "TARJETA INVALIDA";
            }else if(code==15){
               $mensaje = "EMISOR INVALIDO (Merchant Invalid)";
            }else if(code==19){
               $mensaje = "Transacción no realizada, intente de nuevo";
            }else if(code==31){
               $mensaje = "Tarjeta no soportada por SWITCH";
            }else if(code==41){
               $mensaje = "Tarjeta Extraviada";
            }else if(code==43){
               $mensaje = "Tarjeta Robada";
            }else if(code==51){
               $mensaje = "No tiene fondos disponibles";
            }else if(code==54){
               $mensaje = "Fecha de expiración invalida";
            }else if(code==57){
               $mensaje = "TRANSACCIÓN NO PERMITIDA ";
            }else if(code==58){
               $mensaje = "TRANSACCION INVALIDA ";
            }else if(code==61){
               $mensaje = "MONTO EXCEDIDO ";
            }else if(code==62){
               $mensaje = "TARJETA RESTRINGIDA";
            }else if(code==65){
               $mensaje = "TRANSACCIONES EXCEDIDAS";
            }else if(code==78){
               $mensaje = "CUENTA INVALIDA ";
            }else if(code==85){
               $mensaje = "TRANSACCION INVALIDA ";
            }else if(code==89){
               $mensaje = "TERMINAL INVÁLIDA ";
            }else if(code==91){
               $mensaje = "Emisor NO Disponible - TIME OUT ";
            }else if(code==96){
               $mensaje = "Mal funcionamiento del sistema";
            }else if(code=='PS01'){
               $mensaje = "Token requerido";
            }else{
               $mensaje ="";
            }

            return $mensaje;
         }
      };
   });

   posApp.factory("DateFormat",function() {

      return {
         date: function(fecha) {
            var d = fecha;
            var date_d = d.getDate();
            var date_m = d.getMonth() + 1;
            var date_y = d.getFullYear();

            if (date_d <9) {date_d = '0'+date_d}
            if (date_m <9) {date_m = '0'+date_m}

            var date  = date_y +'-'+ date_m +'-'+ date_d;

            return date;
         },
         datecomplete: function(fecha) {
            var d = fecha;
            var date_d = d.getDate();
            var date_m = d.getMonth() + 1;
            var date_y = d.getFullYear();

            if (date_d <9) {date_d = '0'+date_d}
            if (date_m <9) {date_m = '0'+date_m}

            var date  = date_y +'-'+ date_m +'-'+ date_d +" 00:00";

            return date;
         }
      };



   });
