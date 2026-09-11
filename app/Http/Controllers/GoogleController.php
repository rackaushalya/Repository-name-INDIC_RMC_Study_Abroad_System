<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if (!$user) {
            $studentRole = Role::where('role_name', 'Student')->first();

            $user = User::create([
                'role_id' => $studentRole?->role_id,
                'first_name' => $googleUser->user['given_name'] ?? $googleUser->getName() ?? 'Student',
                'last_name' => $googleUser->user['family_name'] ?? null,
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'profile_image' => $googleUser->getAvatar(),
                'account_status' => 'active',
                'email_verified_at' => now(),
            ]);

            Student::create([
                'user_id' => $user->user_id,
            ]);
        } else {
            $user->update([
                'google_id' => $googleUser->getId(),
                'profile_image' => $googleUser->getAvatar(),
                'last_login_at' => now(),
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}