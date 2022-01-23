<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lupa Password - Bedug Langgeng</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login_assets/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-login100">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form class="login100-form validate-form" action="{{ route('password.email') }}" method="post">
				{{ csrf_field() }}
				<span class="login100-form-title p-b-37">
					<img src="{{asset('image/logo.png')}}" style="width:80%">
				</span>
				@if ($message = Session::get('error'))
					<div class="container mb-3" role="alert">
						<strong class="text-danger">Tidak Berhasil !</strong>
						<p>{{$message}}</p>
					</div>
				@endif
                @if (session('status'))
                    <div class="container mb-3" role="alert">
						<strong class="text-success">Berhasil !</strong>
						<p>{{session('status')}}</p>
					</div>
                @endif
				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
					<input class="input100" type="text" name="email" @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn mb-3">
					<button type="submit" class="login100-form-btn">
						Kirim link ganti password
					</button>
                               
				</div>

				<!-- <div class="text-center">
					<a href="#" class="txt2 hov1">
						Belum punya akun? Daftar
					</a>
				</div> -->
			</form>


		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="{{asset('login_assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login_assets/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login_assets/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('login_assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login_assets/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login_assets/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('login_assets/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login_assets/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login_assets/js/main.js')}}"></script>

</body>
</html>

