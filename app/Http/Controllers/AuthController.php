<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Role;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Http\Resources\User\User as UserResource;
use App\Http\Helpers\Helper;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
           'email' => 'required|string|email|unique:users',
           'company_name' => 'string',
           'type' => 'required|integer',
           'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            "type" => $request->type
        ]);

        $app_code = Helper::randomAppCodeGenarator();
        $vendor = Vendor::where('app_code', '=', $app_code)->get();

        while(count($vendor) !== 0){
            $app_code = Helper::randomAppCodeGenarator();
            $vendor = Vendor::where('app_code', '=', $app_code)->get();
        }

        $vendor = Vendor::create([
            'name' => $request->company_name,
            "app_code" => $app_code
        ]);

        $AdminRole = Role::where('name', '=', 'admin')->get();

        $user->roles()->attach($AdminRole);
        $user->vendors()->attach($vendor);



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
            ], Response::HTTP_UNAUTHORIZED);
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
            'roles'   => $user->roles,
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


    public function get_user(Request $request, Vendor $vendor, User $user){
        return new UserResource($user);
    }

    public function proceed_store(Request $request, $app_code){
        $request->session()->put('app_code', $app_code);
        return response()->json([
            'message' => Response::HTTP_OK,
            'app_code' => $app_code,
        ]);
    }
}
