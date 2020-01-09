<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedidos\Pedidos;
use App\Models\ProductosPedidos;
use App\Models\Empresas;
use App\Models\clientes\Clientes;
use App\Helpers\Empresa;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class EscritorioController extends Controller{


   public function getResumen(){

      $identidad = Empresa::getIdentidad();
      Carbon::setlocale(config('app.locale'));

      $empresa = Empresas::where('identidad_empresa', $identidad)->select('moneda','ventas_meta')->first();

      #ventas del ultimo anio
      $primerDia_year = Carbon::now()->startOfYear();
      $ultimoDia_year = Carbon::now()->endOfYear();
      $pedidos_year = Pedidos::where('identidad_abastecedor',$identidad)->whereIn('estado',[5])
                             ->whereBetween('created_at', [$primerDia_year, $ultimoDia_year])
                             ->select(\DB::raw('sum(total) as total'), \DB::raw('count(id) as cantidad'))->first();

      #resumen de pedidos
      $total_pedidos = Pedidos::with('Estado')->where('identidad_abastecedor',$identidad)->whereIn('estado',[1,2,3,4,5])
                              ->whereBetween('created_at', [$primerDia_year, $ultimoDia_year])
                              ->select(\DB::raw('sum(total) as total'), \DB::raw('count(id) as cantidad'), 'estado')->groupBy('estado')->get();

      #ventas del mes pasado
      $pedidos_mes = Pedidos::where('identidad_abastecedor',$identidad)->whereIn('estado',[5])
                           ->whereBetween('created_at', [Carbon::now()->subMonth(1)->startOfMonth(), Carbon::now()->subMonth(1)->endOfMonth()])
                           ->select(\DB::raw('sum(total) as total'), \DB::raw('count(id) as cantidad'))->first();

      #ventas mes actual
      $pedidos_mes_actual = Pedidos::where('identidad_abastecedor',$identidad)->whereIn('estado',[5])
                           ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                           ->select(\DB::raw('sum(total) as total'), \DB::raw('count(id) as cantidad'))->first();

      #ventas de la semana pasada
      $pedidos_semana = Pedidos::where('identidad_abastecedor',$identidad)->whereIn('estado',[5])
                           ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(),Carbon::now()->subWeek()->endOfWeek()])
                           ->select(\DB::raw('sum(total) as total'), \DB::raw('count(id) as cantidad'))->first();

      $venta_por_mes    = [];
      $venta_por_dia    = [];
      $promedio_por_mes = [];
      $pedidos_por_mes  = [];
      $clientes_por_mes = [];
      $period = CarbonPeriod::create(Carbon::now()->startOfYear(),'1 month',Carbon::now()->endOfMonth());

      foreach ($period as $mes){
         #total de ventas por meses
         array_push($venta_por_mes,    ["mes" => $mes->format('F'), "venta"  => $this->ventaMes($mes->format('m/y'), $identidad)]);

         #promedio por mes
         array_push($promedio_por_mes, ["mes" => $mes->format('F'), "promedio" => $this->promedioMes($mes->format('m/y'), $identidad)]);

         #pedidos por mes
         array_push($pedidos_por_mes,  ["mes" => $mes->format('F'), "pedidos" => $this->pedidosMes($mes->format('m/y'), $identidad)]);

         #clientes por mes
         array_push($clientes_por_mes, ["mes" => $mes->format('F'), "clientes" => $this->clientesMes($mes->format('m/y'), $identidad)]);
      }

      #ventas del mes actual por dia
      $period = CarbonPeriod::create(Carbon::now()->startOfMonth(),'1 day',Carbon::now());
      foreach ($period as $dia){
         array_push($venta_por_dia, ["dia" => $dia->format('d/m'), "venta" => $this->ventaDia($dia->format('d/m/y'), $identidad)]);
      }

      $total_clientes = Clientes::where('identidad_empresa',$identidad)->where('estado',1)->count();
      $clientes_mes = Clientes::where('identidad_empresa',$identidad)->where('estado',1)->whereBetween('created_at', [Carbon::now()->subMonth(1)->startOfMonth(), Carbon::now()->subMonth(1)->endOfMonth()])->count();
      $clientes_mes_actual = Clientes::where('identidad_empresa',$identidad)->where('estado',1)->whereBetween('created_at', [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->count();

      $resumen = (object)[
         'venta_year'          => isset($pedidos_year->total)       ? $pedidos_year->total       : 0,
         'venta_mes'           => isset($pedidos_mes->total)        ? $pedidos_mes->total        : 0,
         'venta_mes_actual'    => isset($pedidos_mes_actual->total) ? $pedidos_mes_actual->total : 0,
         'venta_semana'        => isset($pedidos_semana->total)     ? $pedidos_semana->total     : 0,
         'promedio_year'       => isset($pedidos_year->total)   | $pedidos_year->total!=0   ? ($pedidos_year->total/$pedidos_year->cantidad)     : 0,
         'promedio_mes'        => isset($pedidos_mes->total)    | $pedidos_mes->total!=0    ? ($pedidos_mes->total /$pedidos_mes->cantidad)      : 0,
         'promedio_semana'     => isset($pedidos_semana->total) | $pedidos_semana->total!=0 ? ($pedidos_semana->total/$pedidos_semana->cantidad) : 0,
         'venta_por_mes'       => $venta_por_mes,
         'venta_por_dia'       => $venta_por_dia,
         'promedio_por_mes'    => $promedio_por_mes,
         'pedidos_por_mes'     => $pedidos_por_mes,
         'clientes_por_mes'    => $clientes_por_mes,
         'total_pedidos'       => $total_pedidos,
         'total_clientes'      => $total_clientes,
         'clientes_mes'        => $clientes_mes,
         'clientes_mes_actual' => $clientes_mes_actual,
         'moneda'              => isset($empresa->moneda) ? $empresa->moneda : '',
         'venta_metas'         => isset($empresa->ventas_meta) ? $empresa->ventas_meta : '',
      ];

      return response()->json(['codigo'=> 200, 'result' => $resumen],200);
   }

      function clientesMes($mes, $identidad){
         $clientes = Clientes::where('identidad_empresa',$identidad)->where('estado',1)->where(\DB::raw('DATE_FORMAT(created_at, "%m/%y")'),$mes)->count();
         return $clientes;
      }

      function pedidosMes($mes, $identidad){
         $total = Pedidos::where('identidad_abastecedor',$identidad)
                           ->whereIn('estado',[5])
                           ->where(\DB::raw('DATE_FORMAT(created_at, "%m/%y")'),$mes)->count();
         return $total;
      }

      function ventaMes($mes, $identidad){
         $venta = Pedidos::where('identidad_abastecedor',$identidad)
                           ->whereIn('estado',[5])
                           ->where(\DB::raw('DATE_FORMAT(created_at, "%m/%y")'),$mes)
                           ->select(\DB::raw('sum(total) as total'))->first();
         return $venta;
      }

      function ventaDia($dia, $identidad){
         $venta = Pedidos::where('identidad_abastecedor',$identidad)
                           ->whereIn('estado',[5])
                           ->where(\DB::raw('DATE_FORMAT(created_at, "%d/%m/%y")'),$dia)
                           ->select(\DB::raw('sum(total) as total'))->first();
         return $venta;
      }

      function promedioMes($mes, $identidad){
         $promedio = Pedidos::where('identidad_abastecedor',$identidad)->whereIn('estado',[5])
                              ->where(\DB::raw('DATE_FORMAT(created_at, "%m/%y")'),$mes)
                              ->select(\DB::raw('sum(total) as total'), \DB::raw('count(id) as cantidad'))->first();

         return  $promedio->total==null ? 0 : ($promedio->total/$promedio->cantidad);
      }

   public function getPedidos(){

      $identidad = Empresa::getIdentidad();
      $pedidos = Pedidos::with('Cliente', 'Direccion','Estado')->where('identidad_abastecedor', $identidad)->whereIn('estado',[1,2,3,4,5,6,7])->limit(5)->orderby('id', 'DESC')->get();

      if($pedidos->isEmpty()){
         return response()->json(['codigo'=> 400, 'mensaje' => 'No existen pedidos actualmente'],200);
      }

      return response()->json(['codigo'=> 200, 'result' => $pedidos],200);
   }

   public function masVendido(){

      $identidad = Empresa::getIdentidad();

      $top_productos = ProductosPedidos::join('productos','productos.id','pedido_productos.id_producto')
                                       ->select(\DB::raw('COUNT(*) AS total'),
                                                'productos.nombre',
                                                'productos.stock',
                                                \DB::raw('sum(pedido_productos.cantidad*pedido_productos.precio) AS venta'),
                                                \DB::raw('sum(pedido_productos.cantidad) AS cantidad') )
                                       ->where('productos.identidad_empresa',$identidad)
                                       ->groupBy('productos.id')->limit(5)->get();

     return response()->json(['codigo'=> 200, 'productos' => $top_productos]);
   }

   public function asignarMeta(Request $request){

      $identidad = Empresa::getIdentidad();
      $empresa = Empresas::where('identidad_empresa', $identidad)->first();

      if ($empresa) {
         $empresa->ventas_meta = $request->cantidad;
         $empresa->save();
      }

      return response()->json(['codigo'=> 200, 'metas' => $empresa->ventas_meta]);
   }

}
