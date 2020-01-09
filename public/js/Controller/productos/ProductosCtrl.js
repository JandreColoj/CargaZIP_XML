posApp.controller('ProductosCtrl', function ($scope, $http, $timeout,functionCtrl) {

   $scope.existeV           = {}
   $scope.producto          = {};
   $scope.categoria         = {};
   $scope.marca             = {};
   $scope.categoriaRel      = {};
   $scope.promocion         = {};
   $scope.varianteProductos = {};
   $scope.marca_selected = 'all';
   $scope.cat_selected   = 'all';
   $scope.enviando       = false;

   $scope.tabs_categorias = [];

   var scrollbhidden = angular.element(document.querySelector('body'));

   $scope.loader = function (mensaje = false){
      if (mensaje!=false){
         $scope.loadding = true;
         $scope.mensaje = mensaje;
      }else{
         $scope.loadding = false;
      }
   }

   $scope.modalResponse = function(mensaje, tipo){

      if(tipo == 'error') {
         $scope.modalError = true;
      }else if(tipo == 'success'){
         $scope.modalSuccess = true;
      }
      $scope.mensaje = mensaje;
   }

   $scope.getProductos = function(){
      $http.get('api/productos/getProductos').then(function(productos){
         $scope.productos = productos.data.datos;
         $scope.productos.forEach(element => {
            element.selected = false;
         });
      });
   };

   $scope.getAllProductos = function(){
      $http.get('api/productos/getAllProductos').success(function(productos){
         $scope.Allproductos = productos.datos;
      });
   };

   $scope.getCategorias = function(){
      $http.get('/api/productos/getCategorias').then(function(categorias){
         $scope.categorias = categorias.data.datos;
      });
   }

   $scope.getSubCategorias = function(id_padre){
      $http.post('/api/productos/getSubCategorias', {'id' : id_padre}).success(function(response){
         $scope.subCategorias = response.datos;
      })
   }

   $scope.todasCategorias = function(){
      $http.get('/api/productos/todasCategorias').success(function(response){
         $scope.menus = response.datos;
      })
   }

   $scope.todasSubCategorias = function(){
      $http.get('/api/productos/todasSubCategorias').success(function(response){
         $scope.allCategory = response.datos;
      })
   }

   $scope.getMarcas = function(){
      $http.get('/api/productos/getMarcas').success(function(categorias){
         $scope.marcas = categorias.datos;
      });
   }

   $scope.getMedidas = function(){
      $http.get('/api/productos/getMedidas').success(function(response){
         $scope.medidas = response.datos;
      });
   }

   $scope.infoEmpresa = function(){
      $http.get('/api/infoEmpresa').success(function(response){
         $scope.informacion = response.datos;

         //informacion de bancos
         $scope.informacion.monedaPrincipal;
      });
   }

   $scope.productoFiltro = function(id_categoria,id_marca){

      $scope.filtro = {
         id_categoria : id_categoria,
         id_marca : id_marca
      };

      $scope.cat_selected = id_categoria;
      $scope.marca_selected = id_marca;

      $http.post('api/productos/productoFiltro',$scope.filtro).success(function(productos){

         $scope.productos = productos.datos;

         $scope.productos.forEach(element => {
            element.selected = false;
         });

         if ($scope.productos.length<1) {
            $scope.modalResponse('No hay productos para esta categoría!', 'error');
         }

      });
   }

   $scope.getAllProductos();
   $scope.getCategorias();
   $scope.getProductos();
   $scope.infoEmpresa();
   $scope.getMedidas();
   $scope.getMarcas();

   $scope.showOpciones = function (producto) {

      if (producto.selected) {
         producto.selected = !producto.selected;
      }else{
         $scope.productos.forEach(element => {
            element.selected = false;
         });
         producto.selected = !producto.selected;
      }
   }

   /* en la vista del producto se activa cuando el texto es muy largo */
   $scope.verDescripcion = function (boolean) {
      $scope.verMas = boolean;
      $scope.verMenos = !boolean;
   }

   $scope.showDetalle = function (producto) {

      $scope.productoSelected = producto;
      $scope.verDescripcion(false);
      $scope.fondoDetalle(true);

      /* productos relacionados */
      $scope.categoriaRel.id = producto.id_categoria;
      $scope.categoriaRel.nomProducto = producto.nombre;

      //carrusel
      $timeout(function() {
         var elem = document.querySelector('.main-carousel');
         var flkty = new Flickity( elem, {freeScroll: true, pageDots: true, prevNextButtons: false});
      }, 5);
   }

   /* Ver detalle producto relacionado */
   $scope.detalleprodRel = function(producto){
      $scope.fondoDetalle(false);

      $timeout(function() {
         $scope.showDetalle(producto)
      }, 100);
   }

   $scope.fondoDetalle = function (boolean) {
      $scope.fondodetalle = boolean;
      $scope.verdetalle = boolean;
      boolean ? scrollbhidden.addClass('modal-open') : scrollbhidden.removeClass('modal-open');
   }

   $scope.cerrar = function(){
      $scope.editar_obj         = false;
      $scope.showFormulario     = false;
      $scope.showFrmModVariante = false;

      $scope.nuevo_obj          = false;
      $scope.formularioProducto = false;

      $scope.formulario_inventario = false;

      $scope.variaProducto      = false;
      $scope.disablProducto     = false;
      $scope.modalMarcas        = false;
      $scope.modalEliminarMarca = false;
      $scope.modalCategorias    = false;
      $scope.modalSubcategorias = false;

      $scope.modalSuccess       = false;
      $scope.modalError         = false;
      $scope.loadding           = false;
   }

   $scope.showVariaciones = function (producto) {
      $scope.productoSelected = producto;
      $scope.variaProducto = true;
      $scope.btn_show_panel();
   }

   $scope.showStock = function (producto){
      $scope.productoSelected = producto;
      $scope.modal_detalle_stock = true;
   }

   /* Nueva variacion */
   $scope.btn_show_formulario = function(){
      $scope.showFormulario     = true;
      $scope.showPanel          = false;
      $scope.showFrmModVariante = false;
   }

   /*Muestra el listado de variantes */
   $scope.btn_show_panel= function(){
      $scope.showFormulario     = false;
      $scope.showPanel          = true;
      $scope.showFrmModVariante = false;
      $scope.varianteProductos  = {};
   }

   $scope.editarProd = function (producto){
      $scope.productoSelected = producto;

      //set Values
      $scope.productoSelected.presentacion.forEach(element => {

         if (element.codigo_medida=="M001"){
            $scope.productoSelected.cantidad_caja = element.cantidad_x_caja;
            $scope.productoSelected.cantidad_caja = element.cantidad_x_caja;
            $scope.productoSelected.precio_caja = element.precio;
         }else{
            $scope.productoSelected.precio_unitario = element.precio;
         }

      });

      $scope.editar_obj = true;
   }

   /*Guardar nueva variacion*/
   $scope.guardarVarianteProducto = function(){

      /* se agregan datos a varianteProducto*/
      $scope.varianteProductos.id_producto = $scope.productoSelected.id;
      $scope.varianteProductos.categoria   = $scope.producto.categoria;
      $scope.varianteProductos.descripcion = $scope.varianteProductos.descripcion;

      $http.post('/api/productos/nuevoProducto/',$scope.varianteProductos).success(function(){
         $scope.btn_show_panel();
         $scope.getProductos();

         $timeout(function() {
            $scope.productos.forEach(element => {
               if (element.id==$scope.productoSelected.id) {
                  $scope.showVariaciones(element);
               }
            });
         }, 200);

      });

   };

   /* Editar variacion */
   $scope.editarVariante = function(producto){
      $scope.existeV = producto;
      $scope.existeV.precio_unitario = producto.presentacion[0].precio;

      $scope.showFormulario     = false;
      $scope.showPanel          = false;
      $scope.showBtnFormulario  = false;
      $scope.showBtnPanel       = true;
      $scope.showFrmModVariante = true;
   }

   /* Guardar edicion de variacion */
   $scope.edVariante = function () {

      $http.put('/api/productos/editarProducto', $scope.existeV).then(function (){
         $scope.getProductos();
         $scope.varianteProductos = {};

         $timeout(function() {
            $scope.productos.forEach(element => {
               if (element.id==$scope.productoSelected.id) {
                  $scope.showVariaciones(element);
               }
            });
         }, 200);

         $scope.btn_show_panel();
      })

   }

   /* eliminar variacion */
   $scope.btnElimVpro = function (producto)  {
      $scope.existeV = producto;
      $scope.elimVProducto = true;
   }

   $scope.cerrarElimVar = function(){
      $scope.elimVProducto=false;
   }

   /* Confirmar eliminacion de variante */
   $scope.eliminarVariante = function (id)  {

      $http.put('/api/productos/deshabilitar/'+id).then(function (){
         $scope.btn_show_panel();
         $scope.getProductos();

         $timeout(function() {
            $scope.productos.forEach(element => {
               if (element.id==$scope.productoSelected.id) {
                  $scope.showVariaciones(element);
               }
            });
         }, 200);

         $scope.elimVProducto = false;
      });

   }

   /* Desabilitar producto */
   $scope.disabledProducto = function (producto) {
      $scope.productoSelected = producto;
      $scope.disablProducto = true;
   }

   /* Deshabilitar producto */
   $scope.deshabilitar = function (id) {

      $http.put('/api/productos/deshabilitar/'+id).then(function (){
         $scope.getProductos();
         $scope.disablProducto = false;
      });

   };

   $scope.cerrareVaiaciones = function (){
      $scope.variaProducto = false;
   }

   $scope.desavilitarProd = function (producto){
      $scope.productoSelected = producto;
      $scope.disablProducto = true;
   }

   $scope.habilitarProd = function(id){

      $http.put('/api/productos/habilitar/'+id).then(function (productos){
         $scope.productos = productos.data.datos;

         $scope.productos.forEach(element => {
            element.selected = false;
         });
      });

   }

   /* imagen de producto y variacion */
   $scope.subirImagen = function (producto, variacion = false){

      $scope.variacion = variacion;
      $scope.productoSelected = producto;
      $scope.areasubir = true;

      if ($scope.variacion) {

         $timeout(function() {
            $scope.productos.forEach(element => {
               if (element.id==$scope.productoSelected.id_producto) {
                  $scope.id_producto_variacion = $scope.productoSelected.id; //Guarda el id del producto, sirve para guardar la imagen
                  $scope.showVariaciones(element);
               }
            });
         }, 300);

      }

      $scope.dropzoneConfig1 = {
         'options': { // passed into the Dropzone constructor
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
               formData.append('id_producto', $scope.productoSelected.id);
            },
            'success': function (file, response) {
               $scope.miruta = response.ruta;
               $scope.areasubir     = false;
            }
         }
      };

      $scope.carga_obj = true;
   }

   /* Aceptar archivo */
   $scope.guardarImagen = function(){

      $scope.id = $scope.variacion ? $scope.id_producto_variacion : $scope.productoSelected.id;

      var data = { id_producto : $scope.id, ruta : $scope.miruta};

      $http.post('/api/productos/guardarImagen', data).then(function (){
         $scope.carga_obj = false;
         $scope.getProductos();

         if ($scope.variacion) {

            $timeout(function() {
               $scope.productos.forEach(element => {
                  if (element.id==$scope.productoSelected.id_producto) {
                     $scope.showVariaciones(element);
                  }
               });
            }, 300);
         }

         $scope.btn_show_panel();
      });

   }

   $scope.cerrarImagen = function (){
      $scope.carga_obj = false;
   }

   /** Sección de Promociones **/
   $scope.dropzoneConfig_img1 = {
      'options': { // passed into the Dropzone constructor
         'url': '/api/productos/subirImagen',
         'paramName': 'file',
         'uploadMultiple': false,
         'maxFiles': 1,
         'maxFilesize': '1',
         'acceptedFiles': '.jpg, .jpeg, .png',
         'addRemoveLinks': true
      },
      'eventHandlers': {
         'sending': function (file, xhr, formData) {
            formData.append('_token', csrfToken);
            formData.append('id_producto', $scope.productoSelected.id);
            formData.append('tipo', 'promocion');
         },
         'success': function (file, response) {
            $scope.promocion.img1 = response.ruta;
            $timeout(function() {$scope.promocion.error_banner = response.error != undefined ? response.error : '';},5);
         }
      }
   };

   $scope.guardarPromocion = function (){

      $scope.promocion.producto = $scope.productoSelected;

      if($scope.promocion.error_banner!='') {
         $scope.promocion.error_banner = 'Agrega un banner con las dimeciones correctas.';
         return;
      }

      $http.post('/api/productos/nuevaPromocion', $scope.promocion).success(function (response) {

         $scope.modalResponse(response.mensaje, 'success');
         $scope.promocion = {};
         $scope.activePromos = false;

      }).catch(function(response){
         $scope.activePromos = false;
         $scope.modalResponse(response.mensaje, 'error');
      })
   }

   $scope.showPromos = function (producto = false){
      $scope.promocion.error_banner = '';
      $scope.productoSelected = producto;
      $scope.activePromos = !$scope.activePromos;
      console.log($scope.productoSelected);

   }

   $scope.showNuevoProd = function(){
      $scope.todasCategorias();
      $scope.producto.medida = $scope.medidas[0];//asigna un tipo de
      $scope.nuevo_obj = true;
      $scope.arrayCategorias = [];
      $scope.formularioProducto = false;
      $scope.categoriaSeleccionada = false;
   }

   /************* PRODUCTO *************/

      $scope.arrayCategorias = [];
      $scope.categoriaSeleccionada = false;
      $scope.selectCategoria = function(categoria){

         $scope.categoriaSeleccionada = categoria;

         if ($scope.arrayCategorias.includes(categoria.id)) {

            var index = $scope.arrayCategorias.indexOf(categoria.id);
                        $scope.arrayCategorias.splice(index, 1);
         }else{

            $scope.arrayCategorias.push(categoria.id);
         }
      }

      $scope.showFormProducto = function (){

         if(!$scope.categoriaSeleccionada){
            return 0;
         }
         $scope.formularioProducto = true;
      }

   /************* PRODUCTO *************/

   $scope.guardarProductoNew = function(){

      if($scope.loadding){ return 0; }

      $scope.loader('Creando Producto . . .');

      $scope.producto.id_categoria = $scope.categoriaSeleccionada.id;
      $scope.producto.moneda = $scope.informacion.monedaPrincipal;

      $http.post('/api/productos/nuevoProducto', $scope.producto).success(function(response){

         $scope.loader();

         if(response.codigo==200) {
            $scope.producto  = {};
            $scope.nuevo_obj = false;
            $scope.getProductos();
            $scope.getAllProductos();
            $scope.getMedidas();
         }else{
            $scope.nuevo_obj = false;
            $scope.modalResponse(response.mensaje, 'error');
         }

      });
   };

   $scope.editarProducto = function () {

      if($scope.loadding){ return 0; }

      $scope.loader('Creando Producto . . .');

      /* se envia  $scope.productoSelected*/
      $http.put('/api/productos/editarProducto', $scope.productoSelected).success(function(response){

         $scope.loader();

         if(response.codigo==200) {
            $scope.productoFiltro($scope.cat_selected,$scope.marca_selected);
            $scope.editar_obj = false;
         }else{
            $scope.editar_obj = false;
            $scope.modalResponse(response.mensaje, 'error');
         }

      })
   };

   $scope.showSubCategorias = function(categoriaPadre){

      if (categoriaPadre.general==1) {
         $scope.tabs_categorias = [];
      }

      $scope.tabs_categorias.push(categoriaPadre);

      $scope.categoriaPadre = categoriaPadre;

      $scope.getSubCategorias($scope.categoriaPadre.id);

      $scope.modalSubcategorias = true;
      $scope.modalCategorias = false;
   }

   $scope.ReturnSubCategorias = function(categoria,index) {

      $scope.categoriaPadre = categoria;

      $http.post('/api/productos/getSubCategorias', {'id' : categoria.id}).success(function(response){
         $scope.subCategorias = response.datos;
         $scope.tabs_categorias.splice(index+1);
      })


   }


   $scope.addCategoria = function(){
      $scope.marca_nuevo = false;
      $scope.cat_nuevo = !$scope.cat_nuevo;
   }

   $scope.guardarCategoria = function(){

      if($scope.categoria.nombre==undefined) { return 0; }

      $scope.categoria.padre = $scope.categoriaPadre.id;

      $http.post('api/productos/nuevaCategoria', $scope.categoria).then(function (response) {
         $scope.getSubCategorias($scope.categoriaPadre.id);
         $scope.cat_nuevo = false;
         $scope.categoria.nombre = '';

         $timeout(function(){
            $scope.producto.id_categoria = response.data.id;
         },200);

      });
   };

   $scope.editarCategoria = function(marca){
      var texto  = angular.element(document.getElementById('td_'+marca.nombre));
      //add item
      marca.editado = texto[0]['textContent'];

      $http.put('api/productos/editarCategoria', marca).then(function (response) {
         $scope.getCategorias()
         texto.addClass('color_success');
      });
   }

   $scope.eliminarCategoria = function(categoria = false){
      $scope.errorCategoria = '';
      $scope.categoriaSelect = categoria;

      if(categoria == false) {
         $scope.modalEliminarCategoria = false;
      }else{
         $scope.modalEliminarCategoria = true;
      }
   }

   $scope.errorCategoria = '';
   $scope.aceptarEliminarCategoria = function(){

      $http.post('api/productos/eliminarCategoria', $scope.categoriaSelect).success(function (response) {

         if (response.codigo==200) {
            $scope.getSubCategorias($scope.categoriaPadre.id);
            $scope.productoFiltro($scope.cat_selected,$scope.marca_selected);
            $scope.modalEliminarCategoria = false;
         }else{
            $scope.errorCategoria = response.mensaje;
         }

      });
   }

   $scope.addMarca = function(){
      $scope.cat_nuevo = false;
      $scope.marca_nuevo = !$scope.marca_nuevo;
   }

   $scope.guardarMarca = function(){

      if ($scope.marca.nombre==undefined) { return 0; }

      $http.post('api/productos/nuevaMarca', $scope.marca).then(function (response) {
         $scope.getMarcas();
         $scope.marca_nuevo = false;
         $scope.marca.nombre = '';

         $timeout(function() {
            $scope.producto.id_marca = response.data.id;
         }, 200);
      });
   };

   $scope.editarMarca = function(marca){
      var texto  = angular.element(document.getElementById('td_'+marca.nombre));
      //add item
      marca.editado = texto[0]['textContent'];

      $http.put('api/productos/editarMarca', marca).then(function (response) {
         $scope.getMarcas();
         texto.addClass('color_success');
      });
   }

   $scope.eliminarMarca = function(marca){
      $scope.marcaSelect = marca;
      $scope.modalEliminarMarca = !$scope.modalEliminarMarca;
   }

   $scope.aceptarEliminarMarca = function(){

      $http.post('api/productos/eliminarMarca', $scope.marcaSelect).then(function (response) {

         if (response.data.codigo==200) {
            $scope.getMarcas();
            $scope.productoFiltro($scope.cat_selected,$scope.marca_selected);
            $scope.modalEliminarMarca = false;
         }else{
            $scope.modalEliminarMarca = false;
         }

      });
   }

   $scope.productos_activos = true;
   $scope.filtroActivos = function(){

      $scope.productos_activos = !$scope.productos_activos;

      $scope.msjActivos =  $scope.productos_activos ? 'Productos desactivados' : 'Productos Activados';

      $http.get('/api/productos/activos/'+$scope.productos_activos).then(function(productos){

         $scope.productos = productos.data.datos;

         $scope.productos.forEach(element => {
            element.selected = false;
         });

      });
   }

   $scope.verDescripcion(false);

   /******************************************** CARGA DE ARCHIVO DE EXCEL ********************************************/
      $scope.dataExcelValid = true;
      $scope.read = function (workbook){

         $scope.valido = $scope.validarArchivo();

         if(!$scope.valido){

            $timeout(function(){
               $scope.datosExcel = [];
               $scope.showError = true;
            },1000);

            return 0;
         }

         $scope.headerNames = XLSX.utils.sheet_to_json( workbook.Sheets[workbook.SheetNames[0]], { header: 1 })[0];
         $scope.data = XLSX.utils.sheet_to_json( workbook.Sheets[workbook.SheetNames[0]]);

         if($scope.formulario_carga) {
            $scope.cargaExcelProductos();
         }else if($scope.formulario_carga_inv){
            $scope.cargaExcelInventario();
         }
      }

      $scope.cerrarCarga = function(){
         $scope.dataExcelValid = true;
         $scope.formulario_carga  = false;
         $scope.formulario_carga_inv  = false;
         $scope.nombreArchivo = '';
         $scope.datosExcel = [];
         $scope.resultadoProductos = [];
      }
   /******************************************** CARGA DE ARCHIVO DE EXCEL ********************************************/

   /******************************** CARGA DE PRODUCTOS ********************************/
      $scope.showCargaProd = function(){
         $scope.formulario_carga = true;
         $scope.todasSubCategorias();
      }

      $scope.cargaExcelProductos = function () {

         //validacion de encabezados del excel
         var titulos = new Array('sku','categoria','marca','nombre','descripcion');
         var existe = true;

         for(var i = 0; i < $scope.headerNames.length; i++) {
            if (!titulos.includes($scope.headerNames[i])) {
               existe = false;
               break;
            }
         }

         if(!existe){

            $timeout(function(){
               $scope.showError = true;
               $scope.datosExcel = [];
               $scope.mierror = "El archivo no tiene las columnas correctas, descargue la plantilla.";
            },1000);

            return 0;
         }

         $timeout(function(){
            $scope.resultadoProductos = [];
            $scope.loader('Cargando datos . . . ');
            $scope.formulario_carga = false;
         },50);

         for (let index = 1; index < $scope.data.length; index++) {

            Object.keys($scope.data[index]).forEach(function(key) {

               if(key=='categoria') {
                  let result = functionCtrl.getNombreCategoria($scope.data[index][key], $scope.allCategory);
                  $scope.data[index]['nombreCategoria'] = result[0];
                  $scope.data[index]['id_categoria'] = result[1];
               }

               if(key=='marca'){
                  let result = functionCtrl.getNombreMarca($scope.data[index][key], $scope.marcas);
                  $scope.data[index]['nombreMarca'] = result[0];
                  $scope.data[index]['id_marca'] = result[1];
               }
               // console.log("Key = >" + key); console.log("Value => " + $scope.data[index][key]);
            });
         }

         if($scope.data[0].sku=='Codigo Unico del producto'){
            $scope.data.shift();
         }

         $timeout(function(){
            $scope.loader();
            $scope.datosExcel = $scope.data;
            $scope.formulario_carga = true;
            $scope.dataExcelValid;
         },100);
      }

      $scope.validarArchivo = function(){

         $scope.nombreArchivo = document.getElementById("excel").value;
         var extensiones_permitidas = new Array(".xls", ".xlsx");

         $scope.mierror = "";
         $scope.showError = false;
         extension = ($scope.nombreArchivo.substring($scope.nombreArchivo.lastIndexOf("."))).toLowerCase();

         permitida = false;

         for (var i = 0; i < extensiones_permitidas.length; i++) {
            if (extensiones_permitidas[i] == extension) {
               permitida = true;
               break;
            }
         }

         if(!permitida){
            $scope.mierror = "Sólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
            return false;
         }else{
            return true;
         }

      }

      $scope.cargaProductos = function () {

         if($scope.loadding){ return 0; }

         $scope.loader('Creando cliente . . .');

         $http.post('api/productos/cargaMasiva', $scope.datosExcel).success(function(response){

            $scope.loader();

            if(response.codigo==200){

               $scope.datosExcel = [];
               $scope.resultadoProductos = response.resultado;
               $scope.getProductos();
            }else{
               $scope.modalResponse(response.mensaje, 'error');
            }
         });

      }

   /******************************** CARGA DE PRODUCTOS ********************************/

   /******************************** INVENTARIOS ********************************/
      $scope.getMovimientos = function(){

         $http.post('api/productos/movimientos', $scope.prodInventario).success(function(response){

            if(response.codigo==200){
               $scope.movimientoProducto = response.resultado;
            }
         });

      }

      $scope.disponible = 0;
      movimientoProducto = [];
      $scope.prodInventario = {};
      $scope.prodInventario.fecha = new Date();

      $scope.selectProductoI = function (){

         $scope.prodInventario.producto.presentacion.forEach(element => {

            if(element.codigo_medida=='M001'){
               $scope.prodInventario.producto.precio_caja = element.precio;
            }else{
               $scope.prodInventario.producto.precio_unitario = element.precio;
            }

         });

         $scope.getMovimientos();
      }

      $scope.guardarEntradaProducto = function(){

         if($scope.loadding){ return 0; }

         $scope.loader('Creando registro . . .');

         $http.post('api/productos/entradaInventario', $scope.prodInventario).success(function(response){

            $scope.loader();

            if(response.codigo==200){
               $scope.prodInventario.producto.cantidad = 0;
               $scope.prodInventario.producto.costo = 0;
                $scope.getMovimientos();

            }else{
               $scope.modalResponse(response.mensaje, 'error');
            }
         });
      }

      $scope.cargaExcelInventario = function () {

         $scope.dataExcelValid = true;

         //validacion de encabezados del excel
         var titulos = new Array('sku','fecha','presentacion','cantidad','costo','unidades por caja','precio de venta', 'descuento','pronto pago');
         var existe = true;

         for(var i = 0; i < $scope.headerNames.length; i++) {
            if (!titulos.includes($scope.headerNames[i])) {
               existe = false;
               break;
            }
         }

         if(!existe){

            $timeout(function(){
               $scope.showError = true;
               $scope.datosExcel = [];
               $scope.mierror = "El archivo no tiene las columnas correctas, descargue la plantilla.";
            },1000);

            return 0;
         }

         $timeout(function(){
            $scope.loader('Cargando datos . . . ');
            $scope.resultadoProductos = [];
            $scope.formulario_carga_inv = false;
         },50);

         for (let index = 1; index < $scope.data.length; index++) {

            Object.keys($scope.data[index]).forEach(function(key) {

               let result;

               if(key=='sku') {
                  result = functionCtrl.getNombreProducto($scope.data[index][key], $scope.Allproductos);
                  $scope.data[index]['nombreProducto'] = result[0];
                  $scope.data[index]['id_producto'] = result[1];

                  if(result[1]==0) {
                     $scope.dataExcelValid = false;
                  }
               }

               if(key=='presentacion'){
                  result = functionCtrl.getPresentacionProducto($scope.data[index][key], $scope.medidas);
                  $scope.data[index]['nombreMedida'] = result[0];
                  $scope.data[index]['id_medida'] = result[1];
               }

               if(key=='cantidad'){
                  result = functionCtrl.isInt($scope.data[index][key]);
                  $scope.data[index]['cantidadInteger'] = result;
               }

               if(key=='unidades por caja'){
                  result = functionCtrl.isInt($scope.data[index][key]);
                  $scope.data[index]['unidadInteger'] = result;
               }

               if(key=='precio de venta'){
                  result = functionCtrl.isFloat($scope.data[index][key]);
                  $scope.data[index]['precioFloat'] = result;
               }

               if(key=='costo'){
                  result = functionCtrl.isFloat($scope.data[index][key]);
                  $scope.data[index]['costoFloat'] = result;
               }

               if(key=='fecha'){
                  result = functionCtrl.validDate($scope.data[index][key]);
                  $scope.data[index]['formatDate'] = result;
               }

               if (result==false){
                  $scope.dataExcelValid = false;
               }
               // console.log("Key = >" + key); console.log("Value => " + $scope.data[index][key]);
            });
         }

         if($scope.data[0].sku=='Codigo Unico del producto'){
            $scope.data.shift();
         }

         $timeout(function(){
            $scope.loader();
            $scope.datosExcel = $scope.data;
            $scope.formulario_carga_inv = true;
            $scope.dataExcelValid;
         },100);
      }

      $scope.cargaInventario = function () {

         if($scope.loadding){ return 0; }
         $scope.loader('Creando cliente . . .');

         $http.post('api/productos/cargaMasivaInventario', $scope.datosExcel).success(function(response){

            $scope.loader();
            $scope.datosExcel = [];
            $scope.resultadoProductos = response.resultado;
            $scope.getProductos();

         });

      }

   /******************************** INVENTARIOS ********************************/
});

/* Filtra productos por categoria */
posApp.filter('categoria', [function () {
   return function (data, categoria) {
      var resultado = [];

      resultado = data.filter(function (item) {
         return (item.id_categoria == categoria.id && categoria.nomProducto != item.nombre);
      });

      return resultado;
   }
}]);
