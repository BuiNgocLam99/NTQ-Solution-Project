<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SignUpController extends Controller
{
    public function index()
    {
        return view('user.sign_up');
    }

    public function postSignUp(SignUpFormRequest $request)
    {
        $validatedData = $request->validated();

        User::create([
            'name' => $validatedData->name,
            'email' => $validatedData->email,
            'phone' => $validatedData->phone,
            'password' => bcrypt($validatedData->password),
        ]);
        
        return response()->json([
            'success_message', 'Registered successfully!'
        ]);
    }
}
