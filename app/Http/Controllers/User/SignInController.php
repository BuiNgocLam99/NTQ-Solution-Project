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
        $username = $request->username;
        $password = $request->password;
        $accoutList = [];
        $length = 0;

        if(Session::has('accountList')){
            $accoutList = (array)Session::get('accountList');
            $length = count($accoutList);

            for($i = 0; $i < $length; $i++){
                if($accoutList[$i]['username'] == $username && Hash::check($password, $accoutList[$i]['password'])){
                    return redirect()->route('user.sign-in')->with('success_message', 'Sign up successfully!');
                }
            }
        }

        return redirect()->route('user.sign-in')->with('error_message', 'Your username or password is invalid!');
    }
}
