<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SignInController extends Controller
{
    public function index()
    {
        return view('user.sign_in');
    }

    public function postSignIn(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
            ],
            [
                'required' => 'This field is required',
                'min' => 'Must be at least 8 character long',
                'regex' => 'At least 1 upperacse, 1 lowercase'
            ]
        );

        $username = $request->username;
        $password = $request->password;
        $accountList = [];
        $length = 0;

        if(Session::has('accountList')){
            $accountList = (array)Session::get('accountList');
            $length = count($accountList);

            for($i = 0; $i < $length; $i++){
                if($accountList[$i]['username'] == $username && Hash::check($password, $accountList[$i]['password'])){
                    return redirect()->route('user.sign-in')->with('success_message', 'Sign up successfully!');
                }
            }
        }
        return redirect()->route('user.sign-in')->with('error_message', 'Your username or password is invalid!');
    }
}
