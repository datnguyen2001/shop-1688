<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $titlePage = 'Admin | Quản lý người dùng';
        $page_menu = 'user';
        $page_sub = null;
        if (isset($request->key_search)) {
            $listData = UserModel::Where('name', 'like', '%' . $request->get('key_search') . '%')
                ->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $listData = UserModel::orderBy('created_at', 'desc')->paginate(20);
        }

        return view('admin.user.index', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
    }

    public function create()
    {
        $titlePage = 'Admin | Quản lý người dùng';
        $page_menu = 'user';
        $page_sub = null;
        return view('admin.user.create', compact('titlePage', 'page_menu', 'page_sub'));
    }

    public function store(Request $request)
    {
        try {
            $name = UserModel::where('name', $request->name)->first();
            if (isset($name)) {
                return \redirect()->back()->with(['error' => 'Tài khoản này đã tồn tại']);
            }
            $file_name = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $part = 'upload/images/';
                $file_name = $part . Str::random(40) . '.' . $file->getClientOriginalExtension();
                $request->file('file')->move($part, $file_name);
            }
            $pass = Hash::make($request->get('password'));
            $user = new UserModel();
            $user['name'] = $request->get('name');
            $user['password'] = $pass;
            $user['name_zalo'] = $request->get('name_zalo');
            $user['avatar'] = $file_name;
            $user['phone_zalo'] = $request->get('phone_zalo');
            $user['consignee_name'] = $request->get('consignee_name');
            $user['consignee_phone'] = $request->get('consignee_phone');
            $user['consignee_address'] = $request->get('consignee_address');
            $user['is_active'] = 1;
            $user->save();
            return \redirect()->route('admin.user.index')->with(['success' => 'Tạo mới người dùng thành công']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function delete($id)
    {
        $user = UserModel::find($id);
        $user->is_active = 0;
        $user->save();
        return \redirect()->route('admin.user.index')->with(['success' => 'Khóa người dùng thành công']);
    }

    public function edit($id)
    {
        $user = UserModel::find($id);
        $titlePage = 'Admin | Quản lý người dùng';
        $page_menu = 'user';
        $page_sub = null;
        return view('admin.user.edit', compact('user', 'titlePage', 'page_menu', 'page_sub'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = UserModel::find($id);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $part = 'upload/images/';
                $file_name = $part . Str::random(40) . '.' . $file->getClientOriginalExtension();
                $request->file('file')->move($part, $file_name);
                if ($user->avatar) {
                    unlink($user->avatar);
                }
                $user->avatar = $file_name;
            }
            if($request->get('password')){
                $user->password = Hash::make($request->get('password'));
            }
            if ($request->get('is_active') == 'on'){
                $is_active = 0;
            }else{
                $is_active = 1;
            }
            $user->name = $request->get('name');
            $user->name_zalo = $request->get('name_zalo');
            $user->phone_zalo = $request->get('phone_zalo');
            $user->consignee_name = $request->get('consignee_name');
            $user->consignee_phone = $request->get('consignee_phone');
            $user->consignee_address = $request->get('consignee_address');
            $user->is_active = $is_active;
            $user->save();
            return \redirect()->route('admin.user.index')->with(['success' => 'Cập nhập người dùng thành công']);
        } catch (\Exception $exception) {
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function statusActive($id)
    {
        try {
            $user = UserModel::find($id);
            if ($user) {
                $user->is_active = 1;
                $user->save();
                return \redirect()->back()->with(['success' => 'Xét kích hoạt tài khoản thành công']);
            }
        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}
