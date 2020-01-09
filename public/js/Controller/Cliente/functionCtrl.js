posApp.factory('functionCtrl', function() {

   return {

       validarTipoClientes: function (codigo, TipoNegocios) {

         let nombre = 'Código incorrecto';
         TipoNegocios.forEach(element => {
            if (element.codigo==codigo) {
               nombre =  element.nombre;
            }
         });

         return nombre;
      },

      validarCanal : function(codigo, Canales) {

         let nombre = 'Código incorrecto';
         Canales.forEach(element => {
            if (element.codigo==codigo) {
               nombre =  element.nombre;
            }
         });

         return nombre;
      },

       validarMunicipio: function (codigo, Departamentos) {

         let nombre = 'Código incorrecto';
         Departamentos.forEach(element => {

            element.municipios.forEach(e => {
               if (e.codigo==codigo) {
                  nombre = e.nombre;
               }
            });

         });

         return nombre;
      },

       validarEmail : function(valor) {
         emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
         if (emailRegex.test(valor)) {
            return true;
         } else{
            return false;
         }
      },

      validarTelefono : function(valor) {
         var phoneno = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
         if(phoneno.test(valor)) {
            return true;
         }else{
            return false;
         }
      }

   }

});
