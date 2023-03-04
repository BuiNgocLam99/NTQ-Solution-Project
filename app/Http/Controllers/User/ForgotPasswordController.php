<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
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
            ],
            [
                'required' => 'This field is required',
            ]
        );

        $email = $request->email;

        if(Session::has('accountList')){
            $accountList = (array)Session::get('accountList');
            $length = count($accountList);

            for($i = 0; $i < $length; $i++){
                if($accountList[$i]['email'] == $email){
                    $newPassword = Str::random(10); 
                    $mailable = new ForgotPasswordMail($newPassword);
                    Mail::to($email)->send($mailable);
                    $accountList[$i]['password'] = bcrypt($newPassword);
                    Session::put('accountList', $accountList);
                    return redirect()->route('user.forgot-password')->with('success_message', 'Please check your email!');
                }
            }
        }
        return redirect()->route('user.forgot-password')->with('error_message', 'Your email is not exist in our records!');
    }
}
