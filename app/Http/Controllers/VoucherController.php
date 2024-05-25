<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carbonDateTime = Carbon::now();
        $now = Carbon::parse($carbonDateTime)->setTimezone('Asia/Ho_Chi_Minh');
        $vouchers = Voucher::select(
            'id',
            'voucher_name',
            'voucher_code',
            'voucher_type',
            'value',
            'start_date',
            'start_time',
            'end_date',
            'end_time',
            'voucher_min_spend',
            'voucher_max_spend',
            'voucher_use_per_user',
            'quantity',
            'image',
            'status'
        )
            ->where(function ($query) use ($now) {
                $query->where('start_date', '<=', $now) // Start date phải nhỏ hơn hoặc bằng ngày hiện tại
                    ->orWhere(function ($query) use ($now) {
                        $query->where('start_date', '=', $now->toDateString())
                            ->where('start_time', '<=', $now->toTimeString());
                    });
            })
            ->where(function ($query) use ($now) {
                $query->where('end_date', '>=', $now) // End date phải lớn hơn hoặc bằng ngày hiện tại
                    ->orWhere(function ($query) use ($now) {
                        $query->where('end_date', '=', $now->toDateString())
                            ->where('end_time', '>=', $now->toTimeString());
                    });
            })
            ->where('status', 1)
            ->get();
        return response()->json($vouchers);
    }

    public function voucherComingSoon()
    {
        $carbonDateTime = Carbon::now();
        $now = Carbon::parse($carbonDateTime)->setTimezone('Asia/Ho_Chi_Minh');
        $vouchers = Voucher::select(
            'id',
            'voucher_name',
            'voucher_code',
            'voucher_type',
            'value',
            'start_date',
            'start_time',
            'end_date',
            'end_time',
            'voucher_min_spend',
            'voucher_max_spend',
            'voucher_use_per_user',
            'quantity',
            'image',
            'status'
        )
            ->where(function ($query) use ($now) {
                $query->where('start_date', '>=', $now) // Start date phải nhỏ hơn hoặc bằng ngày hiện tại
                    ->orWhere(function ($query) use ($now) {
                        $query->where('start_date', '=', $now->toDateString())
                            ->where('start_time', '>=', $now->toTimeString());
                    });
            })
            ->where(function ($query) use ($now) {
                $query->where('end_date', '>=', $now) // End date phải lớn hơn hoặc bằng ngày hiện tại
                    ->orWhere(function ($query) use ($now) {
                        $query->where('end_date', '=', $now->toDateString())
                            ->where('end_time', '>=', $now->toTimeString());
                    });
            })
            ->where('status', 1)
            ->get();

        $vouchers->transform(function ($voucher) {
            $voucher->voucher_code = "Mã sẽ công bố sau !";
            return $voucher;
        });
        return response()->json($vouchers);
    }

    public function checkVoucher(Request $request)
    {
        $customer = auth('api-customer')->user();
        if (!isset($customer)) {
            return response()->json(["message" => "Vui lòng đăng nhập"]);
        };

        $carbonDateTime = Carbon::now();
        $now = Carbon::parse($carbonDateTime)->setTimezone('Asia/Ho_Chi_Minh');
        $data = $request->json()->all();

        $vouchers = Voucher::select(
            'id',
            'voucher_type',
            'value',
            'voucher_min_spend',
            'voucher_max_spend',
            'voucher_use_per_user',
            'quantity',
        )
            ->where(function ($query) use ($now) {
                $query->where('start_date', '<=', $now) // Start date phải nhỏ hơn hoặc bằng ngày hiện tại
                    ->orWhere(function ($query) use ($now) {
                        $query->where('start_date', '=', $now->toDateString())
                            ->where('start_time', '<=', $now->toTimeString());
                    });
            })
            ->where(function ($query) use ($now) {
                $query->where('end_date', '>=', $now) // End date phải lớn hơn hoặc bằng ngày hiện tại
                    ->orWhere(function ($query) use ($now) {
                        $query->where('end_date', '=', $now->toDateString())
                            ->where('end_time', '>=', $now->toTimeString());
                    });
            })
            ->where('voucher_code', $data[0]['voucher_code'])
            ->where('status', [1, 2])
            ->first();


        if (isset($vouchers)) {
            $orders = Order::select()
                ->where('id_customer', $customer->id)
                ->where('id_voucher', $vouchers->id)
                ->count();
        } else {
            return response()->json(["message" => "Voucher không khả dụng"]);
        }

        if ($vouchers->quantity <= 0) {
            return response()->json(['message' => "Voucher đã hết lượt"]);
        }

        if ($orders >= $vouchers->voucher_use_per_user) {
            return response()->json(["message" => "Bạn đã sử dụng tối đa voucher này"]);
        }

        if ($data[0]['total_amount'] >= $vouchers->voucher_min_spend && $data[0]['total_amount'] <= $vouchers->voucher_max_spend) {
            if ($vouchers->voucher_type == 'fixed_amount') {
                $total_amount = $data[0]['total_amount'] - $vouchers->value;
                if ($total_amount < 0) {
                    $total_amount = 0;
                }
                return response()->json(['id' => $vouchers->id,'total_amount' => $total_amount, 'value_discount' => $vouchers->value,'voucher_type' => $vouchers->voucher_type]);
            } else if ($vouchers->voucher_type == 'percent') {
                $total_amount = $data[0]['total_amount'] -  ($data[0]['total_amount'] * $vouchers->value) / 100;
                return response()->json(['id' => $vouchers->id,'total_amount' => $total_amount,'value_discount' => ($data[0]['total_amount'] * $vouchers->value) / 100, 'percent' => $vouchers->value,'voucher_type' => $vouchers->voucher_type]);
            }
        } else {
            return response()->json(['message' => "Bạn không đủ điều kiện, mã giảm chỉ khả dụng ở đơn hàng từ " . $vouchers->voucher_min_spend . "đ đến " . $vouchers->voucher_max_spend . "đ"]);
        }
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
