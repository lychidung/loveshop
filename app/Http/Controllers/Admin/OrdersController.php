<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_Details;
use App\Models\ProductItem;
use App\Models\Voucher;
use Inertia\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($searchOrder = null): Response
    {
        if ($searchOrder === null) {
            $orders = DB::table('orders')
                ->select(
                    'orders.*',
                    'customers.name'
                )
                ->join("customers", "customers.id", "=", "orders.id_customer")
                ->latest()
                ->paginate(8);
        } else {
            $orders = DB::table('orders')
                ->latest()
                ->paginate(8);
        }

        return Inertia::render('Admin/Orders/Index', ['Orders' => $orders]);
    }

    public function changeStatus($id, $change): RedirectResponse
    {
        $carbonDateTime = Carbon::now();
        $userId = Auth::id();

        if($change == 0)
        {
            Order::find($id)->update([
                'status' => $change,
                'canceled_at' => $carbonDateTime,
                'id_user' => $userId
            ]);
            return Redirect::route('orders.index');
        }

        if($change == 3)
        {
            Order::find($id)->update([
                'status' => $change,
                'delivery_at' => $carbonDateTime,
                'id_user' => $userId
            ]);
            return Redirect::route('orders.index');
        }

        Order::find($id)->update([
            'status' => $change,
            'id_user' => $userId
        ]);
        return Redirect::route('orders.index');
    }

    public function view($id)
    {
        $orders = DB::table('orders')
            ->where('id', $id)
            ->first();

        $ordersDetails = Order_Details::select(
            'order_details.*',
            'product_variation_sizes.*',
            'product_items.*',
            'products.*',
            'product_colors.*',
            'product_option_sizes.*',
            'orders.*',
            'users.*',
            'customers.*',
            'vouchers.voucher_type',
            'vouchers.value'
        )
            ->where('id_order', $orders->id)
            ->join('product_variation_sizes', 'order_details.id_product_variation_sizes', '=', 'product_variation_sizes.id')
            ->join('product_items', 'product_items.id', '=', 'product_variation_sizes.id_product_item')
            ->join('products', 'products.id', '=', 'product_items.id_product')
            ->join('product_colors', 'product_colors.id', '=', 'product_items.id_color')
            ->join('product_option_sizes', 'product_option_sizes.id', '=', 'product_variation_sizes.id_product_item')
            ->join('orders','orders.id','=','order_details.id_order')
            ->leftJoin('users','users.id','=','orders.id_user')
            ->join('customers','customers.id','=','orders.id_customer')
            ->leftJoin('vouchers','vouchers.id','=','orders.id_voucher')
            ->paginate(7);

        
        return Inertia::render('Admin/Orders/View', ['Orders' => $orders, 'OrderDetails' => $ordersDetails]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
