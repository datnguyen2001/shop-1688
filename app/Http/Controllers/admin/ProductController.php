<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\OrderModel;
use App\Models\ProductColorModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $titlePage = 'Admin | Danh Sách Sản Phẩm';
        $page_menu = 'product';
        $page_sub = null;
        if (isset($request->key_search)) {
            $listData = ProductModel::where('name', 'like', '%' . $request->get('key_search') . '%')
                ->orWhere('code', 'like', '%' . $request->get('key_search') . '%')
                ->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $listData = ProductModel::orderBy('created_at', 'desc')->paginate(20);
        }
        foreach ($listData as $item) {
            $category = CategoryModel::find($item->category_id);
            $item->category_name = $category->name;
        }
        return view('admin.product.index', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
    }

    public function create()
    {
        $titlePage = 'Admin | Danh Sách Sản Phẩm';
        $page_menu = 'product';
        $page_sub = null;
        $category = CategoryModel::where('parent_id', 0)->get();
        return view('admin.product.create', compact('titlePage', 'page_menu', 'page_sub', 'category'));
    }

    public function store(Request $request)
    {
        try {
            $attribute = $request->variant;
            $category = CategoryModel::find($request->get('category'));
            if (empty($category)) {
                return back()->with(['error' => 'Vui lòng chọn danh mục để tiếp tục']);
            }
            $category_id = $category->id;
            $category2 = CategoryModel::find($request->get('category_children'));
            if (isset($category2)) {
                $category_id = $category2->id;
            }
            if (!$request->hasFile('file_product')) {
                return back()->with(['error' => 'Vui lòng thêm hình ảnh sản phẩm']);
            }
            $display = 0;
            if ($request->get('display') == 'on') {
                $display = 1;
            }
            $file = $request->file('file_product');
            $extension = $file->getClientOriginalExtension();
            $image = 'upload/product/' . Str::random(40) . '.' . $extension;
            $file->move('upload/product/', $image);
            $product = new ProductModel([
                'name' => $request->get('name'),
                'slug' => Str::slug($request->get('name')).'-'.Str::slug($request->get('code')),
                'code' => $request->get('code'),
                'src' => $image,
                'category_id' => $category_id??null,
                'price' => str_replace(",", "", $request->get('price')),
                'content' => $request->get('content'),
                'display' => $display,
            ]);
            $product->save();
            $this->add_img_product($request, $product->id);
            $this->add_and_update_attribute_product($attribute, $product);
            return \redirect()->route('admin.product.index')->with(['success' => 'Tạo mới sản phẩm thành công']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function delete($id)
    {
        $product = ProductModel::find($id);
        if ($product->src) {
            unlink($product->src);
        }
        $product_color = ProductColorModel::where('product_id',$id)->get();
        foreach ($product_color as $color){
            if ($color->src) {
                unlink($color->src);
            }
            $color->delete();
        }
        $product_img = ProductImageModel::where('product_id',$id)->get();
        foreach ($product_img as $img){
            if ($img->src) {
                unlink($img->src);
            }
            $img->delete();
        }
        $order = OrderModel::where('product_id',$product->id)->get();
        foreach ($order as $orders){
            $orders->delete();
        }
        $product->delete();
        return \redirect()->route('admin.product.index')->with(['success' => 'Xóa sản phẩm thành công']);
    }

    public function edit($id)
    {
        $titlePage = 'Admin | Danh Sách Sản Phẩm';
        $page_menu = 'product';
        $page_sub = null;
        $product = ProductModel::find($id);
        $category_all = CategoryModel::where('parent_id', 0)->get();
        $cate_big = CategoryModel::find($product->category_id);
        if ($cate_big->parent_id == 0){
            $category_child = [];
        }else{
            $category_child = CategoryModel::where('parent_id',$cate_big->parent_id)->get();
        }
        $product_color = ProductColorModel::where('product_id',$id)->get();
        $product_img = ProductImageModel::where('product_id',$id)->get();
        return view('admin.product.edit', compact('category_child', 'titlePage', 'page_menu', 'page_sub',
            'category_all','product','product_color','product_img','cate_big'));
    }

    public function update(Request $request, $id)
    {
        try {
            $attribute = $request->variant;
            $product = ProductModel::find($id);
            $category = CategoryModel::find($request->get('category'));
            if (empty($category)) {
                return back()->with(['error' => 'Vui lòng chọn danh mục để tiếp tục']);
            }
            $category_id = $category->id;
            $category2 = CategoryModel::find($request->get('category_children'));
            if (isset($category2)) {
                $category_id = $category2->id;
            }
            $display = 0;
            if ($request->display == 'on') {
                $display = 1;
            }
            if (isset($request->file_product)) {
                unlink($product->src);
                $file = $request->file('file_product');
                $extension = $file->getClientOriginalExtension();
                $image = 'upload/product/' . Str::random(40) . '.' . $extension;
                $file->move('upload/product/', $image);
                $product->src = $image;
            }
            $product->category_id = $category_id??null;
            $product->name = $request->get('name');
            $product->slug = Str::slug($request->get('name')).'-'.Str::slug($request->get('code'));
            $product->code = $request->get('code');
            $product->price = str_replace(",", "", $request->get('price'));
            $product->content = $request->get('content');
            $product->display = $display;

            $product->save();
            $this->add_img_product($request, $product->id);
            $this->add_and_update_attribute_product($attribute, $product);
            return \redirect()->route('admin.product.index')->with(['success' => 'Cập nhập sản phẩm thành công']);
        } catch (\Exception $exception) {
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function deleteImg(Request $request)
    {
        try {
            $img = ProductImageModel::find($request->get('id'));
            unlink($img->src);
            $img->delete();
            $data['status'] = true;
            return $data;
        } catch (\Exception $exception) {
            $data['status'] = false;
            $data['msg'] = $exception->getMessage();
            return $data;
        }
    }

    public function deleteColor($id)
    {
        try {
            $product = ProductColorModel::find($id);
            if (isset($product->src)) {
                unlink($product->src);
            }
            $product->delete();
            return back()->with(['success' => 'Xóa màu sản phẩm thành công']);
        } catch (\Exception $exception) {
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function add_img_product($request, $product_id)
    {
        try {
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                foreach ($file as $value) {
                    $image_name = 'upload/product/' . Str::random(40);
                    $ext = strtolower($value->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $path = 'upload/product';
                    $value->move($path, $image_full_name);
                    $image_invest = new ProductImageModel([
                        'product_id' => $product_id,
                        'src' => $image_full_name,
                    ]);
                    $image_invest->save();
                }
                return true;
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function add_and_update_attribute_product($data_attribute, $product)
    {
        foreach ($data_attribute as $value) {
            $file_name = null;
            if (isset($value['src_color'])) {
                $file = $value['src_color'];
                $part = 'upload/product/';
                $file_name = $part . Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move($part, $file_name);
            }
            if (isset($value['attribute_id'])) {
                $product_color = ProductColorModel::find($value['attribute_id']);
                $product_color->product_id = $product->id;
                $product_color->name = $value['name'];
                $product_color->src = $file_name??$product_color->src;
                $product_color->save();
            } else {
                $product_color = new ProductColorModel([
                    'product_id' => $product->id,
                    'name' => $value['name'],
                    'src' => $file_name,
                ]);
                $product_color->save();
            }
        }
        return true;
    }


    public function variantColor(Request $request)
    {
        $count = $request->get('count');
        $view = view('admin.product.variant-color', compact('count'))->render();
        return \response()->json(['html' => $view, 'count' => $count]);
    }
}
