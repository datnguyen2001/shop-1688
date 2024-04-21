<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = UserModel::find(Auth::id());
        return view('web.profile.index',compact('user'));
    }

    public function saveProfile(Request $request)
    {
        $avatar = null;
        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $part = 'upload/images/';
            $avatar = $part.Str::random(40). '.'. $file->getClientOriginalExtension();
            $request->file('avatar')->move($part, $avatar);
        }

        $user = UserModel::find(Auth::id());
        $user->name = $request->get('name');
        $user->name_zalo = $request->get('zalofullname');
        $user->phone_zalo = $request->get('phone_zalo');
        $user->avatar = $avatar;
        $user->consignee_name = $request->get('fullname');
        $user->consignee_phone = $request->get('phone');
        $user->consignee_address = $request->get('address');
        $user->save();
        return back()->with(['success' => 'Cập nhật thông tin thành công']);
    }

    public function password()
    {
        $user = UserModel::find(Auth::id());
        return view('web.profile.password',compact('user'));
    }

    public function savePassword(Request $request)
    {
        if ($request->get('password') != $request->get('password_two')) {
            return redirect()->back()->with('error', 'Mật khẩu chưa khớp với nhau');
        }
        $pass = Hash::make($request->get('password'));
        $user = UserModel::find(Auth::id());
        $user->password = $pass;
        $user->save();
        return back()->with(['success' => 'Thay đổi mật khẩu thành công']);
    }


    public function myOrder(Request $request)
    {
        $user = UserModel::find(Auth::id());
        $query = OrderModel::where('user_id', $user->id);
        if ($request->get('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->get('keyword')) {
            $query->where(function ($query) use ($request) {
                $query->whereHas('product', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->input('keyword') . '%')
                        ->orWhere('code', 'like', '%' . $request->input('keyword') . '%');
                })
                    ->orWhere('code_order', 'like', '%' . $request->input('keyword') . '%');
            });
        }

        $order = $query->orderBy('created_at', 'desc')->paginate(20);
        foreach ($order as $val){
            $val->product = ProductModel::find($val->product_id);
            $val->status_name = $this->checkStatusOrder($val);
        }
        return view('web.profile.my-order',compact('user','order'));
    }

    public function cancelOrder($id)
    {
        $order = OrderModel::find($id);
        if (empty($order)) {
            return back()->with(['error'=>'Đơn hàng không tồn tại']);
        }
        $order->status = 4;
        $order->type = 1;
        $order->save();
        return \redirect()->back()->with(['success' => 'Hủy đơn hàng thành công thành công']);
    }

    public function checkStatusOrder($item)
    {

        if ($item->status == 0) {
            $val_status = 'Chờ xác nhận';
        } elseif ($item->status == 1) {
            $val_status = 'Đã xác nhận';
        } elseif ($item->status == 2) {
            $val_status = 'Đang vận chuyển';
        } elseif ($item->status == 3) {
            $val_status = 'Đã hoàn thành';
        } elseif ($item->status == 4) {
            $val_status = 'Đã hủy';
        } else {
            $val_status = 'Hàng bị thiếu';
        }

        return $val_status;
    }
}
