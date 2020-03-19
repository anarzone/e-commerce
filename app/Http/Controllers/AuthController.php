<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string',
            'company_name' => 'required|string',
            'type' => 'required|integer',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

       $user = new User([
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'username' => $request->username,
          'type' => $request->type,
          'email' => $request->email,
          'password' => bcrypt($request->password)
       ]);

       $user->save();

        $vendor = new Vendor(['name' => $request->company_name]);
        $vendor->save();

        $user->vendors()->attach($vendor);

        $user->save();

       return response()->json([
           'message' => 'User successfully created'
       ], 201);
    }


    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'vendors' => $user->vendors,
            "message" => "Logged in",
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();

        return response()->json([
           'message' => 'Logged out'
        ]);
    }

    public function user(Request $request){
        return response()->json($request->user());
    }
}
