@extends('customer.layout')
@section('title', 'Đặt lịch')
			
@section('css')
<link rel="stylesheet" href="{{ asset('customer/assets/css/main.css') }}">
@endsection()

@section('body')
<div class="content" style="min-height: 144px;">
	<div class="container">
		<form class="row" id="booking-create"  action="{{ route('customer.booking') }}"  method="POST">
			@csrf
			<div class="col-12">
				<div class="card">
					<div class="card-body required">
						<?php foreach ($services as $key => $value): ?>
							<div class="form-group">
								<label for="" class="barge mb-3"><?php echo $value->name ?></label>
								<div class="row">
									<?php foreach ($value->services_procedure as $key => $v): ?>
										<div class="col-xs-12 xol-sm-6 col-md-4 col-lg-3 mb-4">
											<label><input type="checkbox" class="mr-3" name="services[]" value="<?php echo $v->id ?>"><?php echo $v->name ?></label>
											<div>Giá dịch vụ : <?php echo number_format($v->prices) . ' đ' ?></div>
										</div>
									<?php endforeach ?>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="time_error"></div>
						<input type="text" class="form-control center date" readonly="" name="date" value="">
						<input type="hidden" class="form-control center time" readonly="" name="time" value="1">
						<div class="row">
							<div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6">
								<div class="hbContainer">
					                <div class="calendarYearMonth center">
					                    <p class="left calBtn" onclick="prevMonth()"> Prev </p>
					                    <p id="yearMonth"> Jan 2021 </p>
					                    <p class="right calBtn" onclick="nextMonth()"> Next </p>
					                </div>
					                <div>
					                    <ol class="calendarList1">
					                        <li class="day-name">Sat</li>
					                        <li class="day-name">Sun</li>
					                        <li class="day-name">Mon</li>
					                        <li class="day-name">Tue</li>
					                        <li class="day-name">Wed</li>
					                        <li class="day-name">Thu</li>
					                        <li class="day-name">Fri</li>
					                    </ol>
					                    <ol class="calendarList2" id="calendarList">

					                    </ol>
					                </div>
					            </div>
							</div>
							<div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<div class="card">
										<div class="card-body">
											<button type="button" class="btn time-action btn-success" atr="1">Buổi Sáng</button>
											<button type="button" class="btn time-action " atr="2">Buổi Chiều</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="services_error"></div>
						<button type="button" class="btn btn-success booking-create">Đặt lịch</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection()


@section('js')
	<script src="{{ asset('customer/assets/js/calendar.js') }}"></script>
@endsection()