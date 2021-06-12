<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Repositories\BookingVipRepository;
use App\Models\Bookingvip;

use Carbon\Carbon;
use Hash;
use DB;

class PaymentController extends Controller
{
    protected $bookingvip;
    //tạo booking online
    public function __construct(Bookingvip $bookingvip){
        $this->bookingvip             = new BookingVipRepository($bookingvip);
    }

    public function create_pay(Request $request){
        

        $booking        =   Session('booking') ? Session::get('booking') : null;
        $booking_data   =   $booking->get();

        session(['url_prev' => '/customer/history']);
        $vnp_TmnCode = "6NE7KUNZ"; //Mã website tại VNPAY 
        $vnp_HashSecret = "USUYDLXTCYCNCTNTVRUCQCJBUIELNVGF"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/return-vnpay";
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = ($booking_data['total'] / 2) * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }
    public function return_pay(Request $request)
    {
        // dd($request);
        $url = session('url_prev','/customer/history');
        if($request->vnp_ResponseCode == "00") {
            
            $booking = Session('booking') ? Session::get('booking') : null;
            if ($booking) {
                $booking_data = $booking->get();
                $service = "";
                foreach ($booking_data['services'] as $key => $value) {
                    $service .= $value . " | ";
                }
                $data = [
                    'customer_id'   => $booking_data['customer_id'],
                    'time_set'      => $booking_data['time'],
                    'time'          => $booking_data['date'],
                    'services_id'   => $service,
                    'prices'        => $booking_data['total'],
                    'status'        => '0',
                ];
                $this->bookingvip->create($data);
                $request->session()->forget('booking');
                return redirect($url)->with('success' ,'Đã thanh toán phí dịch vụ');
            }else{
                return redirect($url)->with('success' ,'Có lỗi sảy ra, vui lòng liên hệ để hoàn tiền');
            }
        }
        session()->forget('url_prev');
        return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
    }
}
