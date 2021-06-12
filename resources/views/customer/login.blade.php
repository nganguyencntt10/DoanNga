@extends('customer.layout')
@section('title', 'Đăng nhập')
			
@section('body')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				
				<!-- Login Tab Content -->
				<div class="account-content">
					<div class="row align-items-center justify-content-center">
						<div class="col-md-7 col-lg-6 login-left">
							<img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Login">	
						</div>
						<div class="col-md-12 col-lg-6 login-right">
							<div class="login-header">
								<h3>Đăng nhập</h3>
							</div>
							<form action="{{ route('customer.login') }}" class="login-form" method="POST">
								@csrf
				                @if ( Session::has('error') )
				                    <div class="alert alert-danger" role="alert">
				                        {{ Session::get('error') }}
				                    </div>
				                @endif
				                @if ( Session::has('success') )
				                    <div class="alert alert-success" role="alert">
				                        {{ Session::get('success') }}
				                    </div>
				                @endif
								<div class="form-group form-focus">
									<input type="email" class="form-control floating" name="email">
									<label class="focus-label">Email</label>
								</div>
								<div class="form-group form-focus">
									<input type="password" class="form-control floating" name="password">
									<label class="focus-label">Mật khẩu</label>
								</div>
								<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Đăng nhập</button>
								<div class="text-center dont-have">Bạn chưa có tài khoản ? <a href="{{ route('customer.register') }}">Đăng kí</a></div>
							</form>
						</div>
					</div>
				</div>
				<!-- /Login Tab Content -->
					
			</div>
		</div>

	</div>
@endsection()