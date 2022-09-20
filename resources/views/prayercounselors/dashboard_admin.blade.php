<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') Guru Pendamping</title>
  <link rel="shorcut icon" href="../assetss/img/icon.png">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ asset('assetss/css/bootstrap.min.css') }}" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assetss/css/all.css') }}" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assetss/css/bootstrap-timepicker.min.css') }}" crossorigin="anonymous">

  {{-- CSS Libraries --}}
  @yield('page-styles')

  {{-- Template CSS  --}}
  <link rel="stylesheet" href="{{ asset('assetss/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assetss/css/components.css')}}">
</head>

<body class="sidebar-gone sidebar-mini">
  <div id="app">
    <div class="main-wrapper">
      @include('prayercounselors.header')
      @include('prayercounselors.sidebar')

      {{-- Main Content  --}}
      <div class="main-content">
        
        @yield('content')

      </div>
      <footer class="main-footer">
        <div class="footer-left">
           SMK WIKRAMA BOGOR &copy; {{ date('Y') }} 
              <!-- </div> Design By <a href="https://www.instagram.com/dimasrizqi">RADJA RIZQI RAMADHAN </a>  -->
        </div>
        
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assetss/js/jquery-3.3.1.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('assetss/js/popper.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('assetss/js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('assetss/js/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('assetss/js/moment.min.js')}}"></script>
  <script src="{{ asset('assetss/js/stisla.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  {{-- JS Libraies --}}

  {{-- Template JS File  --}}
  <script src="{{ asset('assetss/js/scripts.js')}}"></script>
  <script src="{{ asset('assetss/js/custom.js')}}"></script>

   <!-- Page Specific JS File  -->
   
  @stack('page-scripts')
  @yield('chart')
  @yield('javascript')  

<script type="text/javascript">
  $(document).ready( function () {
    $('#table').DataTable();
  } );
</body>
</html>
