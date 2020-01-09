<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <title>{{ config('app.name', 'Laravel') }}</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <meta name="HandheldFriendly" content="true">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

      <!-- Styles -->
      <link rel="stylesheet" type="text/css" href="{{ asset('js/library/block/angular-block-ui.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('js/dropzone/dropzone.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('js/dropzone/ng-dropzone.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/library/flickity.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/library/nya-bs-select.css') }}">
      {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/nya-bs-select.css') }}"> --}}

      <link rel="stylesheet" href="https://unpkg.com/tippy.js@5/dist/backdrop.css" />
      <link href="{{ mix('css/app.css') }}" rel="stylesheet">

   </head>

   <body id="app" ng-app="myApp">
      @yield('content')

      {{-- Scripts --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
      {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script> --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

      <script type="text/javascript" src="{{asset('js/library/angular.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/library/ngMask.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/library/block/angular-block-ui.js')}}"></script>
      <script type="text/javascript" src="{{asset("js/library/ng-infinite-scroll.min.js")}}"></script>
      {{-- <script type="text/javascript" src="{{asset("js/library/nya-bs-select.js")}}"></script> --}}
      <script type="text/javascript" src="{{asset('js/dropzone/dropzone.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/dropzone/ng-dropzone.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/library/flickity.pkgd.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/library/angular-messages.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/library/angular-local-storage.min.js')}}"></script>

      <script type="text/javascript" src="{{asset('js/appAngular.js')}}"></script>

      <script src="{{asset('js/library/highcharts/highstock.js')}}"></script>
      <script src="{{asset('js/library/highcharts/exporting.js')}}"></script>
      <script src="{{asset('js/library/highcharts/highcharts-more.js')}}"></script>
      <script src="{{asset('js/library/highcharts/solid-gauge.js')}}"></script>
      <script src="{{asset('js/library/highcharts/export-data.js')}}"></script>

      <script src="{{asset('js/library/angular-js-xlsx.js')}}"></script>
      <script src="{{asset('js/library/xlsx.js')}}"></script>
      <script src="{{asset('js/library/export_excel/FileSaver.min.js')}}"></script>

      <!-- para subir archivos -->
      <script src="{{asset('js/library/angular-file-upload.js')}}"></script>

      <script src="https://unpkg.com/popper.js@1"></script>
      <script src="https://unpkg.com/tippy.js@5"></script>

      {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.9.13/xlsx.full.min.js"></script>
      <script type="text/javascript" src="https://unpkg.com/angular-js-xlsx@0.0.3/angular-js-xlsx.js"></script> --}}

      @stack('scripts')
   </body>
</html>
