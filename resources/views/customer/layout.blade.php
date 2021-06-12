<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/  30 Nov 2019 04:11:34 GMT -->
<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>HealthCare - @yield('title')</title>
		
	    <!-- Favicon -->
	    <link rel="shortcut icon" href="{{ asset('images_global/logo.jpg') }}">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('customer/assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{ asset('customer/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('customer/assets/plugins/fontawesome/css/all.min.css') }}">
		
		
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="{{ asset('customer/assets/plugins/fancybox/jquery.fancybox.min.css') }}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('customer/assets/css/style.css') }}">


		@yield('css')		
		<link rel="stylesheet" href="{{ asset('customer/assets/css/custom.css') }}">
	  
		<!-- jQuery -->
		<script src="{{ asset('customer/assets/js/jquery.min.js') }}"></script>
		

		
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<header class="header">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="{{ route('customer.index') }}" class="navbar-brand logo">
							<img src="{{ asset('images_global/healthcare-full.jpg') }}" class="img-fluid" alt="Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="{{ route('customer.index') }}" class="menu-logo">
								<img src="{{ asset('images_global/healthcare-full.jpg') }}" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li class="active">
								<a href="{{ route('customer.index') }}">Trang chủ</a>
							</li>
							<li class="">
								<a href="{{ route('customer.services') }}">Dịch vụ</a>
							</li>
							<li class="login-link">
								<a href="{{ route('customer.login') }}">Đăng nhập</a>
							</li>
						</ul>		 
					</div>		 
					<ul class="nav header-navbar-rht">
						<li class="nav-item contact-item">
							<div class="header-contact-img">
								<i class="far fa-hospital"></i>							
							</div>
							<div class="header-contact-detail">
								<p class="contact-header">Liên hệ</p>
								<p class="contact-info-header"> +1 315 369 5943</p>
							</div>
						</li>
						<?php if ($user_info): ?>
							<li class="nav-item dropdown has-arrow logged-item">
								<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
									<span class="user-img">
										<img class="rounded-circle" src="{{ asset($user_info['avatar']) }}" alt="<?php echo $user_info['name']?>" width="31">
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="user-header">
										<div class="avatar avatar-sm">
											<img src="{{ asset($user_info['avatar']) }}" alt="User Image" class="avatar-img rounded-circle">
										</div>
										<div class="user-text">
											<h6><?php echo $user_info['name']?></h6>
										</div>
									</div>
									<a class="dropdown-item" href="{{ route('customer.history') }}">Trang cá nhân</a>
									<a class="dropdown-item" style="cursor: pointer;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Đăng xuất</a>
								</div>
							</li>
				            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none pointer">
				                @csrf
				            </form>
						<?php else: ?>
							<li class="nav-item">
								<a class="nav-link header-login" href="{{ route('customer.login') }}">Đăng nhập</a>
							</li>
						<?php endif ?>
					</ul>
				</nav>
			</header>
			<!-- /Header -->
			
			@yield('body')
			
			<!-- Footer -->
			<footer class="footer">
				
				<!-- Footer Top -->
				<div class="footer-top">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-about">
									<div class="footer-logo">
										<img src="assets/img/footer-logo.png" alt="logo">
									</div>
									<div class="footer-about-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
										<div class="social-icon">
											<ul>
												<li>
													<a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a>
												</li>
												<li>
													<a href="#" target="_blank"><i class="fab fa-twitter"></i> </a>
												</li>
												<li>
													<a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
												</li>
												<li>
													<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
												</li>
												<li>
													<a href="#" target="_blank"><i class="fab fa-dribbble"></i> </a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-menu">
									<h2 class="footer-title">For Patients</h2>
									<ul>
										<li><a href="search.html"><i class="fas fa-angle-double-right"></i> Search for Doctors</a></li>
										<li><a href="{{ route('customer.login') }}"><i class="fas fa-angle-double-right"></i> Login</a></li>
										<li><a href="register.html"><i class="fas fa-angle-double-right"></i> Register</a></li>
										<li><a href="booking.html"><i class="fas fa-angle-double-right"></i> Booking</a></li>
										<li><a href="patient-dashboard.html"><i class="fas fa-angle-double-right"></i> Patient Dashboard</a></li>
									</ul>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-menu">
									<h2 class="footer-title">For Doctors</h2>
									<ul>
										<li><a href="appointments.html"><i class="fas fa-angle-double-right"></i> Appointments</a></li>
										<li><a href="chat.html"><i class="fas fa-angle-double-right"></i> Chat</a></li>
										<li><a href="{{ route('customer.login') }}"><i class="fas fa-angle-double-right"></i> Login</a></li>
										<li><a href="doctor-register.html"><i class="fas fa-angle-double-right"></i> Register</a></li>
										<li><a href="doctor-dashboard.html"><i class="fas fa-angle-double-right"></i> Doctor Dashboard</a></li>
									</ul>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-contact">
									<h2 class="footer-title">Contact Us</h2>
									<div class="footer-contact-info">
										<div class="footer-address">
											<span><i class="fas fa-map-marker-alt"></i></span>
											<p> 3556  Beech Street, San Francisco,<br> California, CA 94108 </p>
										</div>
										<p>
											<i class="fas fa-phone-alt"></i>
											+1 315 369 5943
										</p>
										<p class="mb-0">
											<i class="fas fa-envelope"></i>
											doccure@example.com
										</p>
									</div>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- /Footer Top -->
				
				<!-- Footer Bottom -->
                <div class="footer-bottom">
					<div class="container-fluid">
					
						<!-- Copyright -->
						<div class="copyright">
							<div class="row">
								<div class="col-md-6 col-lg-6">
									<div class="copyright-text">
										<p class="mb-0"><a href="templateshub.net">Templates Hub</a></p>
									</div>
								</div>
								<div class="col-md-6 col-lg-6">
								
									<!-- Copyright Menu -->
									<div class="copyright-menu">
										<ul class="policy-menu">
											<li><a href="term-condition.html">Terms and Conditions</a></li>
											<li><a href="privacy-policy.html">Policy</a></li>
										</ul>
									</div>
									<!-- /Copyright Menu -->
									
								</div>
							</div>
						</div>
						<!-- /Copyright -->
						
					</div>
				</div>
				<!-- /Footer Bottom -->
				
			</footer>
			<!-- /Footer -->
		   
	   </div>
	   <!-- /Main Wrapper -->
		<!-- Bootstrap Core JS -->
		<script src="{{ asset('customer/assets/js/popper.min.js') }}"></script>
		<script src="{{ asset('customer/assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Fancybox JS -->
		<script src="{{ asset('customer/assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
		
		<!-- Slick JS -->
		<script src="{{ asset('customer/assets/js/slick.js') }}"></script>
		
		@yield('js')	
		<!-- Custom JS -->
		<script src="{{ asset('customer/assets/js/script.js') }}"></script>
		
	</body>

<!-- doccure/  30 Nov 2019 04:11:53 GMT -->
</html>