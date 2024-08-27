<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\KhachHang;
use App\Models\ListenseKey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct() {
    }
    public function activate_system_submit(Request $request){
      
        $listense_key = ListenseKey::where('code', $request->code)->first();

        if (!$listense_key) {
            return response()->json(['status' => 'error', 'message' => 'Listense Key not found']);
        }
        $listense_key->update([
            'url'     => $request->url ?? "",
            'user'    => $request->user ?? "",
            'email'   => $request->email ?? "",
            'product' => $request->product ?? "",
        ]);

        return response()->json(['status' => 'success', 'listense_key' => $listense_key], 200);
    }


    public function check_listense_key(Request $request){
        \Log::info($request->url_path);
        if($request->url_path === $request->url){
           
            $listense_key = ListenseKey::where('code', $request->code)->where('url',$request->url)->first();

            if (!$listense_key) {
                return response()->json(['status' => 'error', 'message' => 'Listense Key not found']);
            }
            return response()->json(['status' => 'success'], 200);
        }
        return response()->json(['status' => 'error', 'message' => 'Listense Key not found']);
    }





    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->email)->first();
                $user->tokens()->delete();
                return response()->json([
                    'status' => 'success',
                    'data' => $user,
                    'authorization' => [
                        'token' => $user->createToken('ApiToken')->plainTextToken,
                        'type' => 'bearer',
                    ]
                ]);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Email & Password does not match with our record.',
            ], 401);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function register(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'ma_phan_quyen' => 1,
            ]);
            $user_info = KhachHang::create([
                'email'=> $user->email,
                'ten_khach_hang' => $user->name,
                'so_dien_thoai' => null,
                'dia_chi'=> null,
                'hinh_anh' => null,
                'ngay_sinh' => null,
                'gplx_nguoi_dung' => null,
                'ma_nguoi_dung'=> $user->id,
                'gioi_tinh' => null,
            ]);
            return  response()->json([
                'status'=>'success',
                'message'=>'success',
                'data'=>$user,
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function userProfile() {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->tokens()->delete();
        return response()->json(['status'=>'success','message'=>'Successfully logged out']);
    }
}
