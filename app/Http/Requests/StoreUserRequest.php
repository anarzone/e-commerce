<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'username' => 'required|string',
                'type' => 'required|integer',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed'
            ];
    }
}
