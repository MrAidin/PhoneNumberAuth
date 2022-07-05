<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.loginn');
    }

    public function Login(Request $request)
    {
        $data = $request->validate([
            'phone' => ['required', 'regex:/^09(0[0-9]|1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/', 'exists:users,phone'],
        ]);
        $user = User::wherePhone($data['phone'])->first();
        $code = ActiveCode::generateCode($user);
        $user->notify(new ActiveCodeNotification($code, $user->phone));
        return redirect(route('auth.phone.token'));


    }
}
