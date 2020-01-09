@extends('layouts.app')
@section('content')

@include('layouts.menulateral')
<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="testCtrl">
   <div class="head_content">
      <h1>Reportes</h1>
   </div>

   <div class="dash_content">
      <div class="ed-container full">
         <div class="ed-item s-100 m-1-3 spi sp_phone">
            <div class="box_reports">
               <div class="ed-item ed-container full h_card">
                  <div class="ed-item s-60 cross-center main-center spi spd">
                     <div class="ico_tarjetas">
                        <p>Ventas</p>
                        <h2>Tarjetas</h2>
                     </div>
                  </div>

                  <div class="ed-item s-40 spi spd cross-center main-center">
                     <a href="#" class="btn btn_pos w_auto">Ver historial</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="ed-item s-100 m-1-3 spi spd">
            <div class="box_reports bg_efectivo">
               <div class="ed-item ed-container full h_card">
                  <div class="ed-item s-60 cross-center main-center spi spd">
                     <div class="ico_efectivo">
                        <p>Ventas</p>
                        <h2>Efectivo</h2>
                     </div>
                  </div>

                  <div class="ed-item s-40 spi spd cross-center main-center">
                     <a href="#" class="btn btn_efectivo">Ver historial</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="ed-item s-100 m-1-3 spd sp_phone">
            <div class="box_reports bg_banco">
               <div class="ed-item ed-container full h_card">
                  <div class="ed-item s-60 cross-center main-center spi spd">
                     <div class="ico_banco">
                        <p>Ventas</p>
                        <h2>Banco</h2>
                     </div>
                  </div>

                  <div class="ed-item s-40 spi spd cross-center main-center">
                     <a href="#" class="btn btn_banco">Ver historial</a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="ed-container full">
         <div class="ed-item s-100 m-100 spi spd">
            <div class="container_chartventas">
               <div class="ed-item ed-container full">
                  <div class="ed-item s-100 cross-center main-end">
                     <div class="container_btn_fill">
                        <button type="button" class="btn btn_fill active">Día</button>
                        <button type="button" class="btn btn_fill">Mes</button>
                        <button type="button" class="btn btn_fill">Año</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="ed-container full">
         <div class="ed-item s-100 m-50 spi sp_phone">
            <div class="container_historicos">
               <div class="historico_option">
                  <div class="container_btn_fill">
                     <button type="button" class="btn btn_fill active">Día</button>
                     <button type="button" class="btn btn_fill">Mes</button>
                     <button type="button" class="btn btn_fill">Año</button>
                  </div>

                  <h1>Historicos</h1>
               </div>

               <div class="list_promos">
                  <div class="promos_item">
                     <p><b>1.</b> descuentos</p>
                  </div>
                  <div class="promos_item">
                     <p><b>2.</b> regalos</p>
                  </div>
                  <div class="promos_item">
                     <p><b>3.</b> todo en uno</p>
                  </div>
                  <div class="promos_item">
                     <p><b>3.</b> todo en uno</p>
                  </div>
                  <div class="promos_item">
                     <p><b>3.</b> todo en uno</p>
                  </div>
               </div>

               <div class="footer_promos">
                  <a href="#"><p>Ver Más</p></a>
               </div>
            </div>
         </div>

         {{-- <div class="ed-item s-100 m-50 spi spd">
            <div class="mapa_container">
               <div class="head_mapa">
                  <h2>Ubucaciones</h2>
                  <div class="ico_ubi"></div>
               </div>
               Mapa
            </div>
         </div> --}}

      </div>
   </div>
</div>
@endsection

@push('scripts')
<script src="/js/Controller/testCtrl.js"></script>
@endpush

