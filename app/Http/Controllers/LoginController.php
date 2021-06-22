<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/admin/products');
        }

        return redirect()->back();
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

    public function pwd() {
        return view('product.pwd');
    }

    public function pwdUpdate(Request $request) {
       $user = User::find(1);

       $user->password = Hash::make($request->pwd);
       $user->save();

       return redirect('/admin/pwd')->with(['message' => 'Пароль сменен', 'alert' => 'alert-success']);
    }
}
