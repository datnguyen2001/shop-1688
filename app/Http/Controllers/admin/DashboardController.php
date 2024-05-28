<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $titlePage = 'Trang chủ';
        $page_menu = 'Home';
        $page_sub = null;

        $count_order = OrderModel::all()->count();
        $count_product = ProductModel::all()->count();
        $count_user = User::where('is_active',1)->get()->count();
        $count_contact = ContactModel::where('type',1)->get()->count();

        return view('admin.index', compact('titlePage','page_menu','page_sub','count_order','count_product',
        'count_user','count_contact'));
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('userfiles'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('userfiles/'.$fileName);
            $msg = 'Image successfully uploaded';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
