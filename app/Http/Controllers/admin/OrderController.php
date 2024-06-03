<?php

namespace App\Http\Controllers\admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\ProductColorModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function getDataOrder(Request $request, $status)
    {
        try {
            $titlePage = 'Quản lý đơn hàng';
            $page_menu = 'order';
            $page_sub = null;
            $listData = OrderModel::query();
            if ($status !== 'all') {
                $listData = $listData->where('status', $status);
            }
            $key_search = $request->get('search');
            if (isset($key_search)) {
                $listData = $listData->where(function ($query) use ($key_search) {
                    $query->where('name', 'like', '%' . $key_search . '%')
                        ->orWhere('phone', 'like', '%' . $key_search . '%')
                        ->orWhere('code_order', 'LIKE', '%' . $key_search . '%')
                        ->orWhereHas('product', function ($query) use ($key_search) {
                            $query->where('code', 'LIKE', '%' . $key_search . '%');
                        });
                });
            }
            $date_start = $request->get('date_start');
            $date_end = $request->get('date_end');
            if ($date_start && $date_end) {
                $listData = $listData->whereBetween('created_at', [$date_start, $date_end]);
            } elseif ($date_start) {
                $listData = $listData->where('created_at', '>=', $date_start);
            } elseif ($date_end) {
                $listData = $listData->where('created_at', '<=', $date_end);
            }
            $dataExport = $listData->orderBy('created_at', 'desc')->get();
            $listData = $listData->orderBy('created_at', 'desc')->paginate(20);
            foreach ($listData as $item) {
                $item->user = UserModel::find($item->user_id);
                $item->product = ProductModel::find($item->product_id);
                $item->status_name = $this->checkStatusOrder($item);
            }
            $order_all = OrderModel::count();
            $order_pending = OrderModel::where('status', 0)->count();
            $order_confirm = OrderModel::where('status', 1)->count();
            $order_delivery = OrderModel::where('status', 2)->count();
            $order_complete = OrderModel::where('status', 3)->count();
            $order_cancel = OrderModel::where('status', 4)->count();
            $return_refund = OrderModel::where('status', 5)->count();
            if ($request->excel == 2) {
                foreach ($dataExport as $val){
                    $val->user = UserModel::find($val->user_id);
                    $val->product = ProductModel::find($val->product_id);
                }
                return Excel::download(new OrderExport($dataExport), 'donhang.xlsx');
            } else {
                return view('admin.order.index', compact('titlePage', 'page_menu', 'listData', 'page_sub', 'order_pending', 'order_confirm',
                    'order_delivery', 'order_complete', 'order_cancel', 'status', 'order_all', 'return_refund'));
            }
        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    public function orderDetail($order_id)
    {
        try {
            $titlePage = 'Chi tiết đơn hàng';
            $page_menu = 'order';
            $page_sub = null;
            $listData = OrderModel::find($order_id);
            if ($listData) {
                $listData['status_name'] = $this->checkStatusOrder($listData);
                $listData['product'] = ProductModel::find($listData->product_id);
                $listData['product_color'] = ProductColorModel::find($listData->product_color_id);
                $listData['user'] = UserModel::find($listData->user_id);
                return view('admin.order.detail', compact('titlePage', 'page_menu', 'listData', 'page_sub'));
            } else {
                return back()->withErrors(['error' => 'Đơn hàng không tồn tại']);
            }
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function saveNote(Request $request, $id)
    {
        try {
            $order = OrderModel::find($id);
            $order->note2 = $request->get('note2');
            $order->save();
            return back()->with(['success' => 'Ghi chú thành công']);
        } catch (\Exception $exception) {
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function delete($id)
    {
        $product = OrderModel::find($id);
        $product->delete();
        return \redirect()->back()->with(['success' => 'Xóa đơn hàng thành công']);
    }

    public function statusOrder($order_id, $status_id)
    {
        try {
            $order = OrderModel::find($order_id);
            if ($order) {
                $order->status = $status_id;
                $order->save();
                return \redirect()->back()->with(['success' => 'Xét trạng thái đơn hàng thành công']);
            }
        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    public function checkStatusOrder($item)
    {

        if ($item->status == 0) {
            $val_status = 'Chờ xác nhận';
        } elseif ($item->status == 1) {
            $val_status = 'Đã xác nhận';
        } elseif ($item->status == 2) {
            $val_status = 'Đang vận chuyển';
        } elseif ($item->status == 3) {
            $val_status = 'Đã hoàn thành';
        } elseif ($item->status == 4) {
            $val_status = 'Đã hủy';
        } else {
            $val_status = 'Hàng bị thiếu';
        }

        return $val_status;
    }
}
