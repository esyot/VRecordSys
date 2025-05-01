<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Mail\SendAuthentication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function show()
    {

        $success = session('success') ?? null;
        return Inertia::render('Login', compact('success'));
    }
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (!Auth::attempt($credentials))
        {
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        }

        $user = Auth::user();

        if (!$user->is_active)
        {
            return back()->withErrors(['email' => 'Please verify your account before logging in.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    public function signup(SignUpRequest $request)
    {
        $validated = $request->validated();

        $code = Str::random(8);

        Mail::to($validated['email'])->send(new SendAuthentication($validated['name'], $validated['email'], $code));

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password_2']),
            'auth_code' => $code,
        ]);

        return redirect()->back()->with('success', 'Verification code sent to your email.');

    }

    public function verify(Request $request)
    {

        $user = User::where('auth_code', $request->input('code'))
            ->where('email', $request->input('email'))
            ->first();

        if ($user)
        {
            $user->is_active = true;
            $user->auth_code = null;
            $user->save();
        }

        return redirect()->route('login')->with('success', 'Account verified successfully.');
    }
}
