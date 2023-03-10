<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function index()
    {
        return view('user.sign_up');
    }

    public function postSignUp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'phone_number' => 'required|numeric|digits:10',
            'password' => 'min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);

        return response()->json([
            'success_message', 'Registered successfully!',
        ]);
    }
}
