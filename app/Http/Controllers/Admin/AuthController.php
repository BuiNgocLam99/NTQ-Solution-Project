<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // Admin::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('Lam12345'),
        // ]);
        return view('admin.login.index');
    }

    public function checkLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
        ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::guard('admins')->attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'success_message' => route('admin.product.index'),
            ]);
        }

        return response()->json([
            'error_message' => 'Your email or password is not exists in our records',
        ]);
    }

    public function logout()
    {
        Auth::guard('admins')->logout();
        return redirect()->route('admin.auth-login');
    }
}
 