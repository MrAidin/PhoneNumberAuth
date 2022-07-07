<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function showToken(Request $request)
    {
        if (!$request->session()->has('auth')) {
            return redirect(route('auth.login'));
        }
        $request->session()->reflash();
        return view('auth.token');

    }

    public function Token(Request $request)
    {
        $request->validate([
            'token' => 'required',
        ]);
        if (!$request->session()->has('auth')) {
            return redirect(route('auth.login'));
        }

        $user = User::FindOrFail($request->session()->get('auth.user_id'));
        $status = ActiveCode::verifyCode($request->token, $user);

        if (!$status) {
            return redirect('/');
        }

        if (auth()->loginUsingId($user->id, $request->session()->get('auth.remember'))) {
            $user->activeCode()->delete();
            return redirect('/');
        }

        return redirect(route('auth.login'));

    }
}
