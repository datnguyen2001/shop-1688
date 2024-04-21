<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SupportStaffModel;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $titlePage = 'Admin | Hỗ trợ trực tuyến';
        $page_menu = 'support-staff';
        $page_sub = null;
        $listData = SupportStaffModel::paginate(20);
        return view('admin.support.index', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
    }

    public function create()
    {
        $titlePage = 'Admin | Hỗ trợ trực tuyến';
        $page_menu = 'support-staff';
        $page_sub = null;
        return view('admin.support.create', compact('titlePage', 'page_menu', 'page_sub'));
    }

    public function store(Request $request)
    {
        try {
            $support = new SupportStaffModel();
            $support['name'] = $request->get('name');
            $support['facebook'] = $request->get('facebook');
            $support['phone'] = $request->get('phone');
            $support->save();
            return \redirect()->route('admin.support-staff.index')->with(['success' => 'Tạo mới dữ liệu thành công']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function delete($id)
    {
        $support = SupportStaffModel::find($id);
        $support->delete();
        return \redirect()->route('admin.support-staff.index')->with(['success' => 'Xóa dữ liệu thành công']);
    }

    public function edit($id)
    {
        $support = SupportStaffModel::find($id);
        $titlePage = 'Admin | Hỗ trợ trực tuyến';
        $page_menu = 'support-staff';
        $page_sub = null;
        return view('admin.support.edit', compact('support', 'titlePage', 'page_menu', 'page_sub'));
    }

    public function update(Request $request, $id)
    {
        try {
            $support = SupportStaffModel::find($id);
            $support->name = $request->get('name');
            $support->facebook = $request->get('facebook');
            $support->phone = $request->get('phone');
            $support->save();
            return \redirect()->route('admin.support-staff.index')->with(['success' => 'Cập nhập dữ liệu thành công']);
        } catch (\Exception $exception) {
            return back()->with(['error' => $exception->getMessage()]);
        }
    }
}
