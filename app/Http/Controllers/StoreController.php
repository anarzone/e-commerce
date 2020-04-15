<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Role;
use App\User;
use App\Vendor;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    public function create_user(StoreUserRequest $request){
        $request->merge(['password'=> bcrypt($request->password)]);
        $validated_data = $request->all();
        $user = User::create($validated_data);

        $User_Role = Role::where('name', '=', User::USER_ROLE)->first();
        $Vendor    = Vendor::where('app_code', '=', $request->session()->get('app_code'))->first();


        $user->roles()->attach($User_Role);
        $user->vendors()->attach($Vendor);

        return response()->json([
            'details' => $user
        ], Response::HTTP_CREATED);
    }
}
