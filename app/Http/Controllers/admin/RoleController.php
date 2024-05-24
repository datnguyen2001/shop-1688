<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $titlePage = 'Nhân viên hệ thống';
        $page_menu = 'staff';
        $page_sub = null;
        $listData = RoleModel::paginate(10);
        foreach ($listData as $item) {
            $item['user'] = AdminModel::find($item->user_id);
        }
        return view('admin.role.index', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
    }

    public function create()
    {
        $titlePage = 'Thêm nhân viên';
        $page_menu = 'staff';
        $page_sub = null;
        return view('admin.role.create', compact('titlePage', 'page_menu', 'page_sub'));
    }


    public function store(Request $request)
    {
        try {
            if (empty($request->arr)) {
                return back()->with('error', 'Lựa chọn ít nhất 1 quyền truy cập!');
            }
            $arr = $request->arr;
            $arr = json_encode(array_keys($arr));
            $user = new AdminModel();
            $user->name = $request->name ?? '';
            $user->phone = $request->phone ?? 0;
            $user->password = bcrypt($request->password);

            $user->save();
            $role = new RoleModel();
            $role->user_id = $user->id;
            $role->arr_role = $arr;
            $role->save();

            return \redirect()->route('admin.role.index')->with(['success' => 'Thêm thành công']);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function edit($id)
    {
        $titlePage = 'Sửa nhân viên';
        $page_menu = 'staff';
        $page_sub = null;
        $data = AdminModel::find($id);
        $role = RoleModel::where('user_id', $id)->first();
        $arr = [];
        if ($role) {
            $arr = json_decode($role->arr_role);
        }

        return view('admin.role.edit', compact('titlePage', 'page_menu', 'page_sub', 'data', 'role', 'arr'));
    }

    public function update(Request $request, $id)
    {
        try {
            if (empty($request->arr)) {
                return back()->with('error', 'Lựa chọn ít nhất 1 quyền truy cập!');
            }
            $arr = $request->arr;
            $arr = json_encode(array_keys($arr));
            $user = AdminModel::find($id);
            $user->name = $request->name ?? '';
            $user->phone = $request->phone ?? 0;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            $role = RoleModel::where('user_id', $id)->first();
            $role->arr_role = $arr;
            $role->save();

            return \redirect()->route('admin.role.index')->with(['success' => 'Sửa thành công']);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $user = AdminModel::find($id);
            $user->delete();
            $rule = RoleModel::where('user_id', $id)->first();
            $rule->delete();

            return \redirect()->route('admin.role.index')->with(['success' => 'Xoá thành công']);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
