<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function login(Request $request)
    {
        $akun = User::select('email')->where('email', $request->email)->first();
        if($akun == true)
        {
            if (Auth::user()->attempt(['email' => $request->email, 'password' => $request->password]))
            {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withNotif("Password yang anda masukan salah");
            }
        }else{
            return redirect()->back()->withNotif("Email tidak terdaftar");
        }

    }

    public function logout()
    {

    }

    public function dashboard()
    {

    }
}
