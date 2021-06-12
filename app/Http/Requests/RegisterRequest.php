<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'username'              => 'required',
            'telephone'             => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|same:password|min:8',
        ];
    }
    public function messages()
    {
        return [
            'username.required'                 => __('Bạn chưa nhập Họ và tên.'),
            'telephone.required'                => __('Bạn chưa nhập Số điện thoại.'),
            'email.required'                    => __('Bạn chưa nhập Email.'),
            'email.email'                       => __('Email không đúng định dạng'),
            'password.min'                      => __('Mật khẩu phải hơn 8 ký tự.'),
            'password.max'                      => __('Mật khẩu phải không được vượt quá 255 ký tự.'),
            'password.required'                 => __('Mật khẩu là trường bắt buộc'),
        ];
    }
}
