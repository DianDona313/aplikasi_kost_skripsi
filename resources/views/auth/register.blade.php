<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
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

    <style>
        select.input100 {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='12' viewBox='0 0 24 24' width='12' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: 50%;
            background-size: 12px;
        }

        .custom-file {
            background: #f7f7f7;
            padding: 12px;
            border: none;
            font-family: inherit;
            color: #333;
            border-radius: 25px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data" class="login100-form validate-form p-l-55 p-r-55 p-t-178">
                    @csrf

                    <span class="login100-form-title">Register</span>

                    {{-- Name --}}
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter name">
                        <input id="name" type="text" name="name" class="input100" placeholder="Name" value="{{ old('name') }}" required autofocus>
                        <span class="focus-input100"></span>
                    </div>
                    @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror

                    {{-- Email --}}
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email">
                        <input id="email" type="email" name="email" class="input100" placeholder="Email" value="{{ old('email') }}" required>
                        <span class="focus-input100"></span>
                    </div>
                    @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror

                    {{-- Password --}}
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter password">
                        <input id="password" type="password" name="password" class="input100" placeholder="Password" required>
                        <span class="focus-input100"></span>
                    </div>
                    @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror

                    {{-- Confirm Password --}}
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please confirm password">
                        <input id="password-confirm" type="password" name="password_confirmation" class="input100" placeholder="Confirm Password" required>
                        <span class="focus-input100"></span>
                    </div>

                    {{-- Nomor HP --}}
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter phone number">
                        <input type="text" name="no_hp" class="input100" placeholder="Nomor HP" value="{{ old('no_hp') }}" required>
                        <span class="focus-input100"></span>
                    </div>
                    @error('no_hp') <div class="text-danger mt-1">{{ $message }}</div> @enderror

                    {{-- Alamat --}}
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter address">
                        <input type="text" name="alamat" class="input100" placeholder="Alamat" value="{{ old('alamat') }}" required>
                        <span class="focus-input100"></span>
                    </div>
                    @error('alamat') <div class="text-danger mt-1">{{ $message }}</div> @enderror

                    {{-- Jenis Kelamin --}}
                    <div class="wrap-input100 m-b-16">
                        <select name="jenis_kelamin" class="input100" required>
                            <option value="" disabled selected>Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <span class="focus-input100"></span>
                    </div>
                    @error('jenis_kelamin') <div class="text-danger mt-1">{{ $message }}</div> @enderror

                    {{-- Foto --}}
                    <div class="wrap-input100 m-b-16">
                        <input type="file" name="foto" class="input100 custom-file" accept="image/*" required>
                    </div>
                    @error('foto') <div class="text-danger mt-1">{{ $message }}</div> @enderror

                    <div class="container-login100-form-btn m-t-20">
                        <button type="submit" class="login100-form-btn">
                            Register
                        </button>
                    </div>

                    <div class="flex-col-c p-t-170 p-b-40">
                        <span class="txt1 p-b-9">Already have an account?</span>
                        <a href="{{ route('login') }}" class="txt3">Sign in now</a>
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
