@extends('customer.layout')
@section('title', 'Lịch sử')
			
@section('body')
	<div class="breadcrumb-bar">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-12 col-12">
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Trang chủ</a></li>
							<li class="breadcrumb-item active" aria-current="page">Trang cá nhân</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Trang cá nhân</h2>
				</div>
			</div>
		</div>
	</div>
	<div class="content" style="transform: none; min-height: 144px;">
		<div class="container-fluid" style="transform: none;">

			<div class="row" style="transform: none;">
				<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
					<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 30px;">
						<div class="card widget-profile pat-widget-profile">
							<div class="card-body">
								<div class="pro-widget-content">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
											<img src="{{ asset($user_info['avatar']) }}" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3><?php echo $user_info['name']?></h3>
											
											<div class="patient-details">
												<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo $user_info['address']?></h5>
											</div>
										</div>
									</div>
								</div>
								<div class="patient-info">
									<ul>
										<li>Số điện thoại <span><?php echo $user_info['telephone']?></span></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<nav class="dashboard-menu">
									<ul>
										<li>
											<a href="{{ route('customer.history') }}">
												<i class="fas fa-columns"></i>
												<span>Lịch sử</span>
											</a>
										</li>
										<li>
											<a href="">
												<i class="fas fa-user-cog"></i>
												<span>Cập nhật thông tin</span>
											</a>
										</li>
										<li>
											<a href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
												<i class="fas fa-sign-out-alt"></i>
												<span>Đăng xuất</span>
											</a>
										</li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
					<div class="card">
						<div class="card-body pt-0">
							<div class="user-tabs">
								<ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">
									<li class="nav-item">
										<a class="nav-link active" href="#pat_appointments" data-toggle="tab">Lịch sử</a>
									</li>
								</ul>
							</div>
							<div class="tab-content">
								
								<!-- Appointment Tab -->
								<div id="pat_appointments" class="tab-pane fade active show">
									<div class="card card-table mb-0">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-center mb-0">
													<thead>
														<tr>
															<th>Dịch vụ đăng kí</th>
															<th>Ngày đặt</th>
															<th>Số tiền </th>
															<th>Trạng thái</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($booking_history as $key => $value): ?>
															<tr>
																<td>
																	<?php foreach (explode(" | ",$value->services_id) as $key => $v): ?>
																		<div class="service_value"><?php echo $v ?></div>
																	<?php endforeach ?>
																	
																</td>
																<td>
																	<?php if ($value->time_set == 1): ?>
																		<span class="badge badge-pill bg-primary-light">Sáng</span>
																	<?php else: ?>
																		<span class="badge badge-pill bg-primary-light">Chiều</span>
																	<?php endif ?>
																	<?php echo $value->time ?>
																</td>
																<td><?php echo number_format($value->prices) ?></td>
																<td>
																	<?php if ($value->status == 0): ?>
																		<span class="badge badge-pill bg-warning-light">Đang chờ</span>
																	<?php elseif ($value->status == 1): ?>
																		<span class="badge badge-pill bg-success-light">Xác nhận</span>
																	<?php elseif ($value->status == 2): ?>
																		<span class="badge badge-pill bg-primary-light">Kết thúc</span>
																	<?php endif ?>
																</td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- /Appointment Tab -->
								
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
@endsection()

@section('js')
<!-- Core JS -->
<script src="{{ asset('assets/js/api.js') }}"></script>
<script src="{{ asset('customer/assets/js/history.js') }}"></script>

@endsection()