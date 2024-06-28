<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendEmailOTPCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('front.users.forget-password');
    }

    public function getOtp(Request $request)
    {
        $user =  User::select('name','id')->where('email', $request->email)->firstOrFail();
//        $code = Str::random(6);
        $code=123456;
        $request->session()->put('otp', $code);
        $request->session()->put('email', $request->email);
        Notification::send($user, new SendEmailOTPCode($user , $code));
        return redirect()->route('reset-password')->with('success', 'We have sent you an email with the OTP code');
    }

    public function resetPassword()
    {
        return view('Front.users.reset-password');
    }
    public function updatePassword(Request $request)
    {
        if ($request->session()->get('otp') == $request->code) {
            User::where('email', $request->session()->get('email'))
                ->update(['password' => bcrypt($request->password)]);
            $request->session()->forget(['otp', 'email']);
            return redirect()->route('login')->with('success', 'Password has been reset successfully');
        }
        return redirect()->back()->withErrors(['code' => 'Invalid OTP Code']);
    }
}
