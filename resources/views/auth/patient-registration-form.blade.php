@include('includes.errors.custom')
<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ config('app.name','Patient Flow System')}}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{!! asset('login-page/Login_v1/images/icons/favicon.ico') !!}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login-page/Login_v1/vendor/bootstrap/css/bootstrap.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login-page/Login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet') !!}" type="text/css" href="{! asset('login-page/Login_v1/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{!! asset('login-page/Login_v1/vendor/css-hamburgers/hamburgers.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login-page/Login_v1/vendor/select2/select2.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login-page/Login_v1/css/util.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('login-page/Login_v1/css/main.css') !!}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{!! asset('login-page/Login_v1/images/logo/flow2.jpg" alt="IMG') !!}">
				</div>

                <form class="login100-form validate-form" method="post" action="{{ route('patient.register.submit') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
					<span class="login100-form-title">
						{{ __('CREATE ACCOUNT') }}
					</span>
                    <div class="wrap-input100 validate-input $errors->has('name')? 'has-error':''">
                            <input class="input100 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus type="name" placeholder="Username">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
					<div class="wrap-input100 validate-input $errors->has('email')? 'has-error':''">
                        <input class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @enderror
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
                        <div class="wrap-input100 validate-input $errors->has('phone')? 'has-error':''">
                                <input class="input100 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus type="phone" placeholder="Phone">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @enderror
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                        </div>
                        <div class="wrap-input100 validate-input">
                                <input class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" placeholder="Password" >
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input">
                                    <input class="input100 @error('password_conf') is-invalid @enderror" name="password_conf" required autocomplete="current-password" type="password" placeholder="Confirm Password" >
                                        @error('password_conf')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                        <div class="wrap-input100 validate-input $errors->has('avartar')? 'has-error':''">
                            <label for="avartar" class="form-label text-md-right">{{ __('Upload Your Photo') }}</label>
                                <input class="input1004 @error('avartar') is-invalid @enderror" name="avartar"  required autofocus type="file" >
                                        @error('avartar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('avartar') }}</strong>
                                            </span>
                                        @enderror
                                <span class="focus-input100"></span>
                        </div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							{{ __('REGISTER') }}
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="{!! asset('login-page/Login_v1/vendor/jquery/jquery-3.2.1.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('login-page/Login_v1/vendor/bootstrap/js/popper.js') !!}"></script>
	<script src="{!! asset('login-page/Login_v1/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('login-page/Login_v1/vendor/select2/select2.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('login-page/Login_v1/vendor/tilt/tilt.jquery.min.js') !!}"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		});
	</script>
<!--===============================================================================================-->
	<script src="{!! asset('login-page/Login_v1/js/main.js') !!}"></script>

</body>
</html>
<!-- 
