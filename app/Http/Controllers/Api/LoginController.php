<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $credentials = $request->only(["email", "password"]);


        if (Auth::guard('user')->attempt($credentials)) {
            config(['auth.guards.api.provider' => 'user']);

            $token = $user->createToken("LaravelAuthApp", ['user'])->accessToken;

            return response()->json([
                "message"   => "Success!!!",
                "token"     => $token,
                "user"      => $user,
            ]);
        }

        abort(403);
    }

    public function customerLogin(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        $credentials = $request->only(["email", "password"]);

        if (Auth::guard('customer')->attempt($credentials)) {

            config(['auth.guards.api.provider' => 'customer']);

            $token = $customer->createToken("LaravelAuthApp", ['customer'])->accessToken;

            return response()->json([
                "message"   => "Success!!!",
                "token"     => $token,
                "user"      => $customer,
            ]);
        }

        abort(403);
    }
}
