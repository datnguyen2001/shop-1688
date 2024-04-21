<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductColorModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $titlePage = 'Admin | Danh Mục Sản Phẩm';
        $page_menu = 'category-product';
        $page_sub = 'category';
        $listData = CategoryModel::paginate(20);
        foreach ($listData as $item) {
            $category = CategoryModel::find($item->parent_id);
            $item->category_parent = $category->name ?? 'Là danh mục cha';
        }
        return view('admin.category.index', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
    }

    public function create()
    {
        $titlePage = 'Admin | Danh Mục Sản Phẩm';
        $page_menu = 'category-product';
        $page_sub = 'category';
        $category = CategoryModel::where('parent_id', 0)->get();
        return view('admin.category.create', compact('titlePage', 'page_menu', 'page_sub', 'category'));
    }

    public function store(Request $request)
    {
        try {
            $slug = Str::slug($request->get('name'));
            $category_slug = CategoryModel::where('slug', $slug)->first();
            if (isset($category_slug)) {
                return \redirect()->back()->with(['error' => 'Tên danh mục đã tồn tại']);
            }
            $file_name = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $part = 'upload/category/';
                $file_name = $part . Str::random(40) . '.' . $file->getClientOriginalExtension();
                $request->file('file')->move($part, $file_name);
            }
            $category = new CategoryModel();
            $category['name'] = $request->get('name');
            $category['slug'] = $slug;
            $category['src'] = $file_name;
            $category['parent_id'] = $request->get('parent_id');
            $category->save();
            return \redirect()->route('admin.category.index')->with(['success' => 'Tạo mới danh mục thành công']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function delete($id)
    {
        $category = CategoryModel::find($id);
        if ($category->src) {
            unlink($category->src);
        }
        $product = ProductModel::where('category_id',$id)->get();
        foreach ($product as $products){
            if ($products->src) {
                unlink($products->src);
            }
            $product_color = ProductColorModel::where('product_id',$products->id)->get();
            foreach ($product_color as $color){
                if ($color->src) {
                    unlink($color->src);
                }
                $color->delete();
            }
            $product_img = ProductImageModel::where('product_id',$products->id)->get();
            foreach ($product_img as $img){
                if ($img->src) {
                    unlink($img->src);
                }
                $img->delete();
            }
            $products->delete();
        }
        $category->delete();
        return \redirect()->route('admin.category.index')->with(['success' => 'Xóa danh mục thành công']);
    }

    public function edit($id)
    {
        $category = CategoryModel::find($id);
        $titlePage = 'Admin | Danh Mục Sản Phẩm';
        $page_menu = 'category-product';
        $page_sub = 'category';
        $category_all = CategoryModel::where('parent_id', 0)->get();
        return view('admin.category.edit', compact('category', 'titlePage', 'page_menu', 'page_sub', 'category_all'));
    }

    public function update(Request $request, $id)
    {
        try {
            $slug = Str::slug($request->get('name'));
            $category = CategoryModel::find($id);
            $_category = CategoryModel::where('slug', $slug)->first();
            if (isset($_category) && ($category->id != $_category->id)) {
                return \redirect()->back()->with(['error' => 'Tên danh mục đã tồn tại']);
            }
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $part = 'upload/category/';
                $file_name = $part . Str::random(40) . '.' . $file->getClientOriginalExtension();
                $request->file('file')->move($part, $file_name);
                if ($category->src) {
                    unlink($category->src);
                }
                $category->src = $file_name;
            }
            $category->name = $request->get('name');
            $category->slug = $slug;
            $category->parent_id = $request->get('parent_id');
            $category->save();
            return \redirect()->route('admin.category.index')->with(['success' => 'Cập nhập danh mục thành công']);
        } catch (\Exception $exception) {
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function getChildrenC2 (Request $request)
    {
        try{
            $listCategory = CategoryModel::where('parent_id',$request->cate_id)->get();
            $html = null;
            if (count($listCategory)){
                foreach ($listCategory as $value){
                    $option = '<div class="d-flex align-items-center category list_category_children p-1">
                                                <div class="d-flex align-items-center" style="margin-right: 10px"><input type="radio" id="'.$value->id.'" style="width: 20px; height: 20px" value="'.$value->id.'" name="'.$request->get('name').'"></div>
                                                <label for="'.$value->id.'" class="m-0">'.$value->name.'</label>
                                            </div>';
                    $html .= $option;
                }
            }
            $data['html'] = $html;
            $data['status'] = true;
            $data['name'] = $request->get('name');
            return $data;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
