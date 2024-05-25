<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
require_once("config.php");

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = DB::table('customers')
            ->paginate(5);
        return Inertia::render('Admin/Customers/Index', ['Customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Customers/Create');

    }

    public function lock($id)
    {
        $customer = Customer::find($id);

        $newStatus = $customer->status == 1 ? 0 : 1;
        Customer::find($id)->update([
            'status' => $newStatus,
        ]);
        return Redirect::route('customers.index');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path(path), $fileName);


        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'point' => $request->point,
            'status' => $request->status,
            'image' => $fileName,
            'phone' => $request->phone,

        ]);

        return Redirect::route('customers.index');


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
