<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login()
    {
        return view('web.login');
    }

    public function doLogin(Request $request)
    {
        try {
            $arr = [
                'name' => trim($request->get('name')),
                'password' => trim($request->get('password')),
            ];
            $user = UserModel::where('name', $arr['name'])->value('id');
            if (empty($user)) {
                return redirect()->back()->with('error', 'Tài khoản không tồn tại');
            }
            $user_active = UserModel::where('name', $arr['name'])->where('is_active',1)->value('id');
            if (empty($user_active)) {
                return redirect()->back()->with('error', 'Tài khoản của bạn chưa được kích hoạt');
            }
            if (Auth::attempt($arr)) {
                    return redirect()->route('home');
            } else {
                return back()->with(['error' => 'Tài khoản hoặc mật khẩu không đúng']);
            }
        } catch (\Exception $exception) {
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function register()
    {
        return view('web.register');
    }

    public function registered(Request $request)
    {
        $rules = [
            'password' => 'required',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10|max:10',
            'phone_zalo' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10|max:10',
        ];
        $customMessages = [
            'password.required' => 'Vui lòng nhập mật khẩu',
            'phone.required' => 'Vui lòng thêm số điện thoại',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.not_regex' => 'Số điện thoại không hợp lệ',
            'phone.min' => 'Số điện thoại không hợp lệ',
            'phone.max' => 'Số điện thoại không hợp lệ',
            'phone_zalo.required' => 'Vui lòng thêm số điện thoại zalo',
            'phone_zalo.regex' => 'Số điện thoại zalo không hợp lệ',
            'phone_zalo.not_regex' => 'Số điện thoại zalo không hợp lệ',
            'phone_zalo.min' => 'Số điện thoại zalo không hợp lệ',
            'phone_zalo.max' => 'Số điện thoại zalo không hợp lệ',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        }
        $email = UserModel::where('name', $request->get('name'))->first();
        if (isset($email)) {
            return redirect()->back()->with('error', 'Tên tài khoản này đã được đăng ký');
        }
        if ($request->get('password') != $request->get('password_two')) {
            return redirect()->back()->with('error', 'Mật khẩu chưa khớp với nhau');
        }

        $pass = Hash::make($request->get('password'));

        $user = new UserModel();
        $user->name = $request->get('name');
        $user->name_zalo = $request->get('zalofullname');
        $user->phone_zalo = $request->get('phone_zalo');
        $user->password = $pass;
        $user->consignee_name = $request->get('fullname');
        $user->consignee_phone = $request->get('phone');
        $user->consignee_address = $request->get('address');
        $user->is_active = 0;
        $user->save();
        return redirect()->route('register-complete')->with(['success'=>'Đăng ký thành công']);
    }


    public function registerComplete()
    {
        return view('web.register-complete');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
