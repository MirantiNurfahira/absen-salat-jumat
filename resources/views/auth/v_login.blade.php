<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Halaman Login </title>

    <link rel="stylesheet" href="{{ asset('assetss/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assetss/css/all.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assetss/css/custom.css') }}">

    {{-- CSS Libraries --}}
    @yield('page-styles')

    {{-- Template CSS  --}}
    <link rel="stylesheet" href="{{ asset('assetss/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assetss/css/components.css')}}">
  </head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-1">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <div class="card card-primary shadow-dark rounded">
              <div class="card-header"><h4>Login</h4></div>
    <div class="container mt-5 mx-auto h-100vh">
        <div class="row align-items-center justify-content-center">
            <div class="col w-320px">
                <form method="post" action="{{ route('loginProcess') }}">
                    @if (session('gagal'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ session('gagal') }}</strong>
                    </div>
                    @elseif(session('sukses'))
                    <div class="alert alert-primary alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ session('sukses') }}</strong>
                    </div>
                    @endif

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Masukan Email" required>
                    </div>
                    <div class="form-group">
                    <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukan Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Masuk</button>


                    </div>
                    <!--<p class="text-center">Belum Punya Akun?<a href="{{ url('register') }}"> Daftar</a></p>-->
                </form>
            </div>
        </div>
    </div>
       <!-- General JS Scripts -->
  <script src="{{ asset('assetss/js/jquery-3.3.1.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('assetss/js/popper.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('assetss/js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('assetss/js/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('assetss/js/moment.min.js')}}"></script>
  <script src="{{ asset('assetss/js/stisla.js')}}"></script>

  {{-- JS Libraies --}}

  {{-- Template JS File  --}}
  <script src="{{ asset('assets/js/scripts.js')}}"></script>
  <script src="{{ asset('assets/js/custom.js')}}"></script>
</body>
</html>
