<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index($id = null)
    {
        if ($id = null)
        {
            return User::orderby('name', 'ASC')->get();
        } else {
            return User::find($id);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $user = User::create([
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
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        if(!$token = auth('api')->attempt($validator->validated()))
        {
            return response()->json(['error'=>'Vui lòng thử đăng nhập lại']);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){
        
        return response()->json([
            'access_token'=> $token,
            'token_type'=> 'bearer',
            'expires_in'=> auth('api')->factory()->getTTL()*60
        ]);
    }
    
    public function profile(){
        return response()->json(auth('api')->user());
    }

    public function refresh(){
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['message'=>'Đăng xuất tài khoản thành công.']);
        
    }

}
