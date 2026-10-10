<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Services\AuditLogService;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login', ['mode' => 'login']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
        ]);

        $user = User::where('email', $credentials['email'])
            ->where('account_status', 'active')
            ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password_hash)) {
            return back()
                ->withErrors([
                    'email' => 'The sign-in details could not be verified.',
                ])
                ->withInput();
        }

        Auth::login($user);

        $user->update([
            'last_login_at' => now(),
        ]);

        $request->session()->regenerate();

                AuditLogService::log(
            'User Login',
            'users',
            (int) $user->user_id,
            null,
            [
                'email' => $user->email,
                'role' => $user->role?->role_name,
            ]
        );

        return $this->redirectByRole($user);
    }

    public function showRegister()
    {
        return view('auth.login', ['mode' => 'register']);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $studentRole = Role::where('role_name', 'Student')->first();

        if (!$studentRole) {
            return back()
                ->withErrors([
                    'email' => 'Student role is not configured.',
                ])
                ->withInput();
        }

        $user = User::create([
            'role_id' => $studentRole->role_id,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password_hash' => Hash::make($validated['password']),
            'account_status' => 'active',
        ]);

        Student::create([
            'user_id' => $user->user_id,
        ]);

        AuditLogService::log(
            'User Registered',
            'users',
            (int) $user->user_id,
            null,
            [
                'email' => $user->email,
                'role' => $user->role?->role_name ?? 'Student',
            ]
        );

        Auth::login($user);

        $request->session()->regenerate();

        return $this->redirectByRole($user);
    }

        public function logout(Request $request)
        {
            $user = Auth::user();

            if ($user) {
                AuditLogService::log(
                    'User Logout',
                    'users',
                    (int) $user->user_id,
                    null,
                    [
                        'email' => $user->email,
                        'role' => $user->role?->role_name,
                    ]
                );
            }

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }

    /*
    |--------------------------------------------------------------------------
    | Forgot Password
    |--------------------------------------------------------------------------
    */

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'No account was found with this email address.',
            ])->withInput();
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        return redirect()->route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ])->with('status', 'Password reset link generated successfully.');
    }

    public function showResetPassword(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $validated['email'])
            ->first();

        if (!$resetRecord) {
            return back()->withErrors([
                'email' => 'Invalid or expired password reset request.',
            ]);
        }

        if (!Hash::check($validated['token'], $resetRecord->token)) {
            return back()->withErrors([
                'email' => 'Invalid or expired password reset request.',
            ]);
        }

        $createdAt = \Carbon\Carbon::parse($resetRecord->created_at);

        if ($createdAt->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')
                ->where('email', $validated['email'])
                ->delete();


            return back()->withErrors([
                'email' => 'This password reset link has expired.',
            ]);
        }

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'User account not found.',
            ]);
        }

        $user->update([
            'password_hash' => Hash::make($validated['password']),
        ]);

        DB::table('password_reset_tokens')
            ->where('email', $validated['email'])
            ->delete();

        return redirect()->route('login')->with(
            'status',
            'Your password has been reset successfully. You can now log in.'
        );
    }

    /**
     * Redirect the authenticated user to the correct dashboard
     * according to their role.
     */
    private function redirectByRole(User $user)
    {
        $roleName = $user->role?->role_name;

        return match ($roleName) {
            'Admin' => redirect()->route('admin.dashboard'),

            'Consultant' => redirect()->route('consultant.dashboard'),

            'Student' => redirect()->route('student.dashboard'),

            default => redirect()->route('login')->withErrors([
                'email' => 'Your account role is not configured correctly.',
            ]),
        };
    }
}
