<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function userLoginView()
    {
        return view('auth.user.login');
    }

    public function userLoginPost(Request $request)
    {
        $validate = $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8',
            ],
            [
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.exists' => 'This email is not registered.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
            ]
        );

        if (Auth::attempt($validate)) {
            $user = Auth::user();

            if ($user->status === 'active') {
                return redirect()->intended(route('index'));
            }

            Auth::logout();
            return redirect()->back()->with('error', 'Your account is not allowed to login here.');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.'
        ]);
    }

    public function userLogout(Request $request){
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

    public function userSignUpView(){
        return view('auth.user.signup');
    }

    public function userSignUpPost(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20',
            'dob'   =>  'required|date|before:today',
            'password' => 'required|string|min:8|confirmed'
        ]);
    }

    public function creatorLogout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

    public function creatorLoginView()
    {
        return view('auth.creator.login');
    }

    public function creatorLoginPost(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8',
            ],
            [
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.exists' => 'This email is not registered.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
            ]
        );

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->role === 'creator' && $user->status === 'active') {
                return redirect()->intended(route('creator.dashboard'));
            }

            Auth::logout();
            return redirect()->back()->with('error', 'Your account is not allowed to login here.');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.'
        ]);
    }

    public function adminLoginPost(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8',
            ],
            [
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.exists' => 'This email is not registered.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
            ]
        );

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.'
        ]);
    }

    public function adminLoginView()
    {
        return view('auth.admin.login');
    }
}
