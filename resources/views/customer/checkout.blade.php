@extends('customer.layout')
@section('title', 'Thanh toán')
			
@section('body')

<div class="content" style="transform: none; min-height: 144px;">
	<div class="container" style="transform: none;">

		<div class="row" style="transform: none;">
			
			<div class="col-md-5 col-lg-4 theiaStickySidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
			
				<!-- Booking Summary -->
				
				<!-- /Booking Summary -->
				
				<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;"><div class="card booking-card">
					<div class="card-header">
						<h4 class="card-title">Thông tin đặt lịch</h4>
					</div>
					<div class="card-body">
					
						<!-- Booking Doctor Info -->
						<div class="booking-doc-info">
							<a href="" class="booking-doc-img">
								<img src="{{ asset($user_info['avatar']) }}" alt="User Image">
							</a>
							<div class="booking-info">
								<h4><a href=""><?php echo $user_info['name'] ?></a></h4>
								<div class="clinic-details">
									<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?php echo $user_info['telephone'] ?></p>
								</div>
							</div>
						</div>
						<!-- Booking Doctor Info -->
						
						<div class="booking-summary">
							<div class="booking-item-wrap">
								<ul class="booking-date">
									<li>Ngày <span><?php echo $booking_data['date'] ?></span></li>
									<li>Buổi <span><?php echo $booking_data['time'] == 1 ? 'Sáng' : "Chiều" ?></span></li>
								</ul>
								<ul class="booking-fee">
									<?php foreach ($booking_data['services'] as $key => $value): ?>
										<input type="hidden" name="" class="services_id" value="<?php echo $value ?>">
									<?php endforeach ?>
								</ul>
								<div class="booking-total">
									<ul class="booking-total-list">
										<li>
											<span>Tổng</span>
											<span class="total-cost"><?php echo number_format($booking_data['total']) . ' đ'?></span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div><div class="resize-sensor" style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;"><div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;"><div style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 390px; height: 758px;"></div></div><div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;"><div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div></div></div></div></div>

			<div class="col-md-7 col-lg-8">
				<div class="card">
					<div class="card-body">
					
						<!-- Checkout Form -->
						<form action="https://dreamguys.co.in/demo/doccure/booking-success.html">
						
							<div class="payment-widget">
								<h4 class="card-title">Phương thức thanh toán</h4>
								
								<!-- Submit Section -->
								<div class="submit-section mt-4">
									<button type="submit" class="btn btn-primary submit-btn" onclick="event.preventDefault(); document.getElementById('VNPAY').submit();">Đặt cọc 50% với VNPay</button>
								</div>
								<!-- /Submit Section -->
								
							</div>
						</form>
						<!-- /Checkout Form -->
						
					</div>
				</div>
				
			</div>
		</div>

	</div>

</div>

                    
<form id="VNPAY" action="{{ route('customer.create_pay') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection()

@section('js')
<!-- Core JS -->
<script src="{{ asset('assets/js/api.js') }}"></script>
<script src="{{ asset('customer/assets/js/custom.js') }}"></script>

@endsection()


