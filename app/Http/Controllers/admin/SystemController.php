<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use App\Models\SystemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SystemController extends Controller
{
    public function index()
    {
        $titlePage = 'Hệ thống';
        $page_menu = 'system';
        $page_sub = null;
        $data = SystemModel::first();
        return view('admin.system.index', compact('titlePage', 'page_menu', 'data', 'page_sub'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->system_id){
                $system = SystemModel::find($request->system_id);
            }else{
                $system = new SystemModel();
            }
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $part = 'upload/images/';
                $file_name = $part . Str::random(40) . '.' . $file->getClientOriginalExtension();
                $request->file('file')->move($part, $file_name);
                if ($system->logo) {
                    unlink($system->logo);
                }
                $system->logo = $file_name;
            }

            $system->brand_name = $request->get('brand_name');
            $system->company_name = $request->get('company_name');
            $system->address = $request->get('address');
            $system->phone = $request->get('phone');
            $system->email = $request->get('email');
            $system->website = $request->get('website');
            $system->facebook = $request->get('facebook');
            $system->zalo = $request->get('zalo');
            $system->youtube = $request->get('youtube');
            $system->twitter = $request->get('twitter');
            $system->save();

            return \redirect()->route('admin.system.index')->with(['success' => 'Cập nhật dữ liệu thành công']);

        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    public function contact(Request $request)
    {
        $titlePage = 'Danh sách liên hệ';
        $page_menu = 'contact';
        $page_sub = 'list-contact';
        if (isset($request->key_search)) {
            $listData = ContactModel::Where('name', 'like', '%' . $request->get('key_search') . '%')->where('type',1)
                ->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $listData = ContactModel::where('type',1)->orderBy('created_at', 'desc')->paginate(20);
        }
        return view('admin.contact.index', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
    }

    public function contactDetail($id)
    {
        $contact = ContactModel::find($id);
        $titlePage = 'Danh sách liên hệ';
        $page_menu = 'contact';
        $page_sub = 'list-contact';
        return view('admin.contact.detail', compact('contact', 'titlePage', 'page_menu', 'page_sub'));
    }

    public function contactDelete($id)
    {
        $contact = ContactModel::find($id);
        $contact->delete();
        return \redirect()->route('admin.contact')->with(['success' => 'Xóa dữ liệu thành công']);
    }

    public function contactNewsletter(Request $request)
    {
        $titlePage = 'Danh sách đăng ký nhận bản tin';
        $page_menu = 'contact';
        $page_sub = 'contact-newsletter';
        if (isset($request->key_search)) {
            $listData = ContactModel::Where('name', 'like', '%' . $request->get('key_search') . '%')->where('type',2)
                ->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $listData = ContactModel::where('type',2)->orderBy('created_at', 'desc')->paginate(20);
        }
        return view('admin.contact.newletter', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
    }

    public function contactNewsletterDelete($id)
    {
        $contact = ContactModel::find($id);
        $contact->delete();
        return \redirect()->route('admin.contact-newsletter')->with(['success' => 'Xóa dữ liệu thành công']);
    }
}
