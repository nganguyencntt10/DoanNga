<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\BookingVipRepository;
use App\Models\Bookingvip;

use App\Booking;

use Carbon\Carbon;
use Session;
use Hash;
use DB;

class BookingvipController extends Controller
{
    protected $bookingvip;

    public function __construct(Bookingvip $bookingvip){
        $this->bookingvip           = new BookingVipRepository($bookingvip);
    }

    public function index(){
        return view ('admin.bookingvip.index');
    }


    // 
    public function getAll(){
        return $this->bookingvip->getAllBooking();
    }

}
