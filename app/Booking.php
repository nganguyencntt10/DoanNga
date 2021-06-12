<?php

namespace App;
use Carbon\Carbon;
use DB;

class Booking
{
	public $services 	= [];
	public $time 		= '';
	public $date 		= '';
	public $customer_id = null;

	public function __construct($services, $time, $date, $customer_id){
		$this->services 		= $services;
		$this->time 			= $time;
		$this->date 			= $date;
		$this->customer_id 		= $customer_id;
	}
	public function get(){
		$total 		= 0;
		foreach ($this->services as $key => $value) {
			$total += DB::table('services_procedure')->where('id', '=', $value)->first()->prices;
		}
		return [
			'services' 		=> $this->services,
			'time' 			=> $this->time,
			'date' 			=> $this->date,
			'customer_id' 	=> $this->customer_id,
			'total' 		=> $total,
		];
	}

}
