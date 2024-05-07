<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\CategoryPostModel;
use App\Models\ContactModel;
use App\Models\PostModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $category = CategoryModel::where('parent_id',0)->get();
        $product_category = CategoryModel::where('parent_id',0)->get();
        foreach ($product_category as $item){
            $cate_item = CategoryModel::where('parent_id',$item->id)->pluck('id');
            $item->product = ProductModel::whereIn('category_id',$cate_item->toArray())->orWhere('category_id',$item->id)->where('display',1)->take(12)->get();
        }
        return view('web.home.index',compact('category','product_category'));
    }

    public function blog($slug)
    {
        $category_post = CategoryPostModel::where('slug',$slug)->first();
        $detail_post = PostModel::where('category_post_id',$category_post->id)->where('is_default',1)->where('display',1)->first();
        $post_more = [];
        if (empty($detail_post)){
            $detail_post = PostModel::where('category_post_id',$category_post->id)->where('display',1)->first();
        }
        if ($detail_post){
            $post_more = PostModel::where('category_post_id',$category_post->id)->where('id','!=',$detail_post->id)->where('display',1)->get();
        }

        return view('web.blog.index',compact('detail_post','post_more','category_post'));
    }

    public function detailBlog($slug)
    {
        $detail_post = PostModel::where('slug',$slug)->first();
        $post_more = PostModel::where('category_post_id',$detail_post->category_post_id)->where('id','!=',$detail_post->id)->where('display',1)->get();
        return view('web.blog.detail',compact('detail_post','post_more'));
    }

    public function search(Request $request)
    {
        $category = CategoryModel::where('parent_id',0)->get();
        foreach ($category as $val){
            $val->cate_child = CategoryModel::where('parent_id',$val->id)->get();
        }
        $key_search='';
        $listData = ProductModel::query();
        if (isset($request->key_search)) {
            $key_search = $request->key_search;
            $listData = $listData->where(function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->get('key_search') . '%')
                    ->orWhere('code', 'like', '%' . $request->get('key_search') . '%');
            })
                ->orderBy('created_at', 'desc')
                ->where('display', 1);
        }
        if (isset($request->category_id)) {
            $cate = CategoryModel::find($request->category_id);
            $cate_item = CategoryModel::where('parent_id',$cate->id)->pluck('id')->toArray();
            $listData = $listData->whereIn('category_id',$cate_item)->orWhere('category_id',$cate->id)->where('display',1)->orderBy('created_at','desc');
        }
        $listData = $listData->paginate(28);

        return view('web.search.index',compact('listData','category','key_search'));
    }

    public function category($slug)
    {
        $category = CategoryModel::where('parent_id',0)->get();
        foreach ($category as $val){
            $val->cate_child = CategoryModel::where('parent_id',$val->id)->get();
        }
        $cate = CategoryModel::where('slug',$slug)->first();
        $cate_item = CategoryModel::where('parent_id',$cate->id)->pluck('id')->toArray();
        $product = ProductModel::where('category_id',$cate_item)->orwhere('category_id',$cate->id)->where('display',1)->paginate(28);

        return view('web.category.index',compact('category','product','cate'));
    }

    public function recovery()
    {
        return view('web.recovery');
    }

    public function contact()
    {
        return view('web.contact.index');
    }

    public function saveContact(Request $request)
    {
        $contact = new ContactModel();
        $contact->name = $request->get('fullname');
        $contact->phone = $request->get('phone');
        $contact->content = $request->get('content');
        $contact->type = 1;
        $contact->save();
        return back()->with(['success'=>'Gửi thông tin thành công']);
    }

    public function saveReceiveNewsletter(Request $request)
    {
        $contact = new ContactModel();
        $contact->name = $request->get('fullname');
        $contact->email = $request->get('email');
        $contact->type = 2;
        $contact->save();
        return back()->with(['success'=>'Đăng ký nhận bản tin thành công']);
    }

}
