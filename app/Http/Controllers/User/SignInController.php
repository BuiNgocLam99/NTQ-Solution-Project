<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function index()
    {
        return view('user.sign_in');
    }

    public function postSignIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('users')->attempt($credentials, $request->remember_me)) {
            $url = $request->session()->get('url.intended', url(route('user.home')));
            return response()->json(['url' => $url]);
        }

        return response()->json([
            'error_message' => 'Your email or password is not existed',
        ]);
    }
}
