@extends('customer.layout')
@section('title', 'Đăng nhập')
			
@section('body')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 offset-md-2">
			
				<!-- Account Content -->
				<div class="account-content">
					<div class="row align-items-center justify-content-center">
						<div class="col-md-7 col-lg-6 login-left">
							<img src="assets/img/login-banner.png" class="img-fluid" alt="Login Banner">	
						</div>
						<div class="col-md-12 col-lg-6 login-right">
							<div class="login-header">
								<h3>Đăng kí</h3>
							</div>
							
							<!-- Register Form -->
							<form method="POST" action="{{ route('customer.register') }}" class="login-form" id="register-form">
								@csrf
				                @if ($errors->any())
				                    <div class="alert alert-danger">
				                        <ul>
				                            @foreach ($errors->all() as $error)
				                                <li>{{ $error }}</li>
				                            @endforeach
				                        </ul>
				                    </div>
				                @endif
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
									<input type="text" class="form-control floating" name="username">
									<label class="focus-label">Họ và tên</label>
								</div>
								<div class="form-group form-focus">
									<input type="email" class="form-control floating" name="email">
									<label class="focus-label">Email</label>
								</div>
								<div class="form-group form-focus">
									<input type="text" class="form-control floating" name="telephone">
									<label class="focus-label">Số điện thoại</label>
								</div>
								<div class="form-group form-focus">
									<input type="password" class="form-control floating" name="password">
									<label class="focus-label">Mật khẩu</label>
								</div>
								<div class="text-right">
									<a class="forgot-link" href="{{ route('customer.login') }}">Bạn đã có tài khoản ? Đăng nhập</a>
								</div>
								<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Đăng kí</button>
							</form>
							<!-- /Register Form -->
							
						</div>
					</div>
				</div>
				<!-- /Account Content -->
					
			</div>
		</div>

	</div>
@endsection()