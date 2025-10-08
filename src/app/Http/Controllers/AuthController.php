<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        Auth::login($user);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if(Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('flash_message', 'ログインしました');
        }

        return back()->withErrors([
        'email' => 'ログイン情報が登録されていません。',
    ])->onlyInput('email');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
}
