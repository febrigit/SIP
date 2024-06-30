<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;
class IndexController extends Controller
{
    public function login(Request $request)
    {
        // $akun = User::select('email')->where('email', $request->username)->first();
        $akun = User::select('username')->where('username', $request->username)->first();
        if($akun == true)
        {
            if($akun->deleted_at != null)
            {
                return redirect()->back()->withNotif("Akun anda sudah dihapus");
            }
            if($akun->status == 'NON AKTIF')
            {
                return redirect()->back()->withNotif("Akun anda sudah tidak aktif");
            }
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password]))
            {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withNotif("Password yang anda masukan salah");
            }
        }else{
            return redirect()->back()->withNotif("Username tidak terdaftar");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function changePassword () {
        return view('pages.change-password');
    }

    public function saveChangePassword (Request $request) {

        $data = User::find(Auth::user()->id);

        if ($request->new_password != $request->renew_password) {
            return redirect()->back()->withDanger("Password baru tidak cocok!");
        }
        $data->password = Hash::make($request->new_password);
        $data->update();

        return redirect()->back()->withAlert('Password berhasil dirubah!');
    }

    public function dashboard() 
    {
        return view('pages.dashboard');
    }
}
