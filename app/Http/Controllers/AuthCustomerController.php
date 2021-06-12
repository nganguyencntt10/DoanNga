<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\AuthCustomerRepository;
use App\Models\Customer;
use App\Models\CustomerInfo;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class AuthCustomerController extends Controller
{
    protected $customer;
    protected $customer_detail;

    public function __construct(Customer $customer, CustomerInfo $customer_detail){
        $this->customer        = new AuthCustomerRepository($customer);
        $this->customer_detail  = new AuthCustomerRepository($customer_detail);
    }


    public function login(LoginRequest $request){
        // kiểm tra tài khoản đăng nhập
        $customer_id = $this->customer->checkAccount($request->email, $request->password);
        if ($customer_id) {
            $name_cookie = Cookie::queue('_token_', $this->customer->createTokenClient($customer_id), 2628000);
            return redirect()->back()->with('success', 'Đăng nhập thành công');  
        }else{
            return redirect()->back()->with('error', 'Tên tài khoản hoặc mật khẩu không chính xác'); 
        }
    }

    // # đăng xuất
    public function logout(Request $request){
        Cookie::queue(Cookie::forget('_token_'));
        return redirect()->route('customer.login')->with('success', 'Đăng xuất thành công');  
    }
    
    // thực hiện đnăg kí
    public function create(RegisterRequest $request){
        // kiểm tra email đã tồn tại chưa
        if ($this->customer->checkEmail($request->email)) {
            return redirect()->back()->with('error', 'Email đã tồn tại!!!');   
        }else{
            $secret_key     = $this->customer->generateSecretKey();
            $customer = [
                'secret_key'        =>  $secret_key,
                'username'          =>  $request->username,
                'email'             =>  $request->email,
                'password'          =>  Hash::make($request->password),
                'status'            => '1',
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ];
            $customer = $this->customer->create($customer);
            if ($customer) {
                $customer_detail = [
                    'customer_id'       =>  $customer->id,
                    'telephone'         =>  $request->telephone,
                    'name'              =>  $request->username,
                    "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                    "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                ];
                if ($this->customer_detail->create($customer_detail)) {
                    return redirect()->route('customer.login')->with('success', 'Đăng kí thành công !!'); 
                }else{
                    return redirect()->back()->with('error', 'Có lỗi sảy ra !!'); 
                }
            }
        }
    }

}
