<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v8/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v8/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v8/vendor/animate/animate.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v8/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v8/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v8/vendor/select2/select2.min.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v8/vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v8/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v8/css/main.css') }}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form p-l-55 p-r-55 p-t-178">
					@csrf

					<span class="login100-form-title">
						Sign In
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email">
						<input class="input100" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
						<span class="focus-input100"></span>
					</div>
					@error('email')
						<div class="text-danger mt-1">{{ $message }}</div>
					@enderror

					<div class="wrap-input100 validate-input" data-validate="Please enter password">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
					</div>
					@error('password')
						<div class="text-danger mt-1">{{ $message }}</div>
					@enderror

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							@if (Route::has('password.request'))
								<a href="{{ route('password.request') }}" class="txt2">
									Forgot Password?
								</a>
							@endif
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Sign in
						</button>
					</div>

					<div class="flex-col-c p-t-170 p-b-40">
						<span class="txt1 p-b-9">
							Don’t have an account?s
						</span>

						<a href="{{ route('register') }}" class="txt3">
							Sign up now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<script src="{{ asset('Login_v8/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('Login_v8/vendor/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ asset('Login_v8/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('Login_v8/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('Login_v8/vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('Login_v8/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('Login_v8/vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('Login_v8/vendor/countdowntime/countdowntime.js') }}"></script>
	<script src="{{ asset('Login_v8/js/main.js') }}"></script>

</body>
</html>
