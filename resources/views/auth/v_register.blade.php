<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register </title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  
    {{-- CSS Libraries --}}
    @yield('page-styles')
  
    {{-- Template CSS  --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">
  </head>

<body >
<div id="app">
    <section class="section">
      <div class="container mt-1">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
           

            <div class="card card-primary shadow-dark rounded">
              <div class="card-header"><h4>Register</h4></div>
    <div class="container mt-5 mx-auto h-100vh">
        <form method="post" action="{{ route('registerProcess') }}">
            @csrf
            @if (session('gagal'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ session('gagal') }}</strong>
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
            <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" type="text" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>No Phone</label>
                                        <input class="form-control" type="text" name="no_phone">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role">
                                            <option value="users">Admin</option>
                                            <option value="studentcounselor">Guru Pembimbing</option>
                                            <option value="prayercounselor">Pembimbing Rayon</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select class="form-control" name="jabatan">
                                            <option value="users">Admin</option>
                                            <option value="studentcounselor">Guru Pembimbing</option>
                                            <option value="prayercounselor">Pembimbing Rayon</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">Register</button>
                                    </div>
                                </div>
                                    <p class="text-center">Sudah Punya Akun?<a href="{{ url('login') }}">Masuk</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/jquery-3.3.1.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/js/popper.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/js/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('assets/js/moment.min.js')}}"></script>
  <script src="{{ asset('assets/js/stisla.js')}}"></script>

  {{-- JS Libraies --}}

  {{-- Template JS File  --}}
  <script src="{{ asset('assets/js/scripts.js')}}"></script>
  <script src="{{ asset('assets/js/custom.js')}}"></script>
</body>
</html>