@section('menulateral')
   <div ng-controller="MenuCtrl" ng-cloak>
      <div class="ed-container s-100 m-15 container_menu" id="container_menu">
         <div class="container_menutop">
            <div class="logo_menupos" ng-if="!minizarmenuLateral"></div>
            <div class="logo_menupos_mini" ng-if="minizarmenuLateral"></div>
            <div class="ico_exit" ng-click="closeMenu()"></div>

            <div class="container_menulist">

               @role('admin')
                  <a href="{{ route('escritorio') }}" class="menulist_item ico_escritorio
                     {{ request()->is('escritorio') ? 'active_menu' : '' }}">
                     <p>Escritorio</p>
                  </a>
               @endrole

               @role('admin | operativo')
                  <a href="{{ route('subirArchivo') }}" class="menulist_item ico_ordenes {{ request()->is('subirArchivo') ? 'active_menu' : '' }}">
                     <p>Subir archivo</p>
                  </a>
               @endrole

                  <a href="#" class="menulist_item ico_ajustes" ng-click="showAjustes()">
                     <p>Ajustes</p>
                  </a>

                  <ul class="list_toggle__menu" ng-if="list_ajustes">

                     <li class="toggle_item">
                        <a href="{{route('usuario')}}" class="menulist_item ico_clientes {{ request()->is('usuario') ? 'active_menu' : '' }}">
                           <p>Usuarios</p>
                        </a>
                     </li>
                  </ul>
            </div>
         </div>

         <div class="container_menubottom">

            <div class="container_menulist">
      
               <a href="{{route('logout')}}" class="menulist_item ico_salir">
                  <p>Salir</p>
               </a>

               <a href="#" class="menulist_item ico_minimizar" ng-click="minizarMenu()" ng-if="!minizarmenuLateral">
                  <p>Minimizar menú</p>
               </a>

               <a href="#" class="menulist_item ico_minimizar__rotate" ng-click="minizarMenu()" ng-if="minizarmenuLateral"></a>
            </div>

         </div>
      </div>

      <div class="munu_banner">
         <div class="logo_posphone"></div>
         <div class="ico_menu" ng-click="showMenu()"></div>
      </div>
   </div>
@show
@push('scripts')
   <script src="/js/Controller/MenuCtrl.js"></script>
@endpush
