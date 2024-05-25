<?php

namespace App\Http\Controllers;

use App\Models\Customer;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index($id = null)
    {
        
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Đăng ký thành công',
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (!$token = auth('api-customer')->attempt($validator->validated())) {
            return response()->json(['error' => 'Vui lòng thử đăng nhập lại']);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api-customer')->factory()->getTTL() * 3600
        ]);
    }

    public function profile()
    {
        return response()->json(auth('api-customer')->user());
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api-customer')->refresh());
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Đăng xuất tài khoản thành công.']);
    }

    public function updateProfile(Request $request)
    {
        $customer = auth('api-customer')->user();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|int',
            'birthday' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|int'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender
        ]);

        return response()->json([
            'message' => 'Đăng ký thành công',
            'customer' => $customer
        ]);
    }

    
}
