<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PassportAuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, TRUE),
        ]);

        $token = $user->createToken('laravel-token')->accessToken;
        return response()->json(['Data' => $user,'token' => $token], 200);
    }
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($data)) {
            $token = auth()->user()->createToken('laravel-token')->accessToken;
            return response()->json(['token' => $token], 200);
        }else {

            return response()->json(['error' => 'Unauthorised', 401]);
        }
    }
}
