<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\TwoFactorCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Carbon;
use Twilio\Rest\Client;

class OTPController extends Controller
{
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();
        $user->generateTwoFactorCode();
        $otp = $user->two_factor_code;
        $user->notify(new TwoFactorCode());

        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');

        $twilio = new Client($sid, $token);


        $message = $twilio->messages
            ->create(
                $user->phone_number, // to
                [
                    "body" => "Here's your One-Time Password: " . $otp . " It is only valid for 20mins.",
                    "from" => $from
                ]
            );

        return redirect()->route('login.verify')->with('credentials', $request->email);
    }

    public function verify(Request $request)
    {
        return Inertia::render('Auth/VerifyOTP');
    }

    public function authenticate(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'min:6']
        ]);

        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return redirect()->back();
        }

        return redirect()->route('dashboard');
    }

    public function resend(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->resetTwoFactorCode();
        $user->generateTwoFactorCode();
        return redirect()->back();
    }
}
