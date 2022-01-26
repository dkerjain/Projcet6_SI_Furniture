<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/assets_login/login-form-02/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{ asset('/assets_login/login-form-02/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/assets_login/login-form-02/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('/assets_login/login-form-02/css/style.css')}}">

    <title>Login #2</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url({{asset('assets_login/login-form-02/images/bg_1.jpg')}})"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <center><h3>Login</h3></center><br>
			@if ($message = Session::get('error'))
				<div class="container mb-3" role="alert">
					<strong class="text-danger">Tidak Berhasil !</strong>
					<p>{{$message}}</p>
				</div>
			@endif
            <form action="{{ route('login.submit') }}" class="validate-form" method="post">
            {{ csrf_field() }}   
              <div class="form-group first">
                <label for="username">Email</label>
                <input type="text" class="form-control" placeholder="your-email@gmail.com" id="email" name="email">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Your Password" id="password" name="password">
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="{{ asset('/assets_login/login-form-02/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('/assets_login/login-form-02/js/popper.min.js')}}"></script>
    <script src="{{ asset('/assets_login/login-form-02/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('/assets_login/login-form-02/js/main.js')}}"></script>
  </body>
</html>