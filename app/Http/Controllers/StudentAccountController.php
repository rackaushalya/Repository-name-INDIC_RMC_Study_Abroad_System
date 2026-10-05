<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class StudentAccountController extends Controller
{
    private function getUser(): User
    {
        $user = Auth::user();

        if (!$user || !$user->student) {
            abort(403);
        }

        return $user;
    }

    public function edit()
    {
        $user = $this->getUser();
        $student = Student::find($user->student->student_id);

        return view('student.account', compact('user', 'student'));
    }

    public function updatePhoto(Request $request)
    {
        $user = $this->getUser();

        $validated = $request->validate([
            'profile_image' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
        ]);

        $path = $validated['profile_image']->store(
            'profile_images/' . $user->user_id,
            'public'
        );

        if ($user->profile_image && !str_starts_with($user->profile_image, 'http')) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->update(['profile_image' => $path]);

        return back()->with(
            'success',
            'Your profile photo has been updated.'
        );
    }

    public function removePhoto()
    {
        $user = $this->getUser();

        if ($user->profile_image && !str_starts_with($user->profile_image, 'http')) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->update(['profile_image' => null]);

        return back()->with(
            'success',
            'Your profile photo has been removed.'
        );
    }

    public function updatePassword(Request $request)
    {
        $user = $this->getUser();

        $validated = $request->validate([
            'current_password' => ['required', 'string', 'max:255'],
            'password' => [
                'required',
                'string',
                'max:72',
                'confirmed',
                'different:current_password',
                Password::min(8)->mixedCase()->numbers(),
            ],
        ], [
            'password.different' => 'The new password must be different from your current password.',
            'password.max' => 'The new password may not be longer than 72 characters.',
        ]);

        if (!Hash::check($validated['current_password'], $user->password_hash)) {
            return back()->withErrors([
                'current_password' => 'The current password you entered is incorrect.',
            ]);
        }

        $user->update([
            'password_hash' => Hash::make($validated['password']),
        ]);

        return back()->with(
            'success',
            'Your password has been updated successfully.'
        );
    }

    public function deactivate(Request $request)
    {
        $user = $this->getUser();

        $validated = $request->validate([
            'confirm_password' => ['required', 'string', 'max:255'],
        ]);

        if (!Hash::check($validated['confirm_password'], $user->password_hash)) {
            return back()->withErrors([
                'confirm_password' => 'Your password was incorrect. Account was not deactivated.',
            ]);
        }

        $user->update([
            'account_status' => 'inactive',
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with(
            'success',
            'Your account has been deactivated. Contact support if you wish to reactivate it.'
        );
    }
}
