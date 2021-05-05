<?php

namespace App\Http\Responses;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade

        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999);
        $user->update(['two_factor_code' => $otp, 'two_factor_expires_at' => Carbon::now()->addMinutes(2)]);
        return redirect()->route('verify.index');
        //dd($request);
        // return $request->wantsJson()
        //     ? response()->json(['two_factor' => true])
        //     : redirect()->intended(config('fortify.home'));
    }
}
