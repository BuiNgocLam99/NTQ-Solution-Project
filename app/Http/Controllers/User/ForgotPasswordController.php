<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('user.forgot_password');
    }

    public function postResetPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
            ]
        );

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user) {
            $newPassword = Str::random(10);
            Mail::to($email)->send(new ForgotPasswordMail($newPassword));
            $user->password = bcrypt($newPassword);
            $user->save();

            return response()->json(['success_message' => 'We have been sending password to your email!']);
        } else {
            return response()->json(['error_message' => 'Your email is not existed in our records!']);
        }
    }
}
