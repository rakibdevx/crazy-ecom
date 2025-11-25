<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Order-view|Order-create|Order-edit|Order-delete|All-order')->only(['index','store']);
        $this->middleware('permission:Order-create')->only(['Order','store']);
        $this->middleware('permission:Order-edit')->only(['Order','update']);
        $this->middleware('permission:Order-delete')->only(['destroy']);
        $this->middleware('permission:Pending-order')->only(['pending']);
        $this->middleware('permission:Processing-order')->only(['processing']);
        $this->middleware('permission:Shipped-order')->only(['shipped']);
        $this->middleware('permission:Delivered-order')->only(['delivered']);
        $this->middleware('permission:Cancelled-order')->only(['cancelled']);
        $this->middleware('permission:Ceturned-order')->only(['ceturned']);

    }


    public function index()
    {

        $query = Order::select('id','order_number','user_id','grand_total','order_status','payment_status','placed_at')->latest();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%');
            });
        }


        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function($order) {
                    $user = $order->user;
                    $image = asset(optional($user)->profile_image ?? setting('default_profile_image'));

                    if ($user) {
                        $link = route('admin.user.show', $user->id);
                        return '
                            <a class="d-flex align-items-center gap-3" href="'.$link.'">
                                <div class="customer-pic">
                                    <img src="'.$image.'" class="rounded-circle" width="40" height="40" alt="'.optional($user)->name.'">
                                </div>
                                <p class="mb-0 customer-name fw-bold">'.$user->name.'</p>
                            </a>
                        ';
                    }

                    return '-';
                })
                ->addColumn('order_number', function($order) {
                    return '<a href="' . route('admin.order.show', $order->id) . '" class="fw-bold">' . $order->order_number . '</a>';
                })

                ->addColumn('status', function($order){

                    $labels = [
                        'pending'   => 'bg-warning-subtle text-warning border-warning-subtle',
                        'processing'=> 'bg-info-subtle text-info border-info-subtle',
                        'shipped'   => 'bg-primary-subtle text-primary border-primary-subtle',
                        'delivered' => 'bg-success-subtle text-success border-success-subtle',
                        'cancelled' => 'bg-danger-subtle text-danger border-danger-subtle',
                        'returned'  => 'bg-dark-subtle text-dark border-dark-subtle',
                    ];

                    $labelClass = $labels[$order->order_status] ?? 'bg-secondary';

                    return '<span class="lable-table '.$labelClass.' rounded border font-text2 fw-bold">'
                            . $order->order_status .
                        '</span>';
                })
                ->addColumn('payment_status', function($order) {
                    $status = $order->payment_status;

                    $badgeClass = match($status) {
                        'paid' => 'badge bg-success',
                        'pending' => 'badge bg-warning',
                        'failed' => 'badge bg-danger',
                        'refunded' => 'badge bg-info',
                        default => 'badge bg-secondary',
                    };

                    return '<span class="'.$badgeClass.' text-capitalize">'.$status.'</span>';
                })
                ->addColumn('placed_at', function($order){
                    return format_date($order->placed_at) ?? '-';
                })
                ->addColumn('action', function($order) {
                    $show = route('admin.order.show', $order->id);
                    $edit = route('admin.order.edit', $order->id);
                    $deleteUrl = route('admin.order.destroy', $order->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';
                        if (auth('admin')->user()->can('order-view')) {
                            $action .= '<a href="'.$show.'" class="btn m-1 btn-success btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Show Details">
                                <i class="material-icons-outlined">visibility</i>
                            </a>';
                        }
                        if (auth('admin')->user()->can('order-edit')) {
                        $action .= '<a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                            <i class="material-icons-outlined">settings</i>
                        </a>';
                        }
                        if (auth('admin')->user()->can('order-delete')) {
                        $action .= '<button onclick="deleterder(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                            <i class="material-icons-outlined">delete</i>
                        </button>';
                        }
                    $action .= '</div>';
                    return $action;
                })
                ->rawColumns(['action','name','status','payment_status','order_number'])
                ->make(true);
        }

        $total = (clone $query)->count();
        $pending = (clone $query)->where('order_status', 'pending')->count();
        $delivered = (clone $query)->where('order_status', 'delivered')->count();


        return view('backend.admin.order.index',compact([
            'total','pending','delivered'
        ]));
    }
}


