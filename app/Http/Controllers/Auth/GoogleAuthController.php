<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class GoogleAuthController extends Controller
{
    public function callback(Request $request)
{
   
    try {
        $user = Socialite::driver('google')->stateless()->user();
        if(User::where('email', $user->getEmail())->exists()){
            $existingUser = User::where('email', $user->getEmail())->first();
            Auth::login($existingUser);
            return redirect('/');
        }

        else{
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->password = Hash::make(Str::random(16)); // Generate a random password
            $newUser->google_id = $user->getId();
            $newUser->avatar = $user->getAvatar();
            $newUser->email_verified_at = now(); // Set email verified date
            $newUser->save();

            Auth::login($newUser);
            return redirect('/');
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to authenticate with Google.'], 500);
    }
}


    function redirect()
    {
        return Socialite::driver('google')->redirect();

    }


    function login()
    {
        return view('auth.login');
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
