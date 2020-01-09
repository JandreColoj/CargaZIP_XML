posApp.factory('functionCtrl', function() {

   return {

      isInt: function(value) {
         var er = /^\d*$/;
         return er.test(value);
      },

      isFloat: function(value) {
         var er = /^[+-]?\d+(\.\d+)?$/;
         return er.test(value);
      },

      getPresentacionProducto: function(codigo, medidas) {
         let id = 0;
         let nombre = 'Codigo Invalido';
         medidas.forEach(element => {
            if (element.codigo==codigo) {
               nombre = element.nombre;
               id = element.id;
            }
         });

         return [nombre,id];
      },

      getNombreProducto: function(sku,productos) {
         let id = 0;
         let nombre = 'NO existe el producto';
         productos.forEach(element => {
            if (element.sku==sku) {
               nombre = element.nombre;
               id = element.id;
            }
         });
         return [nombre,id];
      },

      getNombreMarca : function (codigo, marcas){

         let id = 0;
         let nombre = 'SIN MARCA';
         marcas.forEach(element => {
            if (element.codigo==codigo) {
               nombre = element.nombre;
               id = element.id;
            }
         });

         return [nombre,id];
      },

      getNombreCategoria : function (codigo, categorias) {

         let id = 0;
         let nombre = 'SIN CATEGORIA';
         categorias.forEach(element => {
            if (element.codigo==codigo) {
               nombre =  element.nombre;
               id = element.id;
            }
         });

         return [nombre,id];
      },

      validDate : function (campo) {

         var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
         if ((campo.match(RegExPattern)) && (campo!='')) {
               return true;
         } else {
               return false;
         }

      }

   }

});
