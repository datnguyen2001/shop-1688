<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPostModel;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function indexCate()
    {
        $titlePage = 'Admin | Danh Mục Bài Viết';
        $page_menu = 'post';
        $page_sub = 'category';
        $listData = CategoryPostModel::paginate(20);
        return view('admin.posts.category.index', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
    }

    public function createCate()
    {
        $titlePage = 'Admin | Danh Mục Bài Viết';
        $page_menu = 'post';
        $page_sub = 'category';
        return view('admin.posts.category.create', compact('titlePage', 'page_menu', 'page_sub'));
    }

    public function storeCate(Request $request)
    {
        try {
            $category_name = CategoryPostModel::where('name', $request->name)->first();
            if (isset($category_name)) {
                return \redirect()->back()->with(['error' => 'Tên danh mục đã tồn tại']);
            }

            $category = new CategoryPostModel();
            $category['name'] = $request->get('name');
            $category['slug'] = Str::slug($request->get('name'));
            $category->save();
            return \redirect()->route('admin.category-post.index-cate')->with(['success' => 'Tạo mới danh mục thành công']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function deleteCate($id)
    {
        $category = CategoryPostModel::find($id);
        PostModel::where('category_post_id', $id)->delete();
        $category->delete();
        return \redirect()->route('admin.category-post.index-cate')->with(['success' => 'Xóa danh mục thành công']);
    }

    public function editCate($id)
    {
        $category = CategoryPostModel::find($id);
        $titlePage = 'Admin | Danh Mục Bài Viết';
        $page_menu = 'post';
        $page_sub = 'category';
        return view('admin.posts.category.edit', compact('category', 'titlePage', 'page_menu', 'page_sub'));
    }

    public function updateCate(Request $request, $id)
    {
        try {
            $category = CategoryPostModel::find($id);
            $_category = CategoryPostModel::where('name', $request->name)->first();
            if (isset($_category) && ($category->id != $_category->id)) {
                return \redirect()->back()->with(['error' => 'Tên danh mục đã tồn tại']);
            }

            $category->name = $request->get('name');
            $category->slug = Str::slug($request->get('name'));
            $category->save();
            return \redirect()->route('admin.category-post.index-cate')->with(['success' => 'Cập nhập danh mục thành công']);
        } catch (\Exception $exception) {
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function index(Request $request)
    {
        $titlePage = 'Danh sách bài viết';
        $page_menu = 'post';
        $page_sub = 'blog';
        if (isset($request->key_search)) {
            $listData = PostModel::Where('name', 'like', '%' . $request->get('key_search') . '%')
                ->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $listData = PostModel::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('admin.posts.news.index', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
    }

    public function create()
    {
        $titlePage = 'Bài viết';
        $page_menu = 'post';
        $page_sub = 'blog';
        $category = CategoryPostModel::all();
        return view('admin.posts.news.create', compact('titlePage', 'page_menu', 'page_sub', 'category'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->get('display') == 'on') {
                $display = 1;
            } else {
                $display = 0;
            }
            if ($request->get('is_default') == 'on') {
                $is_default = 1;
            } else {
                $is_default = 0;
            }
            $news = new PostModel();
            $news->name = $request->get('name');
            $news->slug = Str::slug($request->get('name'));
            $news->category_post_id	= $request->get('category_post_id');
            $news->content = $request->get('content');
            $news->is_default = $is_default;
            $news->display = $display;
            $news->save();

            return \redirect()->route('admin.post.index')->with(['success' => 'Thêm bài viết thành công']);

        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    public function delete($id)
    {
        PostModel::where('id', $id)->delete();
        return \redirect()->route('admin.post.index')->with(['success' => 'Xóa bài viết thành công']);
    }

    public function edit($id)
    {
        $news = PostModel::find($id);
        $category = CategoryPostModel::all();
        $titlePage = 'Bài viết';
        $page_menu = 'post';
        $page_sub = 'blog';
        return view('admin.posts.news.edit', compact('news', 'titlePage', 'page_menu', 'page_sub','category'));

    }

    public function update($id, Request $request)
    {
        try {
            $news = PostModel::find($id);
            if (empty($news)) {
                return back()->with(['error' => 'Bài viết không tồn tại']);
            }
            if ($request->get('display') == 'on') {
                $display = 1;
            } else {
                $display = 0;
            }
            if ($request->get('is_default') == 'on') {
                $is_default = 1;
            } else {
                $is_default = 0;
            }
            $news->name = $request->get('name');
            $news->slug = Str::slug($request->get('name'));
            $news->category_post_id = $request->get('category_post_id');
            $news->content = $request->get('content');
            $news->is_default = $is_default;
            $news->display = $display;
            $news->save();
            return \redirect()->route('admin.post.index')->with(['success' => 'Sửa bài viết thành công']);
        } catch (\Exception $exception) {
            return back()->with(['error' => $exception->getMessage()]);
        }
    }
}
