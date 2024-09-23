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
    public function __construct() {}
    public function activate_system_submit(Request $request)
    {

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


    public function check_listense_key(Request $request)
    {
        if ($request->url_path === $request->url) {

            $listense_key = ListenseKey::where('code', $request->code)->where('url', $request->url)->first();

            if (!$listense_key) {
                return response()->json(['status' => 'error', 'message' => 'Listense Key not found']);
            }
            return response()->json(['status' => 'success'], 200);
        }
        return response()->json(['status' => 'error', 'message' => 'Listense Key not found']);
    }


    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();
            $remember = $request->has('remember') ? true : false;
            if (Auth::attempt($credentials, $remember)) {
                return redirect()->route('home')->with('success', 'Đăng nhập thành công');
            }

            return back()->with(['error' => 'Email hoặc mật khẩu không chính xác.'])->withInput();
        } catch (\Throwable $th) {
        }
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'Đăng xuất thành công.');
    }
}


 // public function authenticate(LoginRequest $request)
    // {
    //     try {
    //         $credentials = $request->validated();
    //         if (Auth::attempt($credentials)) {
    //             $user = User::where('email', $request->email)->first();
    //             $user->tokens()->delete();
    //             return response()->json([
    //                 'status' => 'success',
    //                 'data' => $user,
    //                 'authorization' => [
    //                     'token' => $user->createToken('ApiToken')->plainTextToken,
    //                     'type' => 'bearer',
    //                 ]
    //             ]);
    //         }
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Email & Password does not match with our record.',
    //         ], 401);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }
