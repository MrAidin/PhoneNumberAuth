<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function Register(Request $request)
    {

      $data =  $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'regex:/^09(0[0-9]|1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/','unique:users,phone'],
        ]);
       User::create($data);
       return redirect(route('auth.login'));
    }
}
