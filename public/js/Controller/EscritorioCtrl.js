posApp.controller('EscritorioCtrl',function($scope, $http){

   $scope.metas = {};

   $scope.getResumen = function(){
      $http.get('api/escritorio/getResumen').success(function(response){

         $scope.resumen = response.result;
         $scope.resumen.suma_pedidos = $scope.resumen.total_pedidos.reduce((acumulado, valor) =>  acumulado + valor.cantidad,0);

         $scope.graficaTotalVenta($scope.resumen.venta_por_mes, $scope.resumen.moneda);
         $scope.graficaTotalPromedio($scope.resumen.promedio_por_mes, $scope.resumen.moneda);
         $scope.graficaTotalPedidos($scope.resumen.pedidos_por_mes);
         $scope.graficaTotalClientes($scope.resumen.clientes_por_mes);
         $scope.graficaVentaDiaria($scope.resumen.venta_por_dia);

         let metas = $scope.resumen.venta_metas==0 ? 0 : ($scope.resumen.venta_mes_actual *100) / $scope.resumen.venta_metas;
         $scope.graficaMetas(parseInt(metas));
      });
   };

   $scope.graficaTotalVenta = function (datos, moneda){

      var x = [];
      var y = [];

      for (var i = 0; i < datos.length; i++) {
         x.push(datos[i].mes);
         datos[i].venta.total==null ? y.push(0) : y.push(datos[i].venta.total);
      }

      Highcharts.chart('container_venta', {
         chart: {
             type: 'areaspline'
         },
         exporting: {
            enabled: false
         },
         title: {
             text: ''
         },
         xAxis: {
            visible: false,
            categories: x,
         },
         yAxis: {
            visible: false,
            title: {
               text: null
            },
         },
         tooltip: {
            shared: true,
            valueSuffix: '  '+moneda
         },
         credits: {
             enabled: false
         },
         plotOptions: {
             areaspline: {
                 fillOpacity: 0.5,
                  fillColor: {
                        linearGradient: {
                           x1: 0,
                           y1: 0,
                           x2: 0,
                           y2: 1
                        },
                        stops: [
                           [0, '#ff6567'],
                           [1, '#fff']
                        ],
                     },marker: {
                        radius: 2,
                     }
             },
            series: {
               color: '#ff6567'
            }

         },
         series: [{
            showInLegend: false,
            name: '',
            data: y
         }]
     });

   }

   $scope.graficaTotalPromedio = function (datos, moneda){

      var x = [];
      var y = [];

      for (var i = 0; i < datos.length; i++) {
         x.push(datos[i].mes);
         datos[i].promedio==null ? y.push(0) : y.push(datos[i].promedio);
      }

      Highcharts.chart('container_promedio', {
         chart: {
             type: 'areaspline'
         },
         exporting: {
            enabled: false
         },
         title: {
             text: ''
         },
         xAxis: {
            visible: false,
            categories: x,
         },
         yAxis: {
            visible: false,
         },
         tooltip: {
            shared: true,
            valueSuffix: '  '+moneda
         },
         credits: {
             enabled: false
         },
         plotOptions: {
             areaspline: {
                 fillOpacity: 0.5,
                  fillColor: {
                        linearGradient: {
                           x1: 0,
                           y1: 0,
                           x2: 0,
                           y2: 1
                        },
                        stops: [
                           [0, '#ffa04e'],
                           [1, '#fff']
                        ],

                     },marker: {
                        radius: 2,
                     }
             },
            series: {
               color: '#ffa04e'
            }

         },
         series: [{
            showInLegend: false,
            name: '',
            data: y
         }]
     });

   }

   $scope.graficaTotalPedidos = function (datos){

      var x = [];
      var y = [];

      for (var i = 0; i < datos.length; i++) {
         x.push(datos[i].mes);
         datos[i].pedidos==null ? y.push(0) : y.push(datos[i].pedidos);
      }

      Highcharts.chart('container_pedidos', {
         chart: {
             type: 'areaspline'
         },
         exporting: {
            enabled: false
         },
         title: {
             text: ''
         },
         xAxis: {
            visible: false,
            categories: x,
         },
         yAxis: {
            visible: false,
         },
         tooltip: {
            shared: true,
            valueSuffix: ' pedidos'
         },
         credits: {
             enabled: false
         },
         plotOptions: {
             areaspline: {
                 fillOpacity: 0.5,
                  fillColor: {
                        linearGradient: {
                           x1: 0,
                           y1: 0,
                           x2: 0,
                           y2: 1
                        },
                        stops: [
                           [0, '#7963f1'],
                           [1, '#fff']
                        ],

                     },marker: {
                        radius: 2,
                     }
             },
            series: {
               color: '#7963f1'
            }

         },
         series: [{
            showInLegend: false,
            name: '',
            data: y
         }]
     });

   }

   $scope.graficaTotalClientes = function (datos){

      var x = [];
      var y = [];

      for (var i = 0; i < datos.length; i++) {
         x.push(datos[i].mes);
         datos[i].clientes==null ? y.push(0) : y.push(datos[i].clientes);
      }

      Highcharts.chart('container_clientes', {
         chart: {
             type: 'areaspline'
         },
         exporting: {
            enabled: false
         },
         title: {
             text: ''
         },
         xAxis: {
            visible: false,
            categories: x,
         },
         yAxis: {
            visible: false,
         },
         tooltip: {
            shared: true,
            valueSuffix: ' clientes'
         },
         credits: {
             enabled: false
         },
         plotOptions: {
            areaspline: {
               fillOpacity: 0.5,
               fillColor: {
                     linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                     },
                     stops: [
                        [0, '#3A79F0'],
                        [1, '#fff']
                     ],

                  },marker: {
                     radius: 2,
                  }
            },
            series: {
               color: '#3A79F0'
            }

         },
         series: [{
            showInLegend: false,
            name: '',
            data: y
         }]
     });

   }

   $scope.graficaVentaDiaria = function (datos){

      var x = [];
      var y = [];

      for (var i = 0; i < datos.length; i++) {
         x.push(datos[i].dia);
         datos[i].venta.total==null ? y.push(0) : y.push(datos[i].venta.total);
      }

      Highcharts.chart('container_venta_diaria', {
         chart: {
             type: 'spline'
         },
         exporting: {
            enabled: false
         },
         title: {
             text: ''
         },
         xAxis: {
            visible: false,
             categories: x
         },
         yAxis: {
            visible: true,
            title: {
               text: 'ventas'
            },
            labels: {
               formatter: function () {
                  return this.value;
               }
            }
         },
         tooltip: {
             crosshairs: true,
             shared: true
         },
         plotOptions: {
            spline: {
               marker: {
                  radius: 2,
                  lineColor: '#3A79F0',
                  lineWidth: 1
               }
            },
            series: {
               color: '#3A79F0'
            }
         },
         series: [{
            name: 'Ventas',
            marker: {
               symbol: 'circle',
           },
            data: y
         }]
     });

   }

   $scope.graficaMetas = function (value) {

      Highcharts.chart('container_metas', {

         chart: {
             type: 'solidgauge',
             height: '100%',
             events: {
               render: renderIcons
            }
         },
         exporting: {
            enabled: false
         },
         title: {
             text: '',
         },

         tooltip: {
            enabled:true,
            borderWidth: 0,
            backgroundColor: 'none',
            shadow: false,
            style: {
                fontSize: '16px'
            },
            pointFormat: '{series.name}<br><span style="font-size:2em; color: #454545; font-weight: bold">{point.y}%</span>',
            positioner: function (labelWidth) {
                return {
                    x: (this.chart.chartWidth - labelWidth) / 2,
                    y: (this.chart.plotHeight / 2) + 10
                };
            }
         },

         pane:{
            startAngle: 0,
            endAngle: 360,
            background: [{ // Track for Move
               outerRadius: '112%',
               innerRadius: '88%',
               backgroundColor: Highcharts.Color('#000')
                   .setOpacity(0.1)
                   .get(),
               borderWidth: 0
           }]
         },

         yAxis: {
            min: 0,
            max: 100,
            lineWidth: 0,
            tickPositions: []
         },

         plotOptions: {
             solidgauge: {
                 dataLabels: {
                     enabled: false,
                 },
                 linecap: 'round',
                 stickyTracking: false,
                 rounded: true,
             }
         },

         series: [{
             name: '',
             data: [{
                 color: '#FF9B48',
                 radius: '112%',
                 innerRadius: '88%',
                 y: value
             }],

         }, ]
     });

      function renderIcons() {
      // Move icon
         if (!this.series[0].icon) {
            this.series[0].icon = this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8])
               .attr({
                     stroke: '#454545',
                     'stroke-linecap': 'round',
                     'stroke-linejoin': 'round',
                     'stroke-width': 1,
                     zIndex: 10
               })
               .add(this.series[0].group);
         }
         this.series[0].icon.translate(
            this.chartWidth / 2 - 10,
            this.plotHeight / 2 - this.series[0].points[0].shapeArgs.innerR -
               (this.series[0].points[0].shapeArgs.r - this.series[0].points[0].shapeArgs.innerR) / 2
         );
      }

   }

   $scope.getPedidos = function(){
      $http.get('api/escritorio/getPedidos').success(function(response){
         $scope.pedidos = response.result; console.log($scope.pedidos);

      });
   };

   $scope.setAsignarMeta = function(){

      $http.post('api/escritorio/asignarMeta', $scope.metas).success(function(response){

         if(response.codigo==200) {
            $scope.asignarMeta = false;
            $scope.resumen.venta_metas = response.metas;

            let metas = $scope.resumen.venta_metas==0 ? 0 : ($scope.resumen.venta_mes_actual *100) / $scope.resumen.venta_metas;
            $scope.graficaMetas(parseInt(metas));
         }
      });
   }

   $scope.getResumen();
   $scope.getPedidos();
   /********************************  mapa de calor ********************************/
      function initMap() {
         map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: 14.6260, lng: -90.5315},
            mapTypeId: google.maps.MapTypeId.MAPA
         });

         heatmap = new google.maps.visualization.HeatmapLayer({
            data: getPoints(),
            map: map
         });
      }

      function toggleHeatmap() {
         heatmap.setMap(heatmap.getMap() ? null : map);
      }

      function changeGradient() {
         var gradient = [
            'rgba(0, 255, 255, 0)',
            'rgba(0, 255, 255, 1)',
            'rgba(0, 191, 255, 1)',
            'rgba(0, 127, 255, 1)',
            'rgba(0, 63, 255, 1)',
            'rgba(0, 0, 255, 1)',
            'rgba(0, 0, 223, 1)',
            'rgba(0, 0, 191, 1)',
            'rgba(0, 0, 159, 1)',
            'rgba(0, 0, 127, 1)',
            'rgba(63, 0, 91, 1)',
            'rgba(127, 0, 63, 1)',
            'rgba(191, 0, 31, 1)',
            'rgba(255, 0, 0, 1)'
         ]
         heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }

      function changeRadius() {
         heatmap.set('radius', heatmap.get('radius') ? null : 20);
      }

      function changeOpacity() {
         heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
      }

      // Heatmap data: 500 Points
      function getPoints() {

         var points =[];

         for (let index = 0; index <= 1000; index++){

            var long = (14.6229+(Math.sqrt(Math.random())));
            var lat = (-90.5315+(Math.sqrt(Math.random())-1));

            points.push(new google.maps.LatLng(long, lat))
            console.log(long);

         }
         return points;
      }

   /********************************  mapa de calor ********************************/

});
