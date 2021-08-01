<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('layout.auth');
    }
    public function login(Request $request)
    {
        $login = Auth::attempt(['username' => $request->post('username'), 'password' => $request->post('pass')]);
        if ($login) {
            return redirect()->route('calendar');
        } else {
            echo "User tidak ada";
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/auth');
    }
}
