<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\OrderModel;
use App\Models\ProductColorModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function detailProduct($slug)
    {
        $user = Auth::user();
        $category = CategoryModel::where('parent_id',0)->get();
        foreach ($category as $val){
            $val->cate_child = CategoryModel::where('parent_id',$val->id)->get();
        }
        $product = ProductModel::where('slug',$slug)->first();
        $product_image = ProductImageModel::where('product_id',$product->id)->get();
        $product_color = ProductColorModel::where('product_id',$product->id)->get();
        $product_more = ProductModel::where('category_id',$product->category_id)->where('id','!=',$product->id)->where('display',1)->take(8)->get();
//        $viewItemsJson = Cookie::get('viewItemProduct', []);
        $viewItemsJson = Cookie::has('viewItemProduct') ? Cookie::get('viewItemProduct') : '[]';
        $viewItemProduct = json_decode($viewItemsJson, true);
        if (!in_array($product->id, $viewItemProduct)) {
            $viewItemProduct[] = $product->id;
            array_unshift($viewItemProduct, $product->id);
            $cartItemsJson = json_encode($viewItemProduct);
            Cookie::queue('viewItemProduct', $cartItemsJson, 60 * 24 * 30);
        }
        $product_viewed = ProductModel::whereIn('id',$viewItemProduct)->paginate(24);

        return view('web.product.index',compact('product','category','product_more','user','product_image',
            'product_color','product_viewed'));
    }

    public function saveOrder(Request $request)
    {
        $user = Auth::user();
        if (!$user->consignee_name || !$user->consignee_phone || !$user->consignee_address){
            return back()->with(['error'=>'Vui lòng cập nhật địa chỉ trước khi đặt hàng']);
        }
        $order = new OrderModel();
        $order->code_order = '#'.rand(0, 99999).$order->id;
        $order->name = $user->consignee_name;
        $order->phone = $user->consignee_phone;
        $order->address = $user->consignee_address;
        $order->user_id = $user->id;
        $order->product_id = $request->product_id;
        $order->product_color_id = $request->color_id;
        $order->note1 = $request->note1;
        $order->status = 0;
        $order->type = 0;
        $order->save();
        return back()->with(['success'=>'Tạo đơn hàng thành công']);
    }
}
