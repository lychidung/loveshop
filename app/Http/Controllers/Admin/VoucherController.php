<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

require_once("config.php");

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($searchVoucher = null)
    {
        if ($searchVoucher === null) {
            $vouchers = DB::table('vouchers')
                ->latest()
                ->paginate(7);
        } else {
            $vouchers = DB::table('vouchers')
                ->where('voucher_name', 'like', '%' . $searchVoucher . '%')
                ->latest()
                ->paginate(7);
        };

        return Inertia::render('Admin/Vouchers/Index', ['Vouchers' => $vouchers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Vouchers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'voucher_name' => ['required'],
            'voucher_code' => ['required'],
            'voucher_type' => ['required'],
            'value' => ['required'],
            'start_date' => ['required'],
            'start_time' => ['required'],
            'end_date' => ['required'],
            'end_time' => ['required'],
            'voucher_min_spend' => ['required'],
            'voucher_max_spend' => ['required'],
            'voucher_use_per_user' => ['required'],
            'quantity' => ['required'],
            'image' => ['required'],
            'status' => ['required']
        ])->validate();

        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path(path_voucher), $fileName);

        Voucher::create([
            'voucher_name' => $request->voucher_name,
            'voucher_code' => $request->voucher_code,
            'voucher_type' => $request->voucher_type,
            'value' => $request->value,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'voucher_min_spend' => $request->voucher_min_spend,
            'voucher_max_spend' => $request->voucher_max_spend,
            'voucher_use_per_user' => $request->voucher_use_per_user,
            'quantity' => $request->quantity,
            'image' => $fileName,
            'status' => $request->status,
        ]);

        return Redirect::route('vouchers.index');
        
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
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            // 'voucher_name' => ['required'],
            // 'voucher_code' => ['required'],
            // 'voucher_type' => ['required'],
            // 'value' => ['required'],
            // 'start_date' => ['required'],
            // 'start_time' => ['required'],
            // 'end_date' => ['required'],
            // 'end_time' => ['required'],
            // 'voucher_min_spend' => ['required'],
            // 'voucher_max_spend' => ['required'],
            // 'voucher_use_per_user' => ['required'],
            // 'quantity' => ['required'],
            // 'image' => ['required'],
            // 'status' => ['required']
        ])->validate();

        $image = DB::table('vouchers')
            ->select('image')
            ->where('id', $id)
            ->first();

        if ($request->image) {

            File::delete(public_path(path_delete_voucher . $image->image));

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path(path_voucher), $fileName);

            Voucher::find($id)->update([
                'voucher_name' => $request->voucher_name,
                'voucher_code' => $request->voucher_code,
                'voucher_type' => $request->voucher_type,
                'value' => $request->value,
                'start_date' => $request->start_date,
                'start_time' => $request->start_time,
                'end_date' => $request->end_date,
                'end_time' => $request->end_time,
                'voucher_min_spend' => $request->voucher_min_spend,
                'voucher_max_spend' => $request->voucher_max_spend,
                'voucher_use_per_user' => $request->voucher_use_per_user,
                'quantity' => $request->quantity,
                'image' => $fileName,
                'status' => $request->status
            ]);
        } else {
            Voucher::find($id)->update([
                'voucher_name' => $request->voucher_name,
                'voucher_code' => $request->voucher_code,
                'voucher_type' => $request->voucher_type,
                'value' => $request->value,
                'start_date' => $request->start_date,
                'start_time' => $request->start_time,
                'end_date' => $request->end_date,
                'end_time' => $request->end_time,
                'voucher_min_spend' => $request->voucher_min_spend,
                'voucher_max_spend' => $request->voucher_max_spend,
                'voucher_use_per_user' => $request->voucher_use_per_user,
                'quantity' => $request->quantity,
                'status' => $request->status
            ]);
        }



        return Redirect::route('vouchers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $image = DB::table('vouchers')
                ->select('image')
                ->where('id', $id)
                ->first();

            File::delete(public_path(path_delete_voucher . $image->image));

            DB::table('vouchers')
                ->where('id', $id)
                ->delete();
        } catch (\Exception $e) {
            DB::rollBack();
        }


        return Redirect::route('vouchers.index');
    }

    public function view($id)
    {
        return Redirect::route('vouchers.index');
    }
}
