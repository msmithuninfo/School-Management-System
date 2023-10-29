<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function login() 
    {   
        if (!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('backend/admin/dashboard')->with('success', 'Welcome Admin');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('backend/teacher/dashboard')->with('success', 'Welcome Teacher');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect('backend/student/dashboard')->with('success', 'Welcome Student');
            }
            else if(Auth::user()->user_type == 4)
            {
                return redirect('backend/parent/dashboard')->with('success', 'Welcome Parent');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request) 
    {   
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('backend/admin/dashboard')->with('success', 'Welcome Admin');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('backend/teacher/dashboard')->with('success', 'Welcome Teacher');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect('backend/student/dashboard')->with('success', 'Welcome Student');
            }
            else if(Auth::user()->user_type == 4)
            {
                return redirect('backend/parent/dashboard')->with('success', 'Welcome Parent');
            }
            
        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }

    public function logout() 
    {   
        Auth::logout();
        return redirect(url(''));
    }

    public function forgotPassword() 
    {
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request) 
    {
        $user = User::getEmailSingle($request->email);
        // go to User.php
        if(!empty($user))
        {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Please check your email and reset your password');
        }
        else
        {
            return redirect()->back()->with('error', 'Email Not Found');
        }
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function PostReset($token, Request $request)
    {
        if($request->password == $request->cPassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('')->with('success', 'Password Successfully Reset');
        }
        else
        {
            return redirect()->back()->with('error', 'Password And Confirm Password does not Match');
        }
    }

}
