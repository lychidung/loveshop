<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_Details;
use App\Models\Product_Variation_Sizes;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customer = auth('api-customer')->user();
        if (isset($customer)) {
            $data  = $request->json()->all();
            $id_product_item = [];
            $price = [];
            $quantity = [];
            $currentDate = Carbon::now()->toDateString();
            $currentTime = Carbon::now()->toTimeString();

            foreach ($data as $item) {
                if (isset($item['id_for_order']) && isset($item['price']) && isset($item['quantity'])) {
                    $id_product_item[] = $item['id_for_order'];
                    $price[] = $item['price'];
                    $quantity[] = $item['quantity'];
                }
            }

            if (!empty($id_product_item) || !empty($price) || !empty($quantity)) {
                if (isset($data[0]['id_voucher'])) {
                    $quantityVoucher = Voucher::select()
                        ->where('id', $data[0]['id_voucher'])
                        ->first();

                    if ($quantityVoucher->quantity <= 0) {
                        return response()->json(["message" => "Voucher đã hết lượt"]);
                    } else {
                        Voucher::find($data[0]['id_voucher'])->decrement('quantity', 1);
                    }
                }

                Order::create([
                    'id_customer' => $customer->id,
                    'full_name' => $data[0]['full_name'],
                    'phone' => $data[0]['phone'],
                    'email' => $data[0]['email'],
                    'address' => $data[0]['address'],
                    'note' => $data[0]['note'],
                    'total_amount' => $data[0]['total_amount'],
                    'date_order' => $currentDate,
                    'time_order' => $currentTime,
                    'canceled_at' => $data[0]['canceled_at'],
                    'delivery_at' => $data[0]['delivery_at'],
                    'payment_method' => $data[0]['payment_method'],
                    'id_voucher' => $data[0]['id_voucher'],
                    'status' => $data[0]['status'],
                ]);


                $latestId = DB::table('orders')->max('id');

                $orderDetailsData = [];

                for ($i = 0; $i < count($id_product_item); $i++) {
                    $orderDetailsData[] = [
                        'id_order' => $latestId,
                        'id_product_variation_sizes' => $id_product_item[$i],
                        'price' => $price[$i],
                        'quantity' => $quantity[$i],
                    ];
                }

                
                Order_Details::insert($orderDetailsData);

                return response()->json(["message" => "Đặt hàng thành công cảm ơn quý khách"]);
            } else {
                return response()->json(["message" => "Vui lòng chọn mặt hàng cần mua"]);
            }
        } else {
            return response()->json(["message" => "Vui lòng đăng nhập"]);
        }
    }


    public function orderList()
    {
        $customer = auth('api-customer')->user();
        if(!isset($customer))
        {
            return response()->json(["message" => "Vui lòng đăng nhập"]);
        }

        $orders = Order::select()
            ->where('id_customer', $customer->id)
            ->get();
        return response()->json($orders);
    }

    public function orderListDetails(Request $request)
    {
        $data  = $request->json()->all();

        $customer = auth('api-customer')->user();
        if(!isset($customer))
        {
            return response()->json(["message" => "Vui lòng đăng nhập"]);
        }

        $ordersDetails = Order_Details::select(
            'order_details.*',
            'product_variation_sizes.*',
            'product_items.*',
            'products.*',
            'product_colors.*',
            'product_option_sizes.*',
            'orders.*',
            'vouchers.voucher_type',
            'vouchers.value'
        )
            ->where('id_order', $data[0]['id_order'])
            ->join('product_variation_sizes', 'order_details.id_product_variation_sizes', '=', 'product_variation_sizes.id')
            ->join('product_items', 'product_items.id', '=', 'product_variation_sizes.id_product_item')
            ->join('products', 'products.id', '=', 'product_items.id_product')
            ->join('product_colors', 'product_colors.id', '=', 'product_items.id_color')
            ->join('product_option_sizes', 'product_option_sizes.id', '=', 'product_variation_sizes.id_product_item')
            ->join('orders','orders.id','=','order_details.id_order')
            ->leftJoin('vouchers','vouchers.id','=','orders.id_voucher')
            ->get();

        return response()->json($ordersDetails);
    }

    public function orderDetails(Request $request)
    {
        $data  = $request->json()->all();

        $customer = auth('api-customer')->user();
        if(!isset($customer))
        {
            return response()->json(["message" => "Vui lòng đăng nhập"]);
        }

        $ordersDetails = Order_Details::select(
            'product_galleries.image',
            'products.product_name',
            'product_colors.color_name',
            'product_option_sizes.size_name',
            'order_details.quantity',
            'order_details.price',
            'orders.total_amount'
        )
            ->where('id_order', $data[0]['id_order'])
            ->join('product_variation_sizes', 'order_details.id_product_variation_sizes', '=', 'product_variation_sizes.id')
            ->join('product_items', 'product_items.id', '=', 'product_variation_sizes.id_product_item')
            ->join('products', 'products.id', '=', 'product_items.id_product')
            ->join('product_colors', 'product_colors.id', '=', 'product_items.id_color')
            ->join('product_option_sizes', 'product_option_sizes.id', '=', 'product_items.id_color')
            ->join('orders','orders.id','=','order_details.id_order')
            ->join('product_galleries','product_galleries.product_item_id','=','product_items.id')
            ->get();

        return response()->json($ordersDetails);
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
        //
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
