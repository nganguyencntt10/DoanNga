<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\ServicesRepository;
use App\Models\Services;

use App\Repositories\CustomerRepository;
use App\Models\Customer;

use App\Repositories\BookingVipRepository;
use App\Models\Bookingvip;

use App\Booking;

use Carbon\Carbon;
use Session;
use Hash;
use DB;

class DisplayCustomerController extends Controller
{
    protected $customer;
    protected $services;
    protected $bookingvip;

    public function __construct(Customer $customer, Services $services, Bookingvip $bookingvip){
        $this->customer        		= new CustomerRepository($customer);
        $this->services             = new ServicesRepository($services);
        $this->bookingvip           = new BookingVipRepository($bookingvip);
    }
	public function index(Request $request){
		$user_info = null;
		$token = $request->cookie('_token_');
		if ($token) {
	        list($user_id, $token) = explode('$', $token, 2);
	        $user_info = $this->customer->getInfo($user_id);
		}

		$services = $this->services->getAll();
		return view('customer.index', compact('services', 'user_info'));
	}
	public function services(Request $request){
		$user_info = null;
		$token = $request->cookie('_token_');
		if ($token) {
	        list($user_id, $token) = explode('$', $token, 2);
	        $user_info = $this->customer->getInfo($user_id);
		}

		$services = $this->services->getAllWith();
		return view('customer.services', compact('services', 'user_info'));
	}
	public function service(Request $request, $slug){
		$user_info = null;
		$token = $request->cookie('_token_');
		if ($token) {
	        list($user_id, $token) = explode('$', $token, 2);
	        $user_info = $this->customer->getInfo($user_id);
		}

		$service 	= $this->services->getAllOfWith($slug);
		$image_list = explode(" | ", $service->images);
		$prices 	= $this->services->getPrices($service->id);

		return view('customer.service', compact('service', 'image_list', 'prices', 'user_info'));
	}


	public function history(Request $request){
		// l???y ra th??ng tin ng?????i d??ng
		$user_info = null;
		$token = $request->cookie('_token_');
		if ($token) {
	        list($user_id, $token) = explode('$', $token, 2);
	        $user_info = $this->customer->getInfo($user_id);
		}
		$booking_history = $this->bookingvip->getHistory($user_id);

		return view('customer.history', compact('user_info', 'booking_history'));
	}

	public function booking(Request $request){
		// l???y ra th??ng tin ng?????i d??ng
		$user_info = null;
		$token = $request->cookie('_token_');
		if ($token) {
	        list($user_id, $token) = explode('$', $token, 2);
	        $user_info = $this->customer->getInfo($user_id);
		}


		$services = $this->services->getAllWith();

		return view('customer.booking', compact('user_info', 'services'));
	}

	// l??u ?????t l???ch v??o session
	public function booking_store(Request $request){
		// l???y ra th??ng tin ng?????i d??ng
		$user_info = null;
		$token = $request->cookie('_token_');
		if ($token) {
	        list($user_id, $token) = explode('$', $token, 2);
	        $user_info = $this->customer->getInfo($user_id);
		}
		// t???o session
		$booking       = new Booking($request->services, $request->time, $request->date, $user_id);
        $request->session()->put('booking', $booking);

        // tr??? v??? tgrang thanh to??n
        return redirect()->route('customer.checkout');
	}
	// ch???t ????n
	public function checkout(Request $request){
		// l???y ra th??ng tin ng?????i d??ng
		$user_info = null;
		$token = $request->cookie('_token_');
		if ($token) {
	        list($user_id, $token) = explode('$', $token, 2);
	        $user_info = $this->customer->getInfo($user_id);
		}
        $booking    	=   Session('booking') ? Session::get('booking') : null;
        $booking_data 	= 	$booking->get();
        if ($booking) {
        	return view('customer.checkout', compact('user_info', 'booking_data'));
        }else{
        	return redirect()->route('customer.index');
        }
	}

	public function login(Request $request){
		// l???y ra th??ng tin ng?????i d??ng
		$user_info = null;
		$token = $request->cookie('_token_');
		if ($token) {
	        list($user_id, $token) = explode('$', $token, 2);
	        $user_info = $this->customer->getInfo($user_id);
		}

		return view('customer.login', compact('user_info'));
	}
	public function register(Request $request){
		// l???y ra th??ng tin ng?????i d??ng
		$user_info = null;
		$token = $request->cookie('_token_');
		if ($token) {
	        list($user_id, $token) = explode('$', $token, 2);
	        $user_info = $this->customer->getInfo($user_id);
		}

		return view('customer.register', compact('user_info'));
	}


}
